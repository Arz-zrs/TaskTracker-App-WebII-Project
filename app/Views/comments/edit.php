<h1>Edit Comment</h1>

<p>Task: <?= esc($task['title']) ?></p>

<a href="/projects/<?= esc($project['id']) ?>">Back to Project</a>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/comments/<?= esc($comment['id']) ?>/update" method="post">
    <?= csrf_field() ?>

    <textarea name="body" required><?= old('body', $comment['body']) ?></textarea>

    <br>

    <button type="submit">Update Comment</button>
</form>