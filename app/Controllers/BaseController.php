<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\ProjectModel;
use App\Models\ProjectMemberModel;
use CodeIgniter\Exceptions\PageNotFoundException;

abstract class BaseController extends Controller
{
    protected function getProjectAccess($projectId)
    {
        $userId = session()->get('user_id');

        $projectModel = new ProjectModel();

        $project = $projectModel
            ->where('archived_at', null)
            ->find($projectId);

        if (! $project) {
            throw PageNotFoundException::forPageNotFound('Project not found');
        }

        if ((int) $project['admin_id'] === (int) $userId) {
            return [
                'project' => $project,
                'role' => 'admin',
                'is_admin' => true,
            ];
        }

        $memberModel = new ProjectMemberModel();

        $member = $memberModel
            ->where('project_id', $projectId)
            ->where('user_id', $userId)
            ->first();

        if ($member) {
            return [
                'project' => $project,
                'role' => $member['role'],
                'is_admin' => false,
            ];
        }

        throw PageNotFoundException::forPageNotFound('Project not found');
    }

    protected function formatDateTime($dateTime)
    {
        if (empty($dateTime)) {
            return '-';
        }

        $timestamp = strtotime($dateTime);

        if (! $timestamp) {
            return '-';
        }

        return date('H:i, d M Y', $timestamp);
    }

    protected function formatActivityMessage(array $log)
    {
        $user = $log['user_name'] ?? 'User';
        $detail = trim((string) ($log['detail'] ?? ''));

        if ($detail !== '') {
            return "{$user} {$detail}";
        }

        $entity = $log['entity_type'] ?? '';
        $action = $log['action'] ?? '';

        if ($entity === 'project' && $action === 'created') {
            return "{$user} created a project.";
        }

        if ($entity === 'project' && $action === 'updated') {
            return "{$user} updated a project.";
        }

        if ($entity === 'project' && $action === 'archived') {
            return "{$user} archived a project.";
        }

        if ($entity === 'project' && $action === 'completed') {
            return "{$user} completed a project.";
        }

        if ($entity === 'project' && $action === 'reopened') {
            return "{$user} reopened a project.";
        }

        if ($entity === 'task' && $action === 'created') {
            return "{$user} created a task.";
        }

        if ($entity === 'task' && $action === 'updated') {
            return "{$user} updated a task.";
        }

        if ($entity === 'task' && ($action === 'status_updated' || $action === 'status_changed')) {
            return "{$user} changed task status.";
        }

        if ($entity === 'task' && $action === 'archived') {
            return "{$user} archived a task.";
        }

        if ($entity === 'comment' && $action === 'created') {
            return "{$user} created a comment.";
        }

        if ($entity === 'comment' && $action === 'updated') {
            return "{$user} updated a comment.";
        }

        if ($entity === 'comment' && $action === 'deleted') {
            return "{$user} deleted a comment.";
        }

        if ($entity === 'member' && $action === 'created') {
            return "{$user} added a member.";
        }

        if ($entity === 'member' && $action === 'deleted') {
            return "{$user} removed a member.";
        }

        return "{$user} performed an activity.";
    }

    protected function formatActivityLogs(array $logs)
    {
        return array_map(function ($log) {
            return [
                ...$log,
                'message' => $this->formatActivityMessage($log),
                'formatted_time' => $this->formatDateTime($log['created_at'] ?? null),
            ];
        }, $logs);
    }

    protected function logActivity($projectId, $entityType, $entityId, $action, $detail = null)
    {
        $logModel = new \App\Models\ActivityLogModel();

        $logModel->insert([
            'user_id' => session()->get('user_id'),
            'project_id' => $projectId,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'action' => $action,
            'detail' => $detail,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
    
    protected function shortText($text, $limit = 80)
    {
        $text = trim(preg_replace('/\s+/', ' ', (string) $text));

        if ($text === '') {
            return '';
        }

        if (strlen($text) <= $limit) {
            return $text;
        }

        return substr($text, 0, $limit) . '...';
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
}
