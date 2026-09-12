<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading">
    <p class="eyebrow">Records</p>
    <h1>Customer Accounts</h1>
    <p><?= count($customers) ?> sample customers loaded from a static PHP array.</p>
</section>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= view('partials/footer') ?>
