<?= view('partials/app_header', ['title' => $title]) ?>

<?php
$openCount = count(array_filter($tasks, static fn (array $task): bool => $task['status'] !== 'completed'));
$completedCount = count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'completed'));
?>

<section class="hero" aria-labelledby="today-title">
    <p class="eyebrow">Daily focus &middot; <?= esc(date('F j, Y', strtotime($today))) ?></p>
    <h1 id="today-title">Tasks for Today</h1>
    <p>See what is scheduled for <?= esc(date('l, F j', strtotime($today))) ?>. Today's tasks are selected directly from the database.</p>
    <div class="actions"><a class="button" href="<?= site_url('tasks') ?>">View all tasks</a><a class="button secondary" href="<?= site_url('about') ?>">About this system</a></div>
</section>
<section class="card-grid summary-grid" aria-label="Today's task summary">
    <article class="card"><span class="card-number">01 / TOTAL</span><h2><?= count($tasks) ?> tasks</h2><p>Scheduled for today</p></article>
    <article class="card"><span class="card-number">02 / OPEN</span><h2><?= $openCount ?> open</h2><p>Pending or in progress</p></article>
    <article class="card"><span class="card-number">03 / COMPLETED</span><h2><?= $completedCount ?> completed</h2><p>Finished today</p></article>
</section>

<section class="listing" aria-labelledby="today-list-title">
    <h2 id="today-list-title">Today's task list</h2>

    <?php if ($tasks === []): ?>
        <div class="card"><p>No tasks scheduled today. <a href="<?= site_url('tasks') ?>">Check the complete schedule</a>.</p></div>
    <?php else: ?>
        <div class="table-wrap"><table><thead><tr><th scope="col">No.</th><th scope="col">Task</th><th scope="col">Status</th></tr></thead><tbody>
            <?php foreach ($tasks as $index => $task): ?>
                <tr><td><?= $index + 1 ?></td><td><strong><?= esc($task['title']) ?></strong></td><td><span class="status <?= $task['status'] === 'completed' ? 'active' : 'inactive' ?>"><?= esc(ucwords($task['status'])) ?></span></td></tr>
            <?php endforeach ?>
        </tbody></table></div>
    <?php endif ?>
</section>

<?= view('partials/app_footer') ?>
