<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading rise-in"><div><p class="eyebrow">PEOPLE / CUSTOMER DETAILS</p><h1><?= esc($title) ?></h1><p>Keep customer details accurate for sales and receipts.</p></div><a class="text-link" href="<?= site_url('customers') ?>">← Back to customers</a></section>
<div class="form-shell rise-in"><form class="record-form" method="post" action="<?= esc($action, 'attr') ?>">
<?= csrf_field() ?>
<?php foreach ($errors as $error): ?><p class="form-error"><?= esc($error) ?></p><?php endforeach ?>
<div class="form-grid"><label>First name<input name="first_name" maxlength="50" required value="<?= esc(old('first_name', $customer['first_name'] ?? ''), 'attr') ?>"></label>
<label>Last name<input name="last_name" maxlength="50" required value="<?= esc(old('last_name', $customer['last_name'] ?? ''), 'attr') ?>"></label></div>
<div class="form-grid"><label>Email<input type="email" name="email" maxlength="100" required value="<?= esc(old('email', $customer['email'] ?? ''), 'attr') ?>"></label>
<label>Phone<input name="phone" maxlength="20" required value="<?= esc(old('phone', $customer['phone'] ?? ''), 'attr') ?>"></label></div>
<label>Address<textarea name="address" maxlength="255"><?= esc(old('address', $customer['address'] ?? '')) ?></textarea></label>
<label>Status<select name="account_status"><option value="Active" <?= old('account_status', $customer['account_status'] ?? 'Active') === 'Active' ? 'selected' : '' ?>>Active</option><option value="Inactive" <?= old('account_status', $customer['account_status'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option></select></label>
<div class="form-actions"><button class="button" type="submit">Save customer</button><a href="<?= site_url('customers') ?>">Cancel</a></div>
</form>
</div>
<?= view('partials/footer') ?>
