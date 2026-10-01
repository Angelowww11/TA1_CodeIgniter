<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading"><p class="eyebrow">Records</p><h1>User Accounts</h1><p><?= count($users) ?> staff accounts in the POS database.</p><p><a class="button" href="<?= site_url('users/new') ?>">Add user</a></p></section>
<?php if (session()->getFlashdata('message')): ?><p class="notice"><?= esc(session()->getFlashdata('message')) ?></p><?php endif ?>
<div class="table-wrap"><table><thead><tr><th>Avatar</th><th>Username</th><th>Full Name</th><th>Role</th><th>Status</th><th>Action</th></tr></thead><tbody>
<?php foreach ($users as $user): ?><tr>
<td><img class="avatar-thumb" src="<?= ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode(basename($user['avatar']))) : base_url('images/avatar-placeholder.svg') ?>" alt="Avatar for <?= esc(trim($user['first_name'] . ' ' . $user['last_name']), 'attr') ?>"></td>
<td><code><?= esc($user['username']) ?></code></td><td><?= esc(trim($user['first_name'] . ' ' . $user['last_name'])) ?></td><td><?= esc($user['role']) ?></td><td><?= esc($user['account_status']) ?></td><td><a href="<?= site_url('users/edit/' . $user['user_id']) ?>">Edit</a></td>
</tr><?php endforeach ?>
</tbody></table></div>
<?= view('partials/footer') ?>
