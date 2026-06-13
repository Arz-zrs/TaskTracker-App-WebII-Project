<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\CommentModel;

class CommentController extends BaseController
{
    public function store($taskId)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($taskId);

        if (! $task) {
            return redirect()
                ->to('/projects')
                ->with('error', 'Task tidak ditemukan.');
        }

        if (! empty($task['archived_at'])) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Task sudah diarsipkan dan komentar tidak dapat ditambahkan.');
        }

        $access = $this->getProjectAccess($task['project_id']);

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Project sudah selesai dan tidak dapat diubah.');
        }

        if ($access['role'] === 'klien') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Klien hanya dapat melihat komentar, tidak dapat menambahkan komentar.');
        }

        $rules = [
            'body' => 'required|min_length[1]|max_length[1000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('errors', $this->validator->getErrors());
        }

        $commentModel = new CommentModel();

        $commentBody = $this->request->getPost('body');

        $commentId = $commentModel->insert([
            'task_id' => $taskId,
            'user_id' => session()->get('user_id'),
            'body' => $commentBody,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->logActivity(
            $task['project_id'],
            'comment',
            $commentId,
            'created',
            'added comment: "' . $commentBody . '" on task: "' . $task['title'] . '"'
        );

        return redirect()
            ->to('/projects/' . $task['project_id'])
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function edit($commentId)
    {
        $context = $this->getCommentContext($commentId);

        if (! $context) {
            return redirect()
                ->to('/projects')
                ->with('error', 'Komentar tidak ditemukan.');
        }

        $comment = $context['comment'];
        $task = $context['task'];
        $access = $context['access'];

        if (! empty($task['archived_at'])) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Task sudah diarsipkan dan komentar tidak dapat diubah.');
        }

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Project sudah selesai dan komentar tidak dapat diubah.');
        }

        if ($access['role'] === 'klien') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Klien hanya dapat melihat komentar.');
        }

        if ((int) $comment['user_id'] !== (int) session()->get('user_id')) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Kamu hanya dapat mengedit komentarmu sendiri.');
        }

        return view('comments/edit', [
            'comment' => $comment,
            'task' => $task,
            'project' => $access['project'],
        ]);
    }

    public function update($commentId)
    {
        $context = $this->getCommentContext($commentId);

        if (! $context) {
            return redirect()
                ->to('/projects')
                ->with('error', 'Komentar tidak ditemukan.');
        }

        $comment = $context['comment'];
        $task = $context['task'];
        $access = $context['access'];

        if (! empty($task['archived_at'])) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Task sudah diarsipkan dan komentar tidak dapat diubah.');
        }

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Project sudah selesai dan komentar tidak dapat diubah.');
        }

        if ($access['role'] === 'klien') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Klien hanya dapat melihat komentar.');
        }

        if ((int) $comment['user_id'] !== (int) session()->get('user_id')) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Kamu hanya dapat mengedit komentarmu sendiri.');
        }

        $rules = [
            'body' => 'required|min_length[1]|max_length[1000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $commentBeforeUpdate = $comment['body'];
        $commentAfterUpdate = $this->request->getPost('body');

        $commentModel = new CommentModel();

        $commentModel->update($commentId, [
            'body' => $commentAfterUpdate,
        ]);

        $this->logActivity(
            $task['project_id'],
            'comment',
            $commentId,
            'updated',
            'updated comment from: "' . $commentBeforeUpdate . '" to: "' . $commentAfterUpdate . '" on task: "' . $task['title'] . '"'
        );

        return redirect()
            ->to('/projects/' . $task['project_id'])
            ->with('success', 'Komentar berhasil diperbarui.');
    }

    public function delete($commentId)
    {
        $context = $this->getCommentContext($commentId);

        if (! $context) {
            return redirect()
                ->to('/projects')
                ->with('error', 'Komentar tidak ditemukan.');
        }

        $comment = $context['comment'];
        $task = $context['task'];
        $access = $context['access'];

        if (! empty($task['archived_at'])) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Task sudah diarsipkan dan komentar tidak dapat dihapus.');
        }

        if ($access['project']['status'] === 'completed') {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Project sudah selesai dan komentar tidak dapat dihapus.');
        }

        $isAuthor = (int) $comment['user_id'] === (int) session()->get('user_id');
        $isProjectAdmin = $access['is_admin'];

        if (! $isAuthor && ! $isProjectAdmin) {
            return redirect()
                ->to('/projects/' . $task['project_id'])
                ->with('error', 'Kamu tidak punya akses untuk menghapus komentar ini.');
        }

        $commentModel = new CommentModel();

        $commentModel->delete($commentId);

        $this->logActivity(
            $task['project_id'],
            'comment',
            $commentId,
            'deleted',
            'deleted comment: "' . $comment['body'] . '" from task: "' . $task['title'] . '"'
        );

        return redirect()
            ->to('/projects/' . $task['project_id'])
            ->with('success', 'Komentar berhasil dihapus.');
    }

    private function getCommentContext($commentId)
    {
        $commentModel = new CommentModel();
        $taskModel = new TaskModel();

        $comment = $commentModel->find($commentId);

        if (! $comment) {
            return null;
        }

        $task = $taskModel->find($comment['task_id']);

        if (! $task) {
            return null;
        }

        $access = $this->getProjectAccess($task['project_id']);

        return [
            'comment' => $comment,
            'task' => $task,
            'access' => $access,
        ];
    }
}