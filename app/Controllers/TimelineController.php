<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class TimelineController extends BaseController
{
    public function index()
    {
        $view = $this->request->getGet('view') ?? 'deadlines';
        $userId = session()->get('user_id');

        $projectModel = new ProjectModel();
        $projectIds = $projectModel->getAccessibleProjectIdsForUser($userId);

        if (empty($projectIds)) {
            return view('timeline/index', [
                'view' => $view,
                'deadlines' => [],
                'logs' => [],
            ]);
        }

        $db = \Config\Database::connect();

        $deadlines = $db->table('tasks')
            ->select('tasks.*, projects.title as project_title, users.name as assignee_name')
            ->join('projects', 'projects.id = tasks.project_id')
            ->join('users', 'users.id = tasks.assignee_id', 'left')
            ->whereIn('tasks.project_id', $projectIds)
            ->where('tasks.archived_at', null)
            ->where('projects.archived_at', null)
            ->where('tasks.deadline IS NOT NULL', null, false)
            ->orderBy('tasks.deadline', 'ASC')
            ->get()
            ->getResultArray();

        $logs = $db->table('activity_logs')
            ->select('activity_logs.*, users.name as user_name, projects.title as project_title')
            ->join('users', 'users.id = activity_logs.user_id')
            ->join('projects', 'projects.id = activity_logs.project_id', 'left')
            ->whereIn('activity_logs.project_id', $projectIds)
            ->orderBy('activity_logs.created_at', 'DESC')
            ->limit(100)
            ->get()
            ->getResultArray();

        $logs = $this->formatActivityLogs($logs);

        return view('timeline/index', [
            'view' => $view,
            'deadlines' => $deadlines,
            'logs' => $logs,
        ]);
    }
}