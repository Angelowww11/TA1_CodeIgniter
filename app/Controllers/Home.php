<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index(): string
    {
        $today = date('Y-m-d');
        $tasks = (new TaskModel())
            ->where('task_date', $today)
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('pages/today', [
            'title' => 'Today',
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }
}
