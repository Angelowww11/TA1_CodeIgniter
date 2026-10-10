<?= view('partials/header', ['title' => $title]) ?>
<section class="dashboard-hero rise-in">
    <div class="hero-copy">
        <p class="eyebrow light">YOUR STORE <span class="eyebrow-line"></span> AT A GLANCE</p>
        <h1>Make every<br><em>day count.</em></h1>
        <p>A clear view of the products on your shelves and the sales through your counter.</p>
        <div class="actions"><a class="button button-light" href="<?= site_url('sales/new') ?>">Record a sale <span aria-hidden="true">↗</span></a><a class="button button-outline-light" href="<?= site_url('products') ?>">View inventory</a></div>
    </div>
    <div class="hero-stage">
        <div class="hero-photo hero-photo-main"><img src="<?= base_url('uploads/products/catalog-ceramic-mug.jpg') ?>" alt="White ceramic coffee mug on a light surface"></div>
        <div class="hero-photo hero-photo-side"><img src="<?= base_url('uploads/products/catalog-notebook.jpg') ?>" alt="Open notebook with pen"></div>
        <div class="receipt-preview" aria-label="Recent sales summary">
        <div class="receipt-top"><span>SALES LEDGER</span><span>LIVE</span></div>
        <strong><?= number_format($saleCount) ?></strong><span class="receipt-caption">transactions recorded</span>
        <div class="receipt-rule"></div>
        <div class="receipt-total"><span>Total sales</span><b>₱<?= number_format((float) $salesTotal, 2) ?></b></div>
        <div class="receipt-bottom">SIMPLEPOS / STORE OPERATIONS</div>
        </div>
    </div>
</section>
<section class="section-block rise-in" aria-labelledby="at-a-glance">
    <div class="section-heading"><div><p class="eyebrow">AT A GLANCE</p><h2 id="at-a-glance">Your store today</h2></div><p>Current inventory and recorded sales.</p></div>
    <div class="metric-grid">
        <a class="metric-card" href="<?= site_url('products') ?>"><span class="metric-label">ACTIVE PRODUCTS</span><strong><?= number_format($productCount) ?></strong><span>Browse inventory <span aria-hidden="true">↗</span></span></a>
        <a class="metric-card" href="<?= site_url('products') ?>"><span class="metric-label">LOW STOCK</span><strong><?= number_format($lowStock) ?></strong><span>5 units or fewer <span aria-hidden="true">↗</span></span></a>
        <a class="metric-card" href="<?= site_url('sales') ?>"><span class="metric-label">SALES RECORDED</span><strong><?= number_format($saleCount) ?></strong><span>Open sales history <span aria-hidden="true">↗</span></span></a>
    </div>
</section>
<section class="section-block rise-in" aria-labelledby="recent-heading">
    <div class="section-heading"><div><p class="eyebrow">TRANSACTION LOG</p><h2 id="recent-heading">Recent sales</h2></div><a class="text-link" href="<?= site_url('sales') ?>">View all sales <span aria-hidden="true">↗</span></a></div>
    <?php if ($recent): ?><div class="table-wrap"><table><thead><tr><th>Sale</th><th>Product</th><th>Staff</th><th>Quantity</th><th>Total</th><th>Date</th></tr></thead><tbody>
    <?php foreach ($recent as $sale): ?><tr><td class="id-cell">#<?= esc($sale['id']) ?></td><td><strong><?= esc($sale['product_name']) ?></strong></td><td><?= esc($sale['staff_first_name']) ?></td><td><?= esc($sale['quantity']) ?></td><td class="money">₱<?= number_format((float) $sale['total_price'], 2) ?></td><td><?= esc(date('M j, Y', strtotime($sale['created_at']))) ?></td></tr><?php endforeach ?>
    </tbody></table></div><?php else: ?><div class="empty-state"><strong>No sales yet</strong><p>Record your first sale to start the transaction history.</p><a class="button" href="<?= site_url('sales/new') ?>">Record a sale</a></div><?php endif ?>
</section>
<?= view('partials/footer') ?>
