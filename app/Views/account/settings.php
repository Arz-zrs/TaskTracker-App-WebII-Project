<h1>Account Settings</h1>

<a href="/dashboard">Back to Dashboard</a>

<?php if (session()->getFlashdata('success')): ?>
    <p><?= esc(session()->getFlashdata('success')) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<hr>

<h2>Profile</h2>

<?php if (! empty($user['avatar'])): ?>
    <img src="/<?= esc($user['avatar']) ?>" alt="Avatar" width="100">
<?php endif; ?>

<form action="/settings/profile" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div>
        <label>Name</label><br>
        <input type="text" name="name" value="<?= old('name', $user['name']) ?>">
    </div>

    <br>

    <div>
        <label>Avatar</label><br>
        <input type="file" name="avatar" accept="image/*">
    </div>

    <br>

    <button type="submit">Update Profile</button>
</form>

<hr>

<h2>Change Password</h2>

<form action="/settings/password" method="post">
    <?= csrf_field() ?>

    <div>
        <label>Current Password</label><br>
        <input type="password" name="current_password">
    </div>

    <br>

    <div>
        <label>New Password</label><br>
        <input type="password" name="password">
    </div>

    <br>

    <div>
        <label>Confirm New Password</label><br>
        <input type="password" name="password_confirm">
    </div>

    <br>

    <button type="submit">Change Password</button>
</form>