<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading rise-in"><div><p class="eyebrow">INVENTORY / PRODUCT DETAILS</p><h1><?= esc($title) ?></h1><p>Set the price and available stock. A clear product image helps staff find it quickly.</p></div><a class="text-link" href="<?= site_url('products') ?>">← Back to products</a></section>
<div class="form-shell rise-in"><form class="record-form" method="post" enctype="multipart/form-data" action="<?= esc($action, 'attr') ?>">
<?= csrf_field() ?>
<?php foreach ($errors as $error): ?><p class="form-error" role="alert"><?= esc($error) ?></p><?php endforeach ?>
<div class="form-grid"><label>Product name<input name="name" maxlength="100" required value="<?= esc(old('name', $product['name'] ?? ''), 'attr') ?>" placeholder="e.g. Thermal receipt roll"></label><label>SKU<input name="sku" maxlength="40" required value="<?= esc(old('sku', $product['sku'] ?? ''), 'attr') ?>" placeholder="e.g. ROLL-001"></label></div>
<div class="form-grid"><label>Price (₱)<input name="price" type="number" min="0" max="99999999.99" step="0.01" required value="<?= esc(old('price', $product['price'] ?? ''), 'attr') ?>"></label><label>Units in stock<input name="stock_quantity" type="number" min="0" step="1" required value="<?= esc(old('stock_quantity', $product['stock_quantity'] ?? '0'), 'attr') ?>"></label></div>
<label><span>Product image <span class="optional">optional</span></span><input type="file" name="image" accept="image/jpeg,image/png"><small>JPG or PNG, up to 2 MB. Images are prepared as 800 × 600 JPGs.</small></label>
<?php if (! empty($product['image'])): ?><img class="product-preview" src="<?= base_url('uploads/products/' . rawurlencode(basename($product['image']))) ?>" alt="Current product image"><?php endif ?>
<div class="form-actions"><button class="button" type="submit">Save product</button><a href="<?= site_url('products') ?>">Cancel</a></div>
</form></div>
<?= view('partials/footer') ?>

