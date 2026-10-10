<?= view('partials/header', ['title' => $title]) ?>

<?php
$openCount = count(array_filter($tasks, static fn (array $task): bool => $task['status'] !== 'completed'));
$completedCount = count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'completed'));
?>

<section class="task-hero" aria-labelledby="today-title">
    <div><p class="eyebrow">DAILY PLAN <span class="eyebrow-line"></span> <?= esc(date('F j, Y', strtotime($today))) ?></p>
    <h1 id="today-title">Keep today<br><em>moving.</em></h1>
    <p>Your daily plan, connected to the same store workspace. See what is scheduled and keep the team on track.</p>
    <div class="actions"><a class="button" href="<?= site_url('tasks') ?>">View all tasks <span aria-hidden="true">↗</span></a><?php if (session()->get('auth_user_id')): ?><a class="button button-outline-light" href="<?= site_url('tasks/new') ?>">Add a task</a><?php endif ?></div></div>
    <div class="task-hero-date" aria-hidden="true"><span><?= esc(date('M', strtotime($today))) ?></span><strong><?= esc(date('d', strtotime($today))) ?></strong><span><?= esc(date('l', strtotime($today))) ?></span></div>
</section>
<section class="metric-grid task-summary" aria-label="Today's task summary">
    <article class="metric-card"><span class="metric-label">SCHEDULED TODAY</span><strong><?= count($tasks) ?></strong><span>tasks</span></article>
    <article class="metric-card"><span class="metric-label">STILL OPEN</span><strong><?= $openCount ?></strong><span>pending or in progress</span></article>
    <article class="metric-card"><span class="metric-label">FINISHED</span><strong><?= $completedCount ?></strong><span>completed today</span></article>
</section>

<section class="listing" aria-labelledby="today-list-title">
    <div class="section-heading"><div><p class="eyebrow">ON THE BOARD</p><h2 id="today-list-title">Today's tasks</h2></div><a class="text-link" href="<?= site_url('tasks') ?>">Complete schedule <span aria-hidden="true">↗</span></a></div>

    <?php if ($tasks === []): ?>
        <div class="empty-state"><strong>A clear board today</strong><p>No tasks are scheduled for this date. Browse the complete schedule or add the next task.</p><a class="button" href="<?= site_url('tasks') ?>">View all tasks</a></div>
    <?php else: ?>
        <div class="table-wrap"><table><thead><tr><th scope="col">No.</th><th scope="col">Task</th><th scope="col">Status</th></tr></thead><tbody>
            <?php foreach ($tasks as $index => $task): ?>
                <tr><td><?= $index + 1 ?></td><td><strong><?= esc($task['title']) ?></strong></td><td><span class="status <?= $task['status'] === 'completed' ? 'active' : 'inactive' ?>"><?= esc(ucwords($task['status'])) ?></span></td></tr>
            <?php endforeach ?>
        </tbody></table></div>
    <?php endif ?>
</section>

<?= view('partials/footer') ?>
