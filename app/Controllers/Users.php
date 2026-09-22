<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $users = $userModel
            ->select('username')
            ->select("CONCAT(first_name, ' ', last_name) AS full_name", false)
            ->select('role, account_status')
            ->orderBy('user_id', 'ASC')
            ->findAll();

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $users,
        ]);
    }
}
