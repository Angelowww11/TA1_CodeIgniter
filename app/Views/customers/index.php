<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading">
    <p class="eyebrow">Records</p><h1>Customer Accounts</h1>
    <p><?= count($customers) ?> customer accounts in the POS database.</p>
    <p><a class="button" href="<?= site_url('customers/new') ?>">Add customer</a></p>
</section>
<?php if (session()->getFlashdata('message')): ?><p class="notice"><?= esc(session()->getFlashdata('message')) ?></p><?php endif ?>
<div class="table-wrap"><table><thead><tr><th>Full Name</th><th>Email</th><th>Phone</th><th>Status</th><th>Action</th></tr></thead><tbody>
<?php foreach ($customers as $customer): ?><tr>
<td><?= esc(trim($customer['first_name'] . ' ' . $customer['last_name'])) ?></td><td><?= esc($customer['email']) ?></td><td><?= esc($customer['phone']) ?></td><td><?= esc($customer['account_status']) ?></td><td><a href="<?= site_url('customers/edit/' . $customer['customer_id']) ?>">Edit</a></td>
</tr><?php endforeach ?>
</tbody></table></div>
<?= view('partials/footer') ?>
