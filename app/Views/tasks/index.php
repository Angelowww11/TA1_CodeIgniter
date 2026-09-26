<?= view('partials/app_header', ['title' => $title]) ?>

<section class="page-heading" aria-labelledby="tasks-title">
    <p class="eyebrow">Complete schedule</p>
    <h1 id="tasks-title">All Tasks</h1>
    <p>Every task stored in the database, ordered by date. <?= count($tasks) ?> records are currently available.</p>
</section>

<section aria-label="All task records">
    <?php if ($tasks === []): ?>
        <div class="card"><h2>No tasks found</h2><p>Seed the database to display the complete schedule.</p></div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th scope="col">No.</th><th scope="col">Task</th><th scope="col">Status</th><th scope="col">Task date</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $index => $task): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><strong><?= esc($task['title']) ?></strong></td>
                            <td><span class="status <?= $task['status'] === 'completed' ? 'active' : 'inactive' ?>"><?= esc(ucwords($task['status'])) ?></span></td>
                            <td><time datetime="<?= esc($task['task_date'], 'attr') ?>"><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></time></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>

<?= view('partials/app_footer') ?>
