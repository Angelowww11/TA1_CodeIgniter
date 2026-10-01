<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = (new CustomerModel())->orderBy('customer_id', 'ASC')->findAll();
        return view('customers/index', ['title' => 'Customer Accounts', 'customers' => $customers]);
    }

    public function new(): string
    {
        return view('customers/form', ['title' => 'New Customer', 'customer' => [], 'errors' => [], 'action' => site_url('customers')]);
    }

    public function create()
    {
        $data = $this->customerInput();
        if (! $this->validate($this->customerRules())) {
            return view('customers/form', ['title' => 'New Customer', 'customer' => $data, 'errors' => $this->validator->getErrors(), 'action' => site_url('customers')]);
        }
        (new CustomerModel())->insert($data);
        return redirect()->to(site_url('customers'))->with('message', 'Customer account created.');
    }

    public function edit(int $id)
    {
        $customer = (new CustomerModel())->find($id);
        if (! $customer) return $this->response->setStatusCode(404)->setBody('Customer not found.');
        return view('customers/form', ['title' => 'Edit Customer', 'customer' => $customer, 'errors' => [], 'action' => site_url('customers/update/' . $id)]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();
        if (! $model->find($id)) return $this->response->setStatusCode(404)->setBody('Customer not found.');
        $data = $this->customerInput();
        $rules = $this->customerRules();
        $rules['email'] = "required|valid_email|max_length[100]|is_unique[customer_accounts.email,customer_id,{$id}]";
        if (! $this->validate($rules)) {
            return view('customers/form', ['title' => 'Edit Customer', 'customer' => array_merge($model->find($id), $data), 'errors' => $this->validator->getErrors(), 'action' => site_url('customers/update/' . $id)]);
        }
        $model->update($id, $data);
        return redirect()->to(site_url('customers'))->with('message', 'Customer account updated.');
    }

    private function customerInput(): array
    {
        return ['first_name' => trim((string) $this->request->getPost('first_name')), 'last_name' => trim((string) $this->request->getPost('last_name')), 'email' => strtolower(trim((string) $this->request->getPost('email'))), 'phone' => trim((string) $this->request->getPost('phone')), 'address' => trim((string) $this->request->getPost('address')) ?: null, 'account_status' => trim((string) ($this->request->getPost('account_status') ?: 'Active'))];
    }

    private function customerRules(): array
    {
        return ['first_name' => 'required|string|max_length[50]', 'last_name' => 'required|string|max_length[50]', 'email' => 'required|valid_email|max_length[100]|is_unique[customer_accounts.email]', 'phone' => 'required|string|max_length[20]', 'address' => 'permit_empty|string|max_length[255]', 'account_status' => 'required|in_list[Active,Inactive]'];
    }
}
