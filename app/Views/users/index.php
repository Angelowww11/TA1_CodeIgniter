<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading">
    <p class="eyebrow">Records</p>
    <h1>User Accounts</h1>
    <p><?= count($users) ?> sample staff accounts loaded from a static PHP array.</p>
</section>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><code><?= esc($user['username']) ?></code></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><span class="role"><?= esc($user['role']) ?></span></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= view('partials/footer') ?>
