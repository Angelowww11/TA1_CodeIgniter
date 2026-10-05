<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading rise-in"><div><p class="eyebrow">CHECKOUT</p><h1>Record a sale</h1><p>Select a product and quantity. The total is saved at today’s price and stock updates immediately.</p></div><a class="text-link" href="<?= site_url('sales') ?>">← Sales history</a></section>
<div class="form-shell rise-in"><form class="record-form" method="post" action="<?= site_url('sales') ?>">
<?= csrf_field() ?>
<?php foreach ($errors as $error): ?><p class="form-error" role="alert"><?= esc($error) ?></p><?php endforeach ?>
<label>Product<select name="product_id" id="sale-product" required><option value="">Choose a product</option><?php foreach ($products as $product): ?><option value="<?= esc($product['id'], 'attr') ?>" data-price="<?= esc($product['price'], 'attr') ?>" data-stock="<?= esc($product['stock_quantity'], 'attr') ?>" <?= old('product_id', $input['product_id'] ?? '') == $product['id'] ? 'selected' : '' ?>><?= esc($product['name']) ?> — ₱<?= number_format((float) $product['price'], 2) ?> (<?= esc($product['stock_quantity']) ?> available)</option><?php endforeach ?></select></label>
<div class="form-grid"><label>Quantity<input name="quantity" id="sale-quantity" type="number" min="1" step="1" required value="<?= esc(old('quantity', $input['quantity'] ?? '1'), 'attr') ?>"></label><label><span>Customer <span class="optional">optional</span></span><select name="customer_id"><option value="">Walk-in customer</option><?php foreach ($customers as $customer): ?><option value="<?= esc($customer['customer_id'], 'attr') ?>" <?= old('customer_id', $input['customer_id'] ?? '') == $customer['customer_id'] ? 'selected' : '' ?>><?= esc($customer['first_name'] . ' ' . $customer['last_name']) ?></option><?php endforeach ?></select></label></div>
<div class="sale-estimate"><div><span>Estimated total</span><strong id="sale-total">₱0.00</strong></div><small>Final total is confirmed when the sale is recorded.</small></div>
<div class="form-actions"><button class="button" type="submit" <?= $products ? '' : 'disabled' ?>>Record sale</button><a href="<?= site_url('sales') ?>">Cancel</a></div>
<?php if (! $products): ?><p class="form-error">Add an active product before recording a sale.</p><?php endif ?>
</form></div>
<script>
(() => {
  const product = document.getElementById('sale-product');
  const quantity = document.getElementById('sale-quantity');
  const total = document.getElementById('sale-total');
  const update = () => { const selected = product.selectedOptions[0]; const cents = Math.round(Number(selected?.dataset.price || 0) * 100); const count = Math.max(0, Number(quantity.value) || 0); total.textContent = '₱' + ((cents * count) / 100).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); };
  product.addEventListener('change', update); quantity.addEventListener('input', update); update();
})();
</script>
<?= view('partials/footer') ?>

