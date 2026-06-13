<h1>Timeline</h1>

<a href="/dashboard">Back to Dashboard</a>

<br><br>

<a href="/timeline?view=deadlines">Timeline - Deadlines</a>
|
<a href="/timeline?view=activity">Timeline - Activity</a>

<hr>

<?php if ($view === 'activity'): ?>

    <h2>Activity Timeline</h2>

    <?php if (empty($logs)): ?>
        <p>No activity yet.</p>
    <?php else: ?>
        <?php foreach ($logs as $log): ?>
            <div>
                <p><?= esc($log['message']) ?></p>

                <?php if (! empty($log['project_title'])): ?>
                    <p>Project: <?= esc($log['project_title']) ?></p>
                <?php endif; ?>

                <small><?= esc($log['formatted_time']) ?></small>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

<?php else: ?>

    <h2>Deadline Timeline</h2>

    <?php if (empty($deadlines)): ?>
        <p>No deadlines yet.</p>
    <?php else: ?>
        <?php foreach ($deadlines as $task): ?>
            <div>
                <h3><?= esc($task['title']) ?></h3>

                <p>Project: <?= esc($task['project_title']) ?></p>
                <p>Status: <?= esc($task['status']) ?></p>
                <p>Priority: <?= esc($task['priority']) ?></p>
                <p>Assignee: <?= esc($task['assignee_name'] ?? 'Unassigned') ?></p>
                <p>Deadline: <?= esc($task['deadline']) ?></p>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

<?php endif; ?>