<?php

namespace App\Controllers;

use App\Models\TaskUserModel;

class TaskAuth extends BaseController
{
    public function login()
    {
        if (session()->get('task_user_id')) return redirect()->to(site_url('tasks'));
        return view('tasks/login', ['title' => 'Task Login', 'error' => session()->getFlashdata('error')]);
    }

    public function authenticate()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = $username !== '' ? (new TaskUserModel())->where('username', $username)->first() : null;
        if (! $user || ! password_verify($password, (string) ($user['password_hash'] ?? ''))) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }
        session()->regenerate(true);
        session()->set(['task_user_id' => (int) $user['id'], 'task_username' => $user['username']]);
        return redirect()->to(site_url('tasks'));
    }

    public function logout()
    {
        session()->remove(['task_user_id', 'task_username']);
        session()->regenerate(true);
        return redirect()->to(site_url('today'));
    }
}
