<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class NotificationController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        $projectModel = new ProjectModel();
        $projectIds = $projectModel->getAccessibleProjectIdsForUser($userId);

        if (empty($projectIds)) {
            return view('notifications/index', [
                'overdueTasks' => [],
                'dueTodayTasks' => [],
                'upcomingTasks' => [],
                'recentLogs' => [],
                'notificationCount' => 0,
            ]);
        }

        $db = \Config\Database::connect();

        $today = date('Y-m-d');
        $nextWeek = date('Y-m-d', strtotime('+7 days'));

        $baseTaskSelect = 'tasks.*, projects.title as project_title, users.name as assignee_name';

        $overdueTasks = $db->table('tasks')
            ->select($baseTaskSelect)
            ->join('projects', 'projects.id = tasks.project_id')
            ->join('users', 'users.id = tasks.assignee_id', 'left')
            ->whereIn('tasks.project_id', $projectIds)
            ->where('tasks.archived_at', null)
            ->where('projects.archived_at', null)
            ->where('projects.status', 'active')
            ->where('tasks.status !=', 'done')
            ->where('tasks.deadline <', $today)
            ->orderBy('tasks.deadline', 'ASC')
            ->get()
            ->getResultArray();

        $dueTodayTasks = $db->table('tasks')
            ->select($baseTaskSelect)
            ->join('projects', 'projects.id = tasks.project_id')
            ->join('users', 'users.id = tasks.assignee_id', 'left')
            ->whereIn('tasks.project_id', $projectIds)
            ->where('tasks.archived_at', null)
            ->where('projects.archived_at', null)
            ->where('projects.status', 'active')
            ->where('tasks.status !=', 'done')
            ->where('tasks.deadline', $today)
            ->orderBy('tasks.deadline', 'ASC')
            ->get()
            ->getResultArray();

        $upcomingTasks = $db->table('tasks')
            ->select($baseTaskSelect)
            ->join('projects', 'projects.id = tasks.project_id')
            ->join('users', 'users.id = tasks.assignee_id', 'left')
            ->whereIn('tasks.project_id', $projectIds)
            ->where('tasks.archived_at', null)
            ->where('projects.archived_at', null)
            ->where('projects.status', 'active')
            ->where('tasks.status !=', 'done')
            ->where('tasks.deadline >', $today)
            ->where('tasks.deadline <=', $nextWeek)
            ->orderBy('tasks.deadline', 'ASC')
            ->limit(10)
            ->get()
            ->getResultArray();

        $recentLogsRaw = $db->table('activity_logs')
            ->select('activity_logs.*, users.name as user_name, projects.title as project_title')
            ->join('users', 'users.id = activity_logs.user_id')
            ->join('projects', 'projects.id = activity_logs.project_id', 'left')
            ->whereIn('activity_logs.project_id', $projectIds)
            ->where('projects.archived_at', null)
            ->orderBy('activity_logs.created_at', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        $recentLogs = $this->formatActivityLogs($recentLogsRaw);

        $notificationCount = count($overdueTasks) + count($dueTodayTasks) + count($upcomingTasks);

        return view('notifications/index', [
            'overdueTasks' => $overdueTasks,
            'dueTodayTasks' => $dueTodayTasks,
            'upcomingTasks' => $upcomingTasks,
            'recentLogs' => $recentLogs,
            'notificationCount' => $notificationCount,
        ]);
    }
}