<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $db = db_connect();
        $products = new ProductModel();
        $recent = $db->table('sales s')
            ->select('s.id, s.quantity, s.total_price, s.created_at, p.name AS product_name, u.first_name AS staff_first_name')
            ->join('products p', 'p.id = s.product_id')
            ->join('user_accounts u', 'u.user_id = s.sold_by')
            ->orderBy('s.id', 'DESC')->limit(5)->get()->getResultArray();

        return view('dashboard/index', [
            'title' => 'Overview',
            'productCount' => $products->where('is_archived', 0)->countAllResults(),
            'lowStock' => $products->where('is_archived', 0)->where('stock_quantity <=', 5)->countAllResults(),
            'saleCount' => $db->table('sales')->countAllResults(),
            'salesTotal' => (string) (($db->table('sales')->selectSum('total_price')->get()->getRowArray()['total_price'] ?? '0') ?: '0'),
            'recent' => $recent,
        ]);
    }
}
