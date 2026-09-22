<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading">
    <p class="eyebrow">Records</p>
    <h1>Customer Accounts</h1>
    <p><?= count($customers) ?> customer accounts loaded from the MySQL database.</p>
</section>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td><span class="status <?= strtolower(esc($customer['account_status'], 'attr')) ?>"><?= esc($customer['account_status']) ?></span></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= view('partials/footer') ?>
