<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading"><p class="eyebrow">Customer form</p><h1><?= esc($title) ?></h1><p>Enter the account details and save the validated record.</p></section>
<form class="record-form" method="post" action="<?= esc($action, 'attr') ?>">
<?= csrf_field() ?>
<?php foreach ($errors as $error): ?><p class="form-error"><?= esc($error) ?></p><?php endforeach ?>
<label>First name<input name="first_name" maxlength="50" required value="<?= esc(old('first_name', $customer['first_name'] ?? ''), 'attr') ?>"></label>
<label>Last name<input name="last_name" maxlength="50" required value="<?= esc(old('last_name', $customer['last_name'] ?? ''), 'attr') ?>"></label>
<label>Email<input type="email" name="email" maxlength="100" required value="<?= esc(old('email', $customer['email'] ?? ''), 'attr') ?>"></label>
<label>Phone<input name="phone" maxlength="20" required value="<?= esc(old('phone', $customer['phone'] ?? ''), 'attr') ?>"></label>
<label>Address<textarea name="address" maxlength="255"><?= esc(old('address', $customer['address'] ?? '')) ?></textarea></label>
<label>Status<select name="account_status"><option value="Active" <?= old('account_status', $customer['account_status'] ?? 'Active') === 'Active' ? 'selected' : '' ?>>Active</option><option value="Inactive" <?= old('account_status', $customer['account_status'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option></select></label>
<div class="form-actions"><button class="button" type="submit">Save customer</button><a href="<?= site_url('customers') ?>">Cancel</a></div>
</form>
<?= view('partials/footer') ?>
