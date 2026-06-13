<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>

    <header>
        <h1>Search</h1>

        <nav>
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> |
            <a href="<?= site_url('projects') ?>">Projects</a> |
            <a href="<?= site_url('timeline') ?>">Timeline</a> |
            <a href="<?= site_url('notifications') ?>">Notifications</a> |
            <a href="<?= site_url('settings') ?>">Settings</a> |
            <a href="<?= site_url('logout') ?>">Logout</a>
        </nav>

        <hr>
    </header>

    <main>
        <h2>Search Results</h2>

        <form method="get" action="<?= site_url('search') ?>">
            <label for="q">Search projects or tasks:</label>
            <input
                type="text"
                id="q"
                name="q"
                value="<?= esc($q ?? '') ?>"
                placeholder="Type keyword"
            >
            <button type="submit">Search</button>
        </form>

        <hr>

        <?php if (($q ?? '') === ''): ?>

            <p>Type something in the search bar.</p>

        <?php else: ?>

            <p>
                Showing results for:
                <strong><?= esc($q) ?></strong>
            </p>

            <section>
                <h3>Projects</h3>

                <?php if (empty($projects)): ?>

                    <p>No projects found.</p>

                <?php else: ?>

                    <p>Total projects found: <?= count($projects) ?></p>

                    <?php foreach ($projects as $project): ?>
                        <article>
                            <h4>
                                <a href="<?= site_url('projects/' . $project['id']) ?>">
                                    <?= esc($project['title']) ?>
                                </a>
                            </h4>

                            <p>
                                <?= esc($project['description'] ?? 'No description') ?>
                            </p>

                            <p>
                                Status: <?= esc($project['status'] ?? '-') ?>
                            </p>
                        </article>

                        <hr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </section>

            <section>
                <h3>Tasks</h3>

                <?php if (empty($tasks)): ?>

                    <p>No tasks found.</p>

                <?php else: ?>

                    <p>Total tasks found: <?= count($tasks) ?></p>

                    <?php foreach ($tasks as $task): ?>
                        <article>
                            <h4>
                                <a href="<?= site_url('projects/' . $task['project_id']) ?>">
                                    <?= esc($task['title']) ?>
                                </a>
                            </h4>

                            <p>
                                Project: <?= esc($task['project_title'] ?? '-') ?>
                            </p>

                            <p>
                                Assignee: <?= esc($task['assignee_name'] ?? 'Unassigned') ?>
                            </p>

                            <p>
                                Status: <?= esc($task['status'] ?? '-') ?>
                            </p>

                            <p>
                                Priority: <?= esc($task['priority'] ?? '-') ?>
                            </p>

                            <p>
                                Deadline: <?= esc($task['deadline'] ?? '-') ?>
                            </p>

                            <?php if (! empty($task['description'])): ?>
                                <p>
                                    Description: <?= esc($task['description']) ?>
                                </p>
                            <?php endif; ?>
                        </article>

                        <hr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </section>

        <?php endif; ?>
    </main>

</body>
</html>
```
