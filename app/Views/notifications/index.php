<h1>Notifications</h1>

<a href="/dashboard">Back to Dashboard</a>

<p>Total task notifications: <?= esc($notificationCount) ?></p>

<hr>

<h2>Overdue Tasks</h2>

<?php if (empty($overdueTasks)): ?>
    <p>No overdue tasks.</p>
<?php else: ?>
    <?php foreach ($overdueTasks as $task): ?>
        <div>
            <h3><?= esc($task['title']) ?></h3>
            <p>Project: <?= esc($task['project_title']) ?></p>
            <p>Assignee: <?= esc($task['assignee_name'] ?? 'Unassigned') ?></p>
            <p>Deadline: <?= esc($task['deadline']) ?></p>
            <p>Status: <?= esc($task['status']) ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<h2>Due Today</h2>

<?php if (empty($dueTodayTasks)): ?>
    <p>No tasks due today.</p>
<?php else: ?>
    <?php foreach ($dueTodayTasks as $task): ?>
        <div>
            <h3><?= esc($task['title']) ?></h3>
            <p>Project: <?= esc($task['project_title']) ?></p>
            <p>Assignee: <?= esc($task['assignee_name'] ?? 'Unassigned') ?></p>
            <p>Deadline: <?= esc($task['deadline']) ?></p>
            <p>Status: <?= esc($task['status']) ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<h2>Upcoming Deadlines</h2>

<?php if (empty($upcomingTasks)): ?>
    <p>No upcoming deadlines.</p>
<?php else: ?>
    <?php foreach ($upcomingTasks as $task): ?>
        <div>
            <h3><?= esc($task['title']) ?></h3>
            <p>Project: <?= esc($task['project_title']) ?></p>
            <p>Assignee: <?= esc($task['assignee_name'] ?? 'Unassigned') ?></p>
            <p>Deadline: <?= esc($task['deadline']) ?></p>
            <p>Status: <?= esc($task['status']) ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<h2>Recent Activity</h2>

<?php if (empty($recentLogs)): ?>
    <p>No recent activity.</p>
<?php else: ?>
    <?php foreach ($recentLogs as $log): ?>
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