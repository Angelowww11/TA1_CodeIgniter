<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use Throwable;

class Sales extends BaseController
{
    public function index(): string
    {
        $history = db_connect()->table('sales s')
            ->select('s.id, s.quantity, s.unit_price, s.total_price, s.created_at, p.name AS product_name, p.sku, c.first_name AS customer_first, c.last_name AS customer_last, u.first_name AS staff_first, u.last_name AS staff_last')
            ->join('products p', 'p.id = s.product_id')
            ->join('customer_accounts c', 'c.customer_id = s.customer_id', 'left')
            ->join('user_accounts u', 'u.user_id = s.sold_by')
            ->orderBy('s.id', 'DESC')->get()->getResultArray();
        return view('sales/index', ['title' => 'Sales History', 'sales' => $history]);
    }

    public function new(): string
    {
        return $this->form([], []);
    }

    public function create()
    {
        $input = [
            'product_id' => (string) $this->request->getPost('product_id'),
            'customer_id' => (string) $this->request->getPost('customer_id'),
            'quantity' => (string) $this->request->getPost('quantity'),
        ];
        if (! $this->validate(['product_id' => 'required|is_natural_no_zero', 'customer_id' => 'permit_empty|is_natural_no_zero', 'quantity' => 'required|is_natural_no_zero'])) {
            return $this->form($input, $this->validator->getErrors());
        }
        $productId = (int) $input['product_id'];
        $quantity = (int) $input['quantity'];
        $product = (new ProductModel())->find($productId);
        if (! $product || (int) $product['is_archived'] === 1) return $this->form($input, ['product' => 'Choose an available product.']);
        $customerId = $input['customer_id'] === '' ? null : (int) $input['customer_id'];
        if ($customerId !== null && ! (new CustomerModel())->find($customerId)) return $this->form($input, ['customer' => 'Choose a valid customer.']);

        $db = db_connect();
        $db->transBegin();
        try {
            // A conditional update makes concurrent checkouts unable to oversell the same stock.
            $db->table('products')->set('stock_quantity', 'stock_quantity - ' . $quantity, false)
                ->where('id', $productId)->where('is_archived', 0)
                ->where('stock_quantity >=', $quantity)->update();
            if ($db->affectedRows() !== 1) {
                $db->transRollback();
                return $this->form($input, ['quantity' => 'There is not enough stock for this sale. Reduce the quantity and try again.']);
            }
            $unitCents = (int) round(((float) $product['price']) * 100);
            $db->table('sales')->insert([
                'product_id' => $productId, 'customer_id' => $customerId,
                'sold_by' => (int) session()->get('auth_user_id'), 'quantity' => $quantity,
                'unit_price' => number_format($unitCents / 100, 2, '.', ''),
                'total_price' => number_format(($unitCents * $quantity) / 100, 2, '.', ''),
            ]);
            if ($db->transStatus() === false) throw new \RuntimeException('Sale insert failed.');
            $db->transCommit();
        } catch (Throwable $e) {
            $db->transRollback();
            log_message('error', 'Sale could not be recorded: {message}', ['message' => $e->getMessage()]);
            return $this->form($input, ['sale' => 'The sale could not be recorded. Please try again.']);
        }
        return redirect()->to(site_url('sales'))->with('message', 'Sale recorded and stock updated.');
    }

    private function form(array $input, array $errors): string
    {
        return view('sales/form', [
            'title' => 'Record Sale', 'input' => $input, 'errors' => $errors,
            'products' => (new ProductModel())->where('is_archived', 0)->orderBy('name')->findAll(),
            'customers' => (new CustomerModel())->where('account_status', 'Active')->orderBy('first_name')->findAll(),
        ]);
    }
}
