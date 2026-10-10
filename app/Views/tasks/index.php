<?= view('partials/header', ['title' => $title]) ?>

<section class="page-heading" aria-labelledby="tasks-title">
    <div><p class="eyebrow">DAILY PLAN / TASKS</p>
    <h1 id="tasks-title">All tasks<span class="heading-period">.</span></h1>
    <p>Keep the store's next steps in view. <?= count($tasks) ?> active tasks, ordered by date.</p></div>
    <?php if (session()->get('auth_user_id')): ?><a class="button" href="<?= site_url('tasks/new') ?>">Add task <span aria-hidden="true">+</span></a><?php endif ?>
</section>
<?php if (session()->getFlashdata('message')): ?><p class="task-notice"><?= esc(session()->getFlashdata('message')) ?></p><?php endif ?>
<?php if (session()->getFlashdata('error')): ?><p class="task-error"><?= esc(session()->getFlashdata('error')) ?></p><?php endif ?>

<section aria-label="All task records">
    <?php if ($tasks === []): ?>
        <div class="empty-state"><strong>No active tasks</strong><p>Tasks you add will appear here. Archived tasks stay in the database.</p><?php if (session()->get('auth_user_id')): ?><a class="button" href="<?= site_url('tasks/new') ?>">Add task</a><?php endif ?></div>
    <?php else: ?>
        <div class="task-filter" role="group" aria-label="Filter tasks by status" data-task-filters><button type="button" class="is-selected" data-status="all" aria-pressed="true">All <span><?= count($tasks) ?></span></button><button type="button" data-status="pending" aria-pressed="false">Pending</button><button type="button" data-status="in progress" aria-pressed="false">In progress</button><button type="button" data-status="completed" aria-pressed="false">Completed</button></div>
        <p class="visually-hidden" aria-live="polite" data-task-count><?= count($tasks) ?> tasks shown</p>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th scope="col">No.</th><th scope="col">Task</th><th scope="col">Status</th><th scope="col">Task date</th><?php if (session()->get('auth_user_id')): ?><th scope="col">Actions</th><?php endif ?></tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $index => $task): ?>
                        <tr data-task-status="<?= esc($task['status'], 'attr') ?>">
                            <td><?= $index + 1 ?></td>
                            <td><strong><?= esc($task['title']) ?></strong></td>
                            <td><span class="status <?= $task['status'] === 'completed' ? 'active' : 'inactive' ?>"><?= esc(ucwords($task['status'])) ?></span></td>
                            <td><time datetime="<?= esc($task['task_date'], 'attr') ?>"><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></time></td>
                            <?php if (session()->get('auth_user_id')): ?><td class="table-actions"><a href="<?= site_url('tasks/edit/' . $task['id']) ?>">Edit</a><form method="post" action="<?= site_url('tasks/archive/' . $task['id']) ?>" onsubmit="return confirm('Archive this task?')"><?= csrf_field() ?><button type="submit">Archive</button></form></td><?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>

<?= view('partials/footer') ?>
