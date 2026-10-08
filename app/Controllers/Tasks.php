<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index(): string
    {
        $tasks = (new TaskModel())
            ->where('is_archived', false)
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('tasks/index', [
            'title' => 'All Tasks',
            'tasks' => $tasks,
        ]);
    }

    public function new(): string
    {
        return view('tasks/form', ['title' => 'New Task', 'task' => null, 'errors' => session()->getFlashdata('errors') ?? []]);
    }

    public function create()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        (new TaskModel())->insert($this->taskData() + ['created_at' => date('Y-m-d H:i:s'), 'is_archived' => false]);
        return redirect()->to(site_url('tasks'))->with('message', 'Task added.');
    }

    public function edit(int $id)
    {
        $task = (new TaskModel())->where('is_archived', false)->find($id);
        if (! $task) return redirect()->to(site_url('tasks'))->with('error', 'Task not found.');
        return view('tasks/form', ['title' => 'Edit Task', 'task' => $task, 'errors' => session()->getFlashdata('errors') ?? []]);
    }

    public function update(int $id)
    {
        $model = new TaskModel();
        if (! $model->where('is_archived', false)->find($id)) return redirect()->to(site_url('tasks'))->with('error', 'Task not found.');
        if (! $this->validate($this->rules())) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $model->update($id, $this->taskData());
        return redirect()->to(site_url('tasks'))->with('message', 'Task updated.');
    }

    public function archive(int $id)
    {
        $model = new TaskModel();
        if (! $model->where('is_archived', false)->find($id)) return redirect()->to(site_url('tasks'))->with('error', 'Task not found.');
        $model->update($id, ['is_archived' => true]);
        return redirect()->to(site_url('tasks'))->with('message', 'Task archived.');
    }

    private function rules(): array
    {
        return ['title' => 'required|max_length[150]', 'task_date' => 'required|valid_date[Y-m-d]', 'status' => 'required|in_list[pending,in progress,completed]'];
    }

    private function taskData(): array
    {
        return ['title' => trim((string) $this->request->getPost('title')), 'task_date' => $this->request->getPost('task_date'), 'status' => $this->request->getPost('status')];
    }
}
