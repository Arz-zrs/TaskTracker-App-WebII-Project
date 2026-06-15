<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — TaskTracker</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }

        .watermark {
            position: absolute;
            display: none;
            pointer-events: none;
            user-select: none;
            color: rgb(79 70 229 / 0.18);
        }
        @media (min-width: 768px) {
            .watermark {
                display: block;
            }
        }

        @keyframes float-1 {
            0%, 100% { transform: translateY(0px) rotate(-12deg); }
            50% { transform: translateY(-12px) rotate(-6deg); }
        }
        @keyframes float-2 {
            0%, 100% { transform: translateY(0px) rotate(12deg); }
            50% { transform: translateY(-16px) rotate(6deg); }
        }
        @keyframes float-3 {
            0%, 100% { transform: translateY(0px) rotate(-45deg); }
            50% { transform: translateY(-10px) rotate(-38deg); }
        }
        @keyframes float-4 {
            0%, 100% { transform: translateY(0px) rotate(20deg); }
            50% { transform: translateY(-14px) rotate(25deg); }
        }
        
        .animate-float-1 { animation: float-1 6s ease-in-out infinite; }
        .animate-float-2 { animation: float-2 8s ease-in-out infinite; }
        .animate-float-3 { animation: float-3 7s ease-in-out infinite; }
        .animate-float-4 { animation: float-4 9s ease-in-out infinite; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-tr from-indigo-100 via-slate-50 to-purple-100 flex items-center justify-center p-4 sm:p-6 relative overflow-hidden">

    <!-- Background Decoration -->
    <div class="fixed top-[-10%] left-[-10%] w-[450px] h-[450px] rounded-full bg-indigo-300/35 blur-[120px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[450px] h-[450px] rounded-full bg-purple-300/35 blur-[120px] pointer-events-none z-0"></div>

    <!-- Watermarks Left -->
    <svg class="watermark left-[6%] top-[12%] w-11 h-11 animate-float-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
    </svg>
    <svg class="watermark left-[18%] top-[8%] w-12 h-12 animate-float-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
    </svg>
    <svg class="watermark left-[16%] top-[26%] w-10 h-10 animate-float-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
    </svg>
    <svg class="watermark left-[5%] top-[45%] w-9 h-9 animate-float-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
    </svg>
    <svg class="watermark left-[14%] top-[58%] w-10 h-10 animate-float-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
    </svg>
    <svg class="watermark left-[8%] bottom-[12%] w-11 h-11 animate-float-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
    </svg>

    <!-- Watermarks Right -->
    <svg class="watermark right-[8%] top-[14%] w-11 h-11 animate-float-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
    </svg>
    <svg class="watermark right-[16%] top-[10%] w-12 h-12 animate-float-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
    </svg>
    <svg class="watermark right-[15%] top-[25%] w-10 h-10 animate-float-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
    </svg>
    <svg class="watermark right-[5%] top-[50%] w-9 h-9 animate-float-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
    </svg>
    <svg class="watermark right-[14%] bottom-[15%] w-10 h-10 animate-float-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
    </svg>
    <svg class="watermark right-[7%] bottom-[8%] w-11 h-11 animate-float-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
    </svg>

    <!-- Content Wrapper -->
    <div class="relative z-10 w-full max-w-[440px] flex flex-col items-center">

        <!-- Logo -->
        <div class="text-center mb-6 flex flex-col items-center select-none">
            <div class="w-12 h-12 bg-indigo-600 rounded-[14px] flex items-center justify-center mb-3 shadow-lg shadow-indigo-600/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">TaskTracker</h1>
            <p class="text-xs text-slate-700 mt-1">Join the ultimate workspace for teams</p>
        </div>

        <!-- Flash Validation Errors feedback -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="w-full mb-5 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 shadow-sm space-y-1">
                <div class="flex items-start gap-2 font-bold mb-1">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/>
                    </svg>
                    <span>Registration Failed</span>
                </div>
                <ul class="list-disc list-inside pl-2 space-y-0.5 text-xs font-medium">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Register card -->
        <div class="w-full bg-white rounded-[24px] shadow-[0_20px_50px_rgba(99,102,241,0.04)] border border-slate-100/80 p-8 sm:p-10">

            <form action="/register" method="post" class="space-y-4">

                <?= csrf_field() ?>

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= old('name') ?>"
                        placeholder="John Doe"
                        required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Email address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= old('email') ?>"
                        placeholder="name@company.com"
                        required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 pr-11 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('password', 'eye-show-1', 'eye-hide-1')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-600 hover:text-slate-800 transition duration-150"
                        >
                            <!-- Eye Icon Show -->
                            <svg id="eye-show-1" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <!-- Eye Icon Hide -->
                            <svg id="eye-hide-1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirm" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirm"
                            name="password_confirm"
                            placeholder="••••••••"
                            required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 pr-11 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('password_confirm', 'eye-show-2', 'eye-hide-2')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-600 hover:text-slate-800 transition duration-150"
                        >
                            <!-- Eye Icon Show -->
                            <svg id="eye-show-2" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <!-- Eye Icon Hide -->
                            <svg id="eye-hide-2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Register As -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Register As
                    </label>
                    <div class="relative">
                        <select
                            id="role"
                            name="role"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition duration-150 appearance-none cursor-pointer pr-10 font-medium"
                        >
                            <option value="member" <?= old('role') === 'member' ? 'selected' : '' ?>>Member (Tim Proyek)</option>
                            <option value="klien" <?= old('role') === 'klien' ? 'selected' : '' ?>>Klien (Melihat Proyek)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-semibold py-3 px-4 rounded-xl text-sm flex items-center justify-center gap-2 transition duration-150 shadow-md shadow-indigo-600/10 mt-2 cursor-pointer"
                >
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center text-sm text-slate-700 mt-6 select-none">
                Already have an account?
                <a href="/login" class="text-indigo-600 hover:text-indigo-700 font-semibold ml-1 transition duration-150">
                    Log In
                </a>
            </div>

        </div>

    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
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

</body>
</html>