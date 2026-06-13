<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class SearchController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $q = trim((string) $this->request->getGet('q'));

        $projectModel = new ProjectModel();
        $projectIds = $projectModel->getAccessibleProjectIdsForUser($userId);

        if ($q === '' || empty($projectIds)) {
            return view('search/index', [
                'q' => $q,
                'projects' => [],
                'tasks' => [],
            ]);
        }

        $db = \Config\Database::connect();

        $projects = $db->table('projects')
            ->select('projects.*')
            ->whereIn('projects.id', $projectIds)
            ->where('projects.archived_at', null)
            ->groupStart()
                ->like('projects.title', $q)
                ->orLike('projects.description', $q)
            ->groupEnd()
            ->orderBy('projects.updated_at', 'DESC')
            ->limit(20)
            ->get()
            ->getResultArray();

        $tasks = $db->table('tasks')
            ->select('tasks.*, projects.title as project_title, users.name as assignee_name')
            ->join('projects', 'projects.id = tasks.project_id')
            ->join('users', 'users.id = tasks.assignee_id', 'left')
            ->whereIn('tasks.project_id', $projectIds)
            ->where('tasks.archived_at', null)
            ->where('projects.archived_at', null)
            ->groupStart()
                ->like('tasks.title', $q)
                ->orLike('tasks.description', $q)
            ->groupEnd()
            ->orderBy('tasks.deadline', 'ASC')
            ->limit(30)
            ->get()
            ->getResultArray();

        return view('search/index', [
            'q' => $q,
            'projects' => $projects,
            'tasks' => $tasks,
        ]);
    }
}