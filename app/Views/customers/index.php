<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading rise-in"><div><p class="eyebrow">PEOPLE / CUSTOMERS</p><h1>Customers</h1><p><?= count($customers) ?> customer accounts in your store records.</p></div><a class="button" href="<?= site_url('customers/new') ?>">Add customer <span aria-hidden="true">+</span></a></section>
<?php if (session()->getFlashdata('message')): ?><p class="notice"><?= esc(session()->getFlashdata('message')) ?></p><?php endif ?>
<?php if (session()->getFlashdata('error')): ?><p class="form-error" role="alert"><?= esc(session()->getFlashdata('error')) ?></p><?php endif ?>
<div class="table-wrap rise-in"><table><thead><tr><th>Full name</th><th>Email</th><th>Phone</th><th>Status</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($customers as $customer): ?><tr>
<td><strong><?= esc(trim($customer['first_name'] . ' ' . $customer['last_name'])) ?></strong></td><td><?= esc($customer['email']) ?></td><td><?= esc($customer['phone']) ?></td><td><span class="status <?= strtolower(esc($customer['account_status'], 'attr')) ?>"><?= esc($customer['account_status']) ?></span></td><td><div class="table-actions"><a href="<?= site_url('customers/edit/' . $customer['customer_id']) ?>">Edit</a><form method="post" action="<?= site_url('customers/delete/' . $customer['customer_id']) ?>" onsubmit="return confirm('Delete this customer?')"><?= csrf_field() ?><button type="submit">Delete</button></form></div></td>
</tr><?php endforeach ?>
</tbody></table></div>
<?= view('partials/footer') ?>
