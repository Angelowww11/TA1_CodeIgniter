<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading rise-in"><div><p class="eyebrow">PEOPLE / STAFF</p><h1>Staff</h1><p><?= count($users) ?> staff accounts in your store workspace.</p></div><a class="button" href="<?= site_url('users/new') ?>">Add staff <span aria-hidden="true">+</span></a></section>
<?php if (session()->getFlashdata('message')): ?><p class="notice"><?= esc(session()->getFlashdata('message')) ?></p><?php endif ?>
<?php if (session()->getFlashdata('error')): ?><p class="form-error" role="alert"><?= esc(session()->getFlashdata('error')) ?></p><?php endif ?>
<div class="table-wrap rise-in"><table><thead><tr><th>Avatar</th><th>Username</th><th>Full name</th><th>Role</th><th>Status</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($users as $user): ?><tr>
<td><img class="avatar-thumb" src="<?= ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode(basename($user['avatar']))) : base_url('images/avatar-placeholder.svg') ?>" alt="Avatar for <?= esc(trim($user['first_name'] . ' ' . $user['last_name']), 'attr') ?>"></td>
<td><code><?= esc($user['username']) ?></code></td><td><strong><?= esc(trim($user['first_name'] . ' ' . $user['last_name'])) ?></strong></td><td><span class="role"><?= esc($user['role']) ?></span></td><td><span class="status <?= strtolower(esc($user['account_status'], 'attr')) ?>"><?= esc($user['account_status']) ?></span></td><td><div class="table-actions"><a href="<?= site_url('users/edit/' . $user['user_id']) ?>">Edit</a><form method="post" action="<?= site_url('users/delete/' . $user['user_id']) ?>" onsubmit="return confirm('Delete this staff account?')"><?= csrf_field() ?><button type="submit">Delete</button></form></div></td>
</tr><?php endforeach ?>
</tbody></table></div>
<?= view('partials/footer') ?>
