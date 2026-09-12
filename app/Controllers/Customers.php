<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            ['full_name' => 'Ana Santos', 'email' => 'ana.santos@example.com', 'phone' => '0917 123 4501'],
            ['full_name' => 'Ben Cruz', 'email' => 'ben.cruz@example.com', 'phone' => '0918 234 5602'],
            ['full_name' => 'Carla Reyes', 'email' => 'carla.reyes@example.com', 'phone' => '0919 345 6703'],
            ['full_name' => 'Diego Ramos', 'email' => 'diego.ramos@example.com', 'phone' => '0920 456 7804'],
            ['full_name' => 'Ella Garcia', 'email' => 'ella.garcia@example.com', 'phone' => '0921 567 8905'],
        ];

        return view('customers/index', [
            'title' => 'Customer Accounts',
            'customers' => $customers,
        ]);
    }
}
