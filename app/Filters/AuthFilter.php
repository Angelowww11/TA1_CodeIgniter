<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $id = session()->get('auth_user_id');
        $user = $id ? (new UserModel())->find($id) : null;
        if (! $user || $user['account_status'] !== 'Active') {
            session()->remove(['auth_user_id', 'auth_username']);
            return redirect()->to(site_url('login'))->with('error', 'Please sign in to access customer and user accounts.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->setHeader('Cache-Control', 'no-store, private');
    }
}
