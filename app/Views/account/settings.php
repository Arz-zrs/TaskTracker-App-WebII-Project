<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Account Settings<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Account Settings</h2>
    <p class="text-slate-700 mt-1">Manage your profile details and account security settings.</p>
</div>

<!-- Alert Feedbacks -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-2xl mb-6 flex items-start gap-3 shadow-sm transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span class="text-sm font-semibold"><?= esc(session()->getFlashdata('success')) ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 flex items-start gap-3 shadow-sm transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-rose-600 mt-0.5 shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <span class="text-sm font-semibold"><?= esc(session()->getFlashdata('error')) ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 flex flex-col gap-1 shadow-sm transition-all duration-300">
        <div class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-rose-600 mt-0.5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
            <span class="text-sm font-bold">Please correct the following errors:</span>
        </div>
        <ul class="list-disc list-inside pl-8 text-xs font-semibold space-y-0.5 mt-1">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Form Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Profile Card -->
    <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.015)] border border-slate-100/50 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col justify-between border-t-4 border-indigo-600">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-8 w-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center border border-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Profile Information</h3>
            </div>

            <form action="<?= site_url('settings/profile') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>

                <!-- Avatar Upload with Live Preview -->
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <?php if (! empty($user['avatar'])): ?>
                            <img 
                                id="avatar-preview"
                                src="<?= base_url($user['avatar']) ?>" 
                                alt="Avatar" 
                                class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-md shadow-indigo-100 transition duration-200"
                            >
                        <?php else: ?>
                            <!-- Initial placeholder -->
                            <?php 
                                $name = $user['name'] ?? 'Admin User';
                                $initials = '';
                                $words = explode(' ', $name);
                                for ($i = 0; $i < min(2, count($words)); $i++) {
                                    $initials .= strtoupper(substr($words[$i], 0, 1));
                                }
                            ?>
                            <div 
                                id="avatar-placeholder"
                                class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-violet-600 text-white font-bold rounded-2xl flex items-center justify-center border-4 border-white shadow-md shadow-indigo-150 text-2xl"
                            >
                                <?= esc($initials) ?>
                            </div>
                            <img 
                                id="avatar-preview"
                                src="" 
                                alt="Avatar Preview" 
                                class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-md shadow-indigo-100 hidden"
                            >
                        <?php endif; ?>
                        
                        <!-- File Input Overlay Button -->
                        <label 
                            for="avatar" 
                            class="absolute bottom-[-8px] right-[-8px] bg-indigo-650 hover:bg-indigo-700 text-white p-2 rounded-xl border-2 border-white shadow-md cursor-pointer transition-all duration-150 hover:scale-105 active:scale-95 flex items-center justify-center"
                            title="Ubah Foto"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        </label>
                        <input 
                            type="file" 
                            id="avatar" 
                            name="avatar" 
                            accept="image/jpg,image/jpeg,image/png,image/webp" 
                            class="hidden" 
                            onchange="previewImage(event)"
                        >
                    </div>
                    <span class="text-[11px] text-slate-500 mt-4 font-bold select-none">Click the camera icon to upload an avatar</span>
                </div>

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?= old('name', $user['name']) ?>"
                            placeholder="John Doe"
                            required
                            class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 transition-all duration-200"
                        >
                    </div>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-xl text-sm flex items-center justify-center gap-2 transition duration-200 shadow-md shadow-indigo-100 cursor-pointer"
                >
                    Update Profile
                </button>
            </form>
        </div>
    </div>

    <!-- Change Password Card -->
    <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.015)] border border-slate-100/50 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col justify-between border-t-4 border-rose-500">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-8 w-8 bg-rose-50 text-rose-500 rounded-lg flex items-center justify-center border border-rose-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0V10.5m-2.25 10.5h13.5c1.242 0 2.25-1.008 2.25-2.25v-6.75C21 10.758 19.992 9.75 18.75 9.75H5.25c-1.242 0-2.25 1.008-2.25 2.25v6.75C3 19.992 4.008 21 5.25 21Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Change Password</h3>
            </div>

            <form action="<?= site_url('settings/password') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Current Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            placeholder="••••••••"
                            required
                            class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-11 pr-11 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-rose-450 focus:ring-1 focus:ring-rose-400 transition-all duration-200"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('current_password', 'eye-show-cur', 'eye-hide-cur')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 hover:text-slate-800 transition duration-150"
                        >
                            <svg id="eye-show-cur" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg id="eye-hide-cur" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        New Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0V10.5m-2.25 10.5h13.5c1.242 0 2.25-1.008 2.25-2.25v-6.75C21 10.758 19.992 9.75 18.75 9.75H5.25c-1.242 0-2.25 1.008-2.25 2.25v6.75C3 19.992 4.008 21 5.25 21Z" />
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Min. 8 characters"
                            required
                            class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-11 pr-11 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-rose-450 focus:ring-1 focus:ring-rose-400 transition-all duration-200"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('password', 'eye-show-new', 'eye-hide-new')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 hover:text-slate-800 transition duration-150"
                        >
                            <svg id="eye-show-new" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg id="eye-hide-new" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="password_confirm" class="block text-sm font-semibold text-slate-700 mb-2">
                        Confirm New Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0V10.5m-2.25 10.5h13.5c1.242 0 2.25-1.008 2.25-2.25v-6.75C21 10.758 19.992 9.75 18.75 9.75H5.25c-1.242 0-2.25 1.008-2.25 2.25v6.75C3 19.992 4.008 21 5.25 21Z" />
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="password_confirm"
                            name="password_confirm"
                            placeholder="Re-enter password"
                            required
                            class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-11 pr-11 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-rose-450 focus:ring-1 focus:ring-rose-400 transition-all duration-200"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('password_confirm', 'eye-show-conf', 'eye-hide-conf')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 hover:text-slate-800 transition duration-150"
                        >
                            <svg id="eye-show-conf" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <svg id="eye-hide-conf" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-rose-500 to-rose-600 hover:from-rose-600 hover:to-rose-700 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-xl text-sm flex items-center justify-center gap-2 transition duration-200 shadow-md shadow-rose-100 cursor-pointer"
                >
                    Change Password
                </button>
            </form>
        </div>
    </div>

</div>

<!-- Scripts for Image Preview & Toggle Password -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    }

    function togglePassword(inputId, eyeShowId, eyeHideId) {
        const input = document.getElementById(inputId);
        const eyeShow = document.getElementById(eyeShowId);
        const eyeHide = document.getElementById(eyeHideId);
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeShow.classList.add('hidden');
            eyeHide.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeShow.classList.remove('hidden');
            eyeHide.classList.add('hidden');
        }
    }
</script>

<?= $this->endSection() ?>