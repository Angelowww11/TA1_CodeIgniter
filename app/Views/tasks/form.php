<?= view('partials/app_header', ['title' => $title]) ?>
<section class="page-heading"><p class="eyebrow">Task management</p><h1><?= esc($title) ?></h1><p>Fill in the title and date. Both are required.</p></section>
<div class="task-form-card">
<form method="post" action="<?= $task ? site_url('tasks/update/' . $task['id']) : site_url('tasks') ?>">
    <?= csrf_field() ?>
    <label for="title">Task title <span aria-hidden="true">*</span></label>
    <input id="title" name="title" type="text" maxlength="150" required value="<?= esc(old('title', $task['title'] ?? ''), 'attr') ?>">
    <?php if (isset($errors['title'])): ?><p class="task-error"><?= esc($errors['title']) ?></p><?php endif ?>
    <label for="task_date">Task date <span aria-hidden="true">*</span></label>
    <input id="task_date" name="task_date" type="date" required value="<?= esc(old('task_date', $task['task_date'] ?? ''), 'attr') ?>">
    <?php if (isset($errors['task_date'])): ?><p class="task-error"><?= esc($errors['task_date']) ?></p><?php endif ?>
    <label for="status">Status</label>
    <?php $selected = old('status', $task['status'] ?? 'pending'); ?>
    <select id="status" name="status"><option value="pending" <?= $selected === 'pending' ? 'selected' : '' ?>>Pending</option><option value="in progress" <?= $selected === 'in progress' ? 'selected' : '' ?>>In progress</option><option value="completed" <?= $selected === 'completed' ? 'selected' : '' ?>>Completed</option></select>
    <?php if (isset($errors['status'])): ?><p class="task-error"><?= esc($errors['status']) ?></p><?php endif ?>
    <div class="actions"><button class="button" type="submit"><?= $task ? 'Save changes' : 'Create task' ?></button><a class="button secondary" href="<?= site_url('tasks') ?>">Cancel</a></div>
</form>
</div>
<?= view('partials/app_footer') ?>
