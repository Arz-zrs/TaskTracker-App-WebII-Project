<h1>Register</h1>

<a href="/">Back to Login</a>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/register" method="post">
    <?= csrf_field() ?>

    <div>
        <label>Name</label><br>
        <input 
            type="text" 
            name="name" 
            value="<?= old('name') ?>"
        >
    </div>

    <br>

    <div>
        <label>Email</label><br>
        <input 
            type="email" 
            name="email" 
            value="<?= old('email') ?>"
        >
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password">
    </div>

    <br>

    <div>
        <label>Confirm Password</label><br>
        <input type="password" name="password_confirm">
    </div>

    <br>

    <div>
        <label>Register As</label><br>
        <select name="role">
            <option value="member" <?= old('role') === 'member' ? 'selected' : '' ?>>Member</option>
            <option value="klien" <?= old('role') === 'klien' ? 'selected' : '' ?>>Klien</option>
        </select>
    </div>

    <br>

    <button type="submit">Register</button>
</form>