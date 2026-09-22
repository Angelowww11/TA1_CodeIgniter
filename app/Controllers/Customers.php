<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();
        $customers = $customerModel
            ->select("CONCAT(first_name, ' ', last_name) AS full_name", false)
            ->select('email, phone, account_status')
            ->orderBy('customer_id', 'ASC')
            ->findAll();

        return view('customers/index', [
            'title' => 'Customer Accounts',
            'customers' => $customers,
        ]);
    }
}
