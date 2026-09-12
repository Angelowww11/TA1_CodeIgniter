<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin01', 'full_name' => 'Maria Lopez', 'role' => 'Administrator'],
            ['username' => 'cashier01', 'full_name' => 'John Mendoza', 'role' => 'Cashier'],
            ['username' => 'cashier02', 'full_name' => 'Lea Flores', 'role' => 'Cashier'],
            ['username' => 'stock01', 'full_name' => 'Paolo Rivera', 'role' => 'Inventory Clerk'],
            ['username' => 'manager01', 'full_name' => 'Nina Bautista', 'role' => 'Store Manager'],
        ];

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $users,
        ]);
    }
}
