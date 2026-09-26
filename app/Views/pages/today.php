<?= view('partials/app_header', ['title' => $title]) ?>

<?php
$pendingCount = count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'pending'));
$completedCount = count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'completed'));
?>

<section class="today-hero" aria-labelledby="today-title">
    <div class="date-panel" aria-label="Today's date">
        <span class="date-day"><?= esc(date('d', strtotime($today))) ?></span>
        <span class="date-month"><?= esc(strtoupper(date('M', strtotime($today)))) ?></span>
        <span class="date-year"><?= esc(date('Y', strtotime($today))) ?></span>
    </div>
    <div class="hero-copy">
        <p class="kicker">Daily focus</p>
        <h1 id="today-title">Make today count.</h1>
        <p class="hero-summary">Your current priorities are gathered in one place, filtered directly from the tasks database for <?= esc(date('l, F j', strtotime($today))) ?>.</p>
        <div class="hero-stats" aria-label="Today's task summary">
            <div><strong><?= count($tasks) ?></strong><span>Total</span></div>
            <div><strong><?= $pendingCount ?></strong><span>Pending</span></div>
            <div><strong><?= $completedCount ?></strong><span>Completed</span></div>
        </div>
    </div>
</section>

<section class="content-section" aria-labelledby="today-list-title">
    <div class="section-heading">
        <div>
            <p class="kicker">Today&rsquo;s plan</p>
            <h2 id="today-list-title">Tasks on your desk</h2>
        </div>
        <a class="text-link" href="<?= site_url('tasks') ?>">View full task list <span aria-hidden="true">&rarr;</span></a>
    </div>

    <?php if ($tasks === []): ?>
        <div class="empty-state">
            <span class="empty-check" aria-hidden="true">&#10003;</span>
            <h3>No tasks scheduled today</h3>
            <p>Your task list is clear for this date. Check the complete schedule for upcoming work.</p>
        </div>
    <?php else: ?>
        <ol class="task-stack">
            <?php foreach ($tasks as $index => $task): ?>
                <?php $statusClass = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $task['status'])); ?>
                <li class="task-row">
                    <span class="task-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <div class="task-copy">
                        <h3><?= esc($task['title']) ?></h3>
                        <p>Scheduled for today</p>
                    </div>
                    <span class="status status-<?= esc($statusClass, 'attr') ?>"><?= esc(ucwords($task['status'])) ?></span>
                </li>
            <?php endforeach ?>
        </ol>
    <?php endif ?>
</section>

<?= view('partials/app_footer') ?>
