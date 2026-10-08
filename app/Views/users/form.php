<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading rise-in"><div><p class="eyebrow">PEOPLE / STAFF DETAILS</p><h1><?= esc($title) ?></h1><p>Manage access, identity, and the staff profile image.</p></div><a class="text-link" href="<?= site_url('users') ?>">← Back to staff</a></section>
<div class="form-shell rise-in"><form class="record-form" method="post" enctype="multipart/form-data" action="<?= esc($action, 'attr') ?>">
<?= csrf_field() ?>
<?php foreach ($errors as $error): ?><p class="form-error"><?= esc($error) ?></p><?php endforeach ?>
<div class="form-grid"><label>Username<input name="username" minlength="4" maxlength="50" required value="<?= esc(old('username', $user['username'] ?? ''), 'attr') ?>"></label>
<label>Full name<input name="full_name" maxlength="101" required value="<?= esc(old('full_name', $user['full_name'] ?? trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''))), 'attr') ?>"></label></div>
<label>Email<input type="email" name="email" maxlength="100" required value="<?= esc(old('email', $user['email'] ?? ''), 'attr') ?>"></label>
<label>Password<input type="password" name="password" minlength="12" <?= $editing ? '' : 'required' ?> autocomplete="new-password"><small><?= $editing ? 'Leave blank to keep the current password.' : 'Use at least 12 characters.' ?></small></label>
<label>Role<select name="role"><option value="">Choose a role</option><?php foreach (['Admin', 'Manager', 'Cashier'] as $role): ?><option value="<?= esc($role, 'attr') ?>" <?= old('role', $user['role'] ?? '') === $role ? 'selected' : '' ?>><?= esc($role) ?></option><?php endforeach ?></select></label>
<label>Status<select name="account_status"><option value="Active" <?= old('account_status', $user['account_status'] ?? 'Active') === 'Active' ? 'selected' : '' ?>>Active</option><option value="Inactive" <?= old('account_status', $user['account_status'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option></select></label>
<label><span>Profile picture <span class="optional">optional</span></span><input type="file" name="avatar" accept="image/jpeg,image/png"><small>JPG or PNG up to 2 MB, prepared as a 320 × 320 thumbnail.</small></label>
<?php if (! empty($user['avatar'])): ?><img class="avatar-preview" src="<?= site_url('media/' . rawurlencode(basename($user['avatar']))) ?>" alt="Current profile picture"><?php endif ?>
<div class="form-actions"><button class="button" type="submit">Save user</button><a href="<?= site_url('users') ?>">Cancel</a></div>
</form>
</div>
<?= view('partials/footer') ?>

