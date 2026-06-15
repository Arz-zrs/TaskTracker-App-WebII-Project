<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TaskTracker — Premium Workspace</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#F5F8FF] via-[#EEF2FF] to-[#E5EDFF] text-slate-800 antialiased min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Ambient Background Accents -->
    <div class="absolute top-0 left-0 right-0 h-[550px] bg-gradient-to-b from-[#4F46E5]/15 via-[#8B5CF6]/5 to-transparent pointer-events-none z-0"></div>
    <div class="absolute -top-[200px] -right-[200px] w-[600px] h-[600px] bg-indigo-200/20 rounded-full blur-3xl pointer-events-none z-0"></div>
    <div class="absolute top-[400px] -left-[200px] w-[600px] h-[600px] bg-violet-200/20 rounded-full blur-3xl pointer-events-none z-0"></div>

    <!-- HEADER / NAVIGATION -->
    <header class="w-full h-24 flex items-center justify-between px-8 md:px-16 sticky top-0 bg-[#EEF2FF]/60 backdrop-blur-md border-b border-indigo-100/30 z-30 shrink-0">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 bg-[#4F46E5] rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-200 select-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight leading-none">TaskTracker</h1>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="<?= site_url('login') ?>" class="px-5 py-2.5 bg-white border border-slate-200 hover:border-indigo-400 text-slate-800 text-sm font-bold rounded-xl transition duration-200 shadow-sm hover:scale-[1.03] active:scale-[0.97]">
                Log In
            </a>
            <a href="<?= site_url('register') ?>" class="px-5 py-2.5 bg-[#4F46E5] hover:bg-[#4338CA] text-white text-sm font-bold rounded-xl transition duration-200 shadow-md shadow-indigo-100 hover:scale-[1.03] active:scale-[0.97]">
                Register
            </a>
        </div>
    </header>

    <!-- HERO SECTION -->
    <main class="flex-1 flex flex-col items-center justify-center px-6 md:px-16 py-12 md:py-20 text-center relative z-10 max-w-6xl mx-auto">
        <div class="space-y-6 max-w-4xl">

            <!-- Hero Title -->
            <h2 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                Manage Tasks. Build Projects.<br>
                <span class="bg-gradient-to-r from-[#4F46E5] via-[#8B5CF6] to-[#EC4899] bg-clip-text text-transparent">Empower Modern Teams.</span>
            </h2>

            <!-- Hero Subtitle -->
            <p class="text-base md:text-xl text-slate-700 max-w-2xl mx-auto leading-relaxed font-semibold">
                TaskTracker is an integrated project management application designed to simplify team coordination, track task deadlines in real-time, and monitor project progress efficiently.
            </p>

            <!-- CTA Actions -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?= site_url('register') ?>" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-[#4F46E5] to-[#8B5CF6] hover:from-[#4338CA] hover:to-[#7C3AED] text-white font-extrabold rounded-2xl transition duration-200 shadow-lg shadow-indigo-200 hover:scale-[1.03] active:scale-[0.97] flex items-center justify-center gap-2">
                    Get Started
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- FEATURES TEASER GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full mt-20 md:mt-28">
            <!-- Feature 1 -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 text-left shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md hover:scale-[1.02] transition-all duration-300 border-t-4 border-t-indigo-500">
                <div class="h-12 w-12 bg-indigo-50 text-[#4F46E5] rounded-2xl flex items-center justify-center border border-indigo-100 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-19.5 0A2.25 2.25 0 0 0 4.5 15h15a2.25 2.25 0 0 0 2.25-2.25m-19.5 0v.25A2.25 2.25 0 0 0 4.5 17.5h15a2.25 2.25 0 0 0 2.25-2.25m-19.5 0v.25a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25m-19.5 0v-4.5A2.25 2.25 0 0 1 4.5 6h4.5a2.25 2.25 0 0 1 1.62.69l1.01 1.01a2.25 2.25 0 0 0 1.62.69h6A2.25 2.25 0 0 1 21.75 9.75v3.25" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Structured Workspaces</h3>
                <p class="text-sm text-slate-700 leading-relaxed font-semibold">Organize project templates, coordinate members with customized roles, and follow discussion comment threads easily.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 text-left shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md hover:scale-[1.02] transition-all duration-300 border-t-4 border-t-sky-500">
                <div class="h-12 w-12 bg-sky-50 text-sky-600 rounded-2xl flex items-center justify-center border border-sky-100 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Deadlines & Activity Log</h3>
                <p class="text-sm text-slate-700 leading-relaxed font-semibold">Track deadline chronologies on timeline tracks. Oversee system logs with type-specific color indicators.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 text-left shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md hover:scale-[1.02] transition-all duration-300 border-t-4 border-t-rose-500">
                <div class="h-12 w-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center border border-rose-100 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Live Alerts Notifications</h3>
                <p class="text-sm text-slate-700 leading-relaxed font-semibold">Receive warnings for overdue work, view cards expiring today, and search tasks inside a unified system feed.</p>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="w-full py-8 border-t border-indigo-50/50 flex flex-col sm:flex-row items-center justify-between px-8 md:px-16 text-xs text-slate-600 font-bold shrink-0 relative z-10">
        <span>&copy; 2026 TaskTracker. All rights reserved.</span>
    </footer>

</body>
</html>
