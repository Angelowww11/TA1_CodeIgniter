<?= view('partials/app_header', ['title' => $title]) ?>

<section class="page-intro" aria-labelledby="tasks-title">
    <p class="kicker">Complete schedule</p>
    <div class="page-intro-grid">
        <h1 id="tasks-title">Every task,<br>ordered by date.</h1>
        <p>This unfiltered view shows all <?= count($tasks) ?> records stored in the tasks table, from earlier work through upcoming priorities.</p>
    </div>
</section>

<section class="content-section" aria-label="All task records">
    <?php if ($tasks === []): ?>
        <div class="empty-state"><h2>No tasks found</h2><p>Seed the database to display the complete schedule.</p></div>
    <?php else: ?>
        <div class="table-card">
            <table>
                <thead>
                    <tr><th scope="col">No.</th><th scope="col">Task</th><th scope="col">Status</th><th scope="col">Task date</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $index => $task): ?>
                        <?php $statusClass = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $task['status'])); ?>
                        <tr>
                            <td class="number-cell"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></td>
                            <td><strong><?= esc($task['title']) ?></strong></td>
                            <td><span class="status status-<?= esc($statusClass, 'attr') ?>"><?= esc(ucwords($task['status'])) ?></span></td>
                            <td><time datetime="<?= esc($task['task_date'], 'attr') ?>"><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></time></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>

<?= view('partials/app_footer') ?>
