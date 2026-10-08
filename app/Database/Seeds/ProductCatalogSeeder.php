<?php

namespace App\Database\Seeds;

use App\Libraries\MediaStore;
use CodeIgniter\Database\Seeder;

class ProductCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Ceramic Coffee Mug', 'sku' => 'MUG-001', 'price' => '249.00', 'stock_quantity' => 24, 'image' => 'demo-ceramic-mug.jpg'],
            ['name' => 'Canvas Market Tote', 'sku' => 'TOTE-002', 'price' => '385.00', 'stock_quantity' => 12],
            ['name' => 'Pocket Notebook Set', 'sku' => 'NOTE-003', 'price' => '175.00', 'stock_quantity' => 32],
            ['name' => 'Brass Desk Clip', 'sku' => 'CLIP-004', 'price' => '129.00', 'stock_quantity' => 4],
        ];
        foreach ($products as $product) {
            if (! $this->db->table('products')->where('sku', $product['sku'])->countAllResults()) {
                $this->db->table('products')->insert($product);
            }
        }

        if (MediaStore::usesDatabase()) {
            $demoImage = FCPATH . 'uploads/products/demo-ceramic-mug.jpg';
            if (is_file($demoImage) && MediaStore::find('demo-ceramic-mug.jpg') === null) {
                MediaStore::save('demo-ceramic-mug.jpg', $demoImage);
            }
        }
    }
}
