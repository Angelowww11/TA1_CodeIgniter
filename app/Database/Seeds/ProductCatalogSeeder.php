<?php

namespace App\Database\Seeds;

use App\Libraries\MediaStore;
use CodeIgniter\Database\Seeder;

class ProductCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Ceramic Coffee Mug', 'sku' => 'MUG-001', 'price' => '249.00', 'stock_quantity' => 24, 'image' => 'catalog-ceramic-mug.jpg'],
            ['name' => 'Canvas Market Tote', 'sku' => 'TOTE-002', 'price' => '385.00', 'stock_quantity' => 12, 'image' => 'catalog-canvas-tote-v2.jpg'],
            ['name' => 'Pocket Notebook Set', 'sku' => 'NOTE-003', 'price' => '175.00', 'stock_quantity' => 32, 'image' => 'catalog-notebook.jpg'],
            ['name' => 'Brass Desk Clip', 'sku' => 'CLIP-004', 'price' => '129.00', 'stock_quantity' => 4, 'image' => 'catalog-brass-clips.jpg'],
        ];
        foreach ($products as $product) {
            $existing = $this->db->table('products')->select('image')->where('sku', $product['sku'])->get()->getRowArray();
            if ($existing === null) {
                $this->db->table('products')->insert($product);
            } elseif (empty($existing['image']) || in_array($existing['image'], ['demo-ceramic-mug.jpg', 'catalog-canvas-tote.jpg'], true)) {
                $this->db->table('products')->where('sku', $product['sku'])->update(['image' => $product['image']]);
            }
        }

        if (MediaStore::usesDatabase()) {
            foreach ($products as $product) {
                $imagePath = FCPATH . 'uploads/products/' . $product['image'];
                if (is_file($imagePath) && MediaStore::find($product['image']) === null) {
                    MediaStore::save($product['image'], $imagePath);
                }
            }
        }
    }
}
