<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading rise-in"><div><p class="eyebrow">INVENTORY</p><h1>Products</h1><p>Manage prices, stock, images, and archived items.</p></div><a class="button" href="<?= site_url('products/new') ?>">Add product <span aria-hidden="true">+</span></a></section>
<?php if (session()->getFlashdata('message')): ?><p class="notice" role="status"><?= esc(session()->getFlashdata('message')) ?></p><?php endif ?>
<?php if ($products): ?><div class="product-grid rise-in">
<?php foreach ($products as $product): ?><article class="product-card <?= $product['is_archived'] ? 'is-archived' : '' ?>">
    <div class="product-art">
        <?php if ($product['image']): ?><img src="<?= site_url('media/' . rawurlencode(basename($product['image']))) ?>" alt="<?= esc($product['name'], 'attr') ?>" loading="lazy"><?php else: ?><span class="product-placeholder" aria-hidden="true"><span></span><span></span><span></span><span></span></span><?php endif ?>
        <?php if ($product['is_archived']): ?><span class="art-tag">Archived</span><?php elseif ((int) $product['stock_quantity'] <= 5): ?><span class="art-tag alert">Low stock</span><?php endif ?>
    </div>
    <div class="product-content"><span class="sku-label"><?= esc($product['sku']) ?></span><h2><?= esc($product['name']) ?></h2><div class="product-meta"><strong>₱<?= number_format((float) $product['price'], 2) ?></strong><span><?= esc($product['stock_quantity']) ?> in stock</span></div>
    <div class="product-actions"><a href="<?= site_url('products/edit/' . $product['id']) ?>">Edit product</a><?php if (! $product['is_archived']): ?><form method="post" action="<?= site_url('products/archive/' . $product['id']) ?>" onsubmit="return confirm('Archive this product?')"><?= csrf_field() ?><button type="submit">Archive</button></form><?php endif ?></div></div>
</article><?php endforeach ?></div><?php else: ?><div class="empty-state"><strong>No products yet</strong><p>Add a product to prepare the store for sales.</p><a class="button" href="<?= site_url('products/new') ?>">Add product</a></div><?php endif ?>
<?= view('partials/footer') ?>
