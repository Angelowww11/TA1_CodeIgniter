<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Throwable;

class Products extends BaseController
{
    public function index(): string
    {
        return view('products/index', [
            'title' => 'Products',
            'products' => (new ProductModel())->orderBy('is_archived', 'ASC')->orderBy('name')->findAll(),
        ]);
    }

    public function new(): string
    {
        return $this->form('Add Product', [], [], site_url('products'));
    }

    public function create()
    {
        return $this->save(null);
    }

    public function edit(int $id)
    {
        $product = (new ProductModel())->find($id);
        if (! $product) return $this->response->setStatusCode(404)->setBody('Product not found.');
        return $this->form('Edit Product', $product, [], site_url('products/update/' . $id));
    }

    public function update(int $id)
    {
        return $this->save($id);
    }

    public function archive(int $id)
    {
        $model = new ProductModel();
        $product = $model->find($id);
        if (! $product) return $this->response->setStatusCode(404)->setBody('Product not found.');
        $model->update($id, ['is_archived' => 1]);
        return redirect()->to(site_url('products'))->with('message', 'Product archived. Its past sales remain in history.');
    }

    private function save(?int $id)
    {
        $model = new ProductModel();
        $existing = $id === null ? null : $model->find($id);
        if ($id !== null && ! $existing) return $this->response->setStatusCode(404)->setBody('Product not found.');

        $data = [
            'name' => trim((string) $this->request->getPost('name')),
            'sku' => strtoupper(trim((string) $this->request->getPost('sku'))),
            'price' => trim((string) $this->request->getPost('price')),
            'stock_quantity' => trim((string) $this->request->getPost('stock_quantity')),
        ];
        $unique = $id === null ? 'is_unique[products.sku]' : "is_unique[products.sku,id,{$id}]";
        $rules = [
            'name' => 'required|max_length[100]',
            'sku' => "required|alpha_dash|max_length[40]|{$unique}",
            'price' => 'required|decimal|greater_than_equal_to[0]|less_than[100000000]',
            'stock_quantity' => 'required|is_natural',
        ];
        $action = $id === null ? site_url('products') : site_url('products/update/' . $id);
        $title = $id === null ? 'Add Product' : 'Edit Product';
        if (! $this->validate($rules)) {
            return $this->form($title, array_merge($existing ?? [], $data), $this->validator->getErrors(), $action);
        }
        $image = null;
        $error = $this->prepareImage($this->request->getFile('image'), $image);
        if ($error !== null) {
            return $this->form($title, array_merge($existing ?? [], $data), ['image' => $error], $action);
        }
        $data['price'] = number_format((float) $data['price'], 2, '.', '');
        if ($image !== null) $data['image'] = $image;
        try {
            $id === null ? $model->insert($data) : $model->update($id, $data);
        } catch (Throwable $e) {
            if ($image !== null) @unlink(FCPATH . 'uploads/products/' . $image);
            throw $e;
        }
        if ($image !== null && ! empty($existing['image'])) {
            @unlink(FCPATH . 'uploads/products/' . basename($existing['image']));
        }
        return redirect()->to(site_url('products'))->with('message', $id === null ? 'Product added.' : 'Product updated.');
    }

    private function form(string $title, array $product, array $errors, string $action): string
    {
        return view('products/form', compact('title', 'product', 'errors', 'action'));
    }

    private function prepareImage(?UploadedFile $file, ?string &$filename): ?string
    {
        $filename = null;
        if ($file === null || $file->getError() === UPLOAD_ERR_NO_FILE) return null;
        if (! $file->isValid()) return 'The image upload did not finish. Try again.';
        if ($file->getSize() > 2 * 1024 * 1024) return 'Choose an image smaller than 2 MB.';
        if (! in_array($file->getMimeType(), ['image/jpeg', 'image/png'], true)) return 'Choose a JPG or PNG image.';
        $filename = bin2hex(random_bytes(16)) . '.jpg';
        $directory = FCPATH . 'uploads/products';
        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) return 'The image folder is not writable.';
        try {
            service('image', 'gd')->withFile($file->getTempName())->fit(800, 600, 'center')->convert(IMAGETYPE_JPEG)->save($directory . DIRECTORY_SEPARATOR . $filename, 82);
        } catch (Throwable $e) {
            log_message('error', 'Product image preparation failed: {message}', ['message' => $e->getMessage()]);
            return 'The image could not be prepared. Choose another JPG or PNG image.';
        }
        return null;
    }
}
