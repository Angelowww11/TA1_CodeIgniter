<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('auth_user_id')) {
            return redirect()->to(site_url('customers'));
        }

        return view('auth/login', [
            'title' => 'Staff Login',
            'username' => '',
            'error' => session()->getFlashdata('error'),
            'signedOut' => $this->request->getGet('signed_out') === '1',
        ]);
    }

    public function authenticate()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = $username !== '' ? (new UserModel())->where('username', $username)->first() : null;

        if ($password === '' || ! $user || ! password_verify($password, $user['password_hash']) || $user['account_status'] !== 'Active') {
            return view('auth/login', [
                'title' => 'Staff Login', 'username' => $username,
                'error' => 'Invalid username or password, or the account is inactive.',
                'signedOut' => false,
            ]);
        }

        session()->regenerate(true);
        session()->set([
            'auth_user_id' => (int) $user['user_id'],
            'auth_username' => $user['username'],
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login') . '?signed_out=1');
    }
}
