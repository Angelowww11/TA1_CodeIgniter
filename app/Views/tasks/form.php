<?= view('partials/header', ['title' => $title]) ?>
<section class="page-heading"><div><p class="eyebrow">DAILY PLAN / TASK DETAILS</p><h1><?= esc($title) ?><span class="heading-period">.</span></h1><p>Give the task a clear title, date, and status.</p></div><a class="text-link" href="<?= site_url('tasks') ?>">← Back to tasks</a></section>
<div class="form-shell">
<form class="record-form" method="post" action="<?= $task ? site_url('tasks/update/' . $task['id']) : site_url('tasks') ?>">
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
    <div class="form-actions"><button class="button" type="submit"><?= $task ? 'Save changes' : 'Create task' ?></button><a href="<?= site_url('tasks') ?>">Cancel</a></div>
</form>
</div>
<?= view('partials/footer') ?>
