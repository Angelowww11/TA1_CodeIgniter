<?= view('partials/header', ['title' => $title]) ?>
<section class="dashboard-hero rise-in" data-parallax-hero>
    <img class="dashboard-hero-image" src="<?= base_url('images/forest-island.png') ?>" alt="Moss-covered floating stone island in warm daylight">
    <div class="hero-copy">
        <p class="eyebrow light">THE STORE, IN MOTION <span class="eyebrow-line"></span> SIMPLEPOS</p>
        <h1>Every day,<br><em>well run.</em></h1>
        <p>One clear place for stock, sales, people, and the work ahead.</p>
        <div class="actions"><a class="button button-light" href="<?= site_url('sales/new') ?>">Record a sale <span aria-hidden="true">↗</span></a><a class="button button-outline-light" href="<?= site_url('tasks') ?>">Open tasks</a></div>
    </div>
    <div class="hero-index" aria-hidden="true"><span>OPERATIONS / 01</span><i></i><span>AT A GLANCE</span></div>
    <div class="receipt-preview" aria-label="Recent sales summary">
        <div class="receipt-top"><span>SALES LEDGER</span><span>LIVE</span></div>
        <strong><?= number_format($saleCount) ?></strong><span class="receipt-caption">transactions recorded</span>
        <div class="receipt-rule"></div>
        <div class="receipt-total"><span>Total sales</span><b>₱<?= number_format((float) $salesTotal, 2) ?></b></div>
        <div class="receipt-bottom">SIMPLEPOS / STORE OPERATIONS</div>
    </div>
</section>
<section class="section-block rise-in" aria-labelledby="at-a-glance">
    <div class="section-heading"><div><p class="eyebrow">AT A GLANCE</p><h2 id="at-a-glance">Your store today</h2></div><p>Current inventory, recorded sales, and the day's plan.</p></div>
    <div class="metric-grid">
        <a class="metric-card" href="<?= site_url('products') ?>"><span class="metric-label">ACTIVE PRODUCTS</span><strong><?= number_format($productCount) ?></strong><span>Browse inventory <span aria-hidden="true">↗</span></span></a>
        <a class="metric-card" href="<?= site_url('products') ?>"><span class="metric-label">LOW STOCK</span><strong><?= number_format($lowStock) ?></strong><span>5 units or fewer <span aria-hidden="true">↗</span></span></a>
        <a class="metric-card" href="<?= site_url('sales') ?>"><span class="metric-label">SALES RECORDED</span><strong><?= number_format($saleCount) ?></strong><span>Open sales history <span aria-hidden="true">↗</span></span></a>
        <a class="metric-card" href="<?= site_url('today') ?>"><span class="metric-label">TASKS TODAY</span><strong><?= number_format(count($todayTasks)) ?></strong><span>Open daily plan <span aria-hidden="true">↗</span></span></a>
    </div>
</section>
<section class="section-block daily-plan-preview rise-in" aria-labelledby="daily-plan-heading">
    <div class="section-heading"><div><p class="eyebrow">DAILY PLAN</p><h2 id="daily-plan-heading">What needs attention</h2></div><a class="text-link" href="<?= site_url('tasks') ?>">Manage tasks <span aria-hidden="true">↗</span></a></div>
    <?php if ($todayTasks): ?><div class="plan-list">
        <?php foreach (array_slice($todayTasks, 0, 4) as $task): ?><a href="<?= site_url('tasks') ?>" class="plan-row"><span class="plan-marker <?= $task['status'] === 'completed' ? 'is-complete' : '' ?>" aria-hidden="true"></span><strong><?= esc($task['title']) ?></strong><span class="status <?= $task['status'] === 'completed' ? 'active' : 'inactive' ?>"><?= esc(ucwords($task['status'])) ?></span><span aria-hidden="true">↗</span></a><?php endforeach ?>
    </div><?php else: ?><div class="empty-state"><strong>No tasks scheduled today</strong><p>Use Tasks to plan the next step for your store.</p><a class="button" href="<?= site_url('tasks/new') ?>">Add a task</a></div><?php endif ?>
</section>
<section class="section-block rise-in" aria-labelledby="recent-heading">
    <div class="section-heading"><div><p class="eyebrow">TRANSACTION LOG</p><h2 id="recent-heading">Recent sales</h2></div><a class="text-link" href="<?= site_url('sales') ?>">View all sales <span aria-hidden="true">↗</span></a></div>
    <?php if ($recent): ?><div class="table-wrap"><table><thead><tr><th>Sale</th><th>Product</th><th>Staff</th><th>Quantity</th><th>Total</th><th>Date</th></tr></thead><tbody>
    <?php foreach ($recent as $sale): ?><tr><td class="id-cell">#<?= esc($sale['id']) ?></td><td><strong><?= esc($sale['product_name']) ?></strong></td><td><?= esc($sale['staff_first_name']) ?></td><td><?= esc($sale['quantity']) ?></td><td class="money">₱<?= number_format((float) $sale['total_price'], 2) ?></td><td><?= esc(date('M j, Y', strtotime($sale['created_at']))) ?></td></tr><?php endforeach ?>
    </tbody></table></div><?php else: ?><div class="empty-state"><strong>No sales yet</strong><p>Record your first sale to start the transaction history.</p><a class="button" href="<?= site_url('sales/new') ?>">Record a sale</a></div><?php endif ?>
</section>
<?= view('partials/footer') ?>
