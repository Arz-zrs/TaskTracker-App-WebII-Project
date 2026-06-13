<?php

namespace App\Controllers;

use App\Models\ProjectMemberModel;
use App\Models\UserModel;

class ProjectMemberController extends BaseController
{
    public function store($projectId)
    {
        $access = $this->getProjectAccess($projectId);

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Project sudah selesai dan tidak dapat diubah.');
        }

        if (! $access['is_admin']) {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Kamu tidak punya akses untuk mengelola member project ini.');
        }

        $rules = [
            'user_id' => 'required|integer|is_not_unique[users.id]',
            'role' => 'required|in_list[member,klien]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $memberModel = new ProjectMemberModel();
        $userModel = new UserModel();

        $userId = (int) $this->request->getPost('user_id');
        $role = $this->request->getPost('role');

        if ((int) $access['project']['admin_id'] === $userId) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Admin project tidak perlu ditambahkan sebagai member.');
        }

        $exists = $memberModel
            ->where('project_id', $projectId)
            ->where('user_id', $userId)
            ->first();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'User sudah menjadi member project ini.');
        }

        $addedUser = $userModel->find($userId);

        $memberId = $memberModel->insert([
            'project_id' => $projectId,
            'user_id' => $userId,
            'role' => $role,
            'joined_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logActivity(
            $projectId,
            'member',
            $memberId,
            'created',
            'added member: ' . ($addedUser['name'] ?? 'Unknown User') . ' as ' . $role
        );

        return redirect()
            ->to('/projects/' . $projectId)
            ->with('success', 'Member berhasil ditambahkan.');
    }

    public function remove($projectId, $memberId)
    {
        $access = $this->getProjectAccess($projectId);

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Project sudah selesai dan tidak dapat diubah.');
        }

        if (! $access['is_admin']) {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Kamu tidak punya akses untuk mengelola member project ini.');
        }

        $memberModel = new ProjectMemberModel();
        $userModel = new UserModel();

        $member = $memberModel
            ->where('project_id', $projectId)
            ->where('id', $memberId)
            ->first();

        if (! $member) {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Member tidak ditemukan.');
        }

        $removedUser = $userModel->find($member['user_id']);

        $memberModel->delete($memberId);

        $this->logActivity(
            $projectId,
            'member',
            $memberId,
            'deleted',
            'removed member: ' . ($removedUser['name'] ?? 'Unknown User')
        );

        return redirect()
            ->to('/projects/' . $projectId)
            ->with('success', 'Member berhasil dihapus dari project.');
    }

    public function updateRole($projectId, $memberId)
    {
        $access = $this->getProjectAccess($projectId);

        if (! $access['is_admin']) {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Kamu tidak punya akses untuk mengubah role member.');
        }

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Project sudah selesai dan member tidak dapat diubah.');
        }

        $rules = [
            'role' => 'required|in_list[member,klien]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->with('errors', $this->validator->getErrors());
        }

        $memberModel = new ProjectMemberModel();

        $member = $memberModel
            ->where('project_id', $projectId)
            ->where('id', $memberId)
            ->first();

        if (! $member) {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('error', 'Member tidak ditemukan.');
        }

        $newRole = $this->request->getPost('role');
        $oldRole = $member['role'];

        if ($oldRole === $newRole) {
            return redirect()
                ->to('/projects/' . $projectId)
                ->with('success', 'Role member tidak berubah.');
        }

        $memberModel->update($memberId, [
            'role' => $newRole,
        ]);

        $userModel = new UserModel();
        $updatedUser = $userModel->find($member['user_id']);

        $this->logActivity(
            $projectId,
            'member',
            $memberId,
            'updated',
            'changed member ' . ($updatedUser['name'] ?? 'Unknown User') . ' role from ' . $oldRole . ' to ' . $newRole . ' in project "' . $access['project']['title'] . '"'
        );

        return redirect()
            ->to('/projects/' . $projectId)
            ->with('success', 'Role member berhasil diubah.');
    }
}