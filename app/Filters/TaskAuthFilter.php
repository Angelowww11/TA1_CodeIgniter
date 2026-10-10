<?php

namespace App\Filters;

use App\Models\TaskUserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TaskAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $id = session()->get('task_user_id');
        if (! $id || ! (new TaskUserModel())->find($id)) {
            session()->remove(['task_user_id', 'task_username']);
            return redirect()->to(site_url('tasks/login'))->with('error', 'Sign in to manage tasks.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->setHeader('Cache-Control', 'no-store, private');
    }
}
