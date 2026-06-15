<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Notifications<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight leading-none flex items-center gap-3">
            Notifications
            <?php if ($notificationCount > 0): ?>
                <span class="inline-flex items-center justify-center px-3 py-1 bg-rose-500 text-white font-extrabold rounded-full text-xs animate-pulse shadow-sm shadow-rose-200">
                    <?= $notificationCount ?>
                </span>
            <?php endif; ?>
        </h2>
        <p class="text-slate-700 mt-2 font-medium">Keep track of urgent task deadlines, due notices, and recent project activities.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left Column: Tasks Notifications -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Overdue Tasks -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] relative overflow-hidden">
            <div class="flex items-center gap-2.5 mb-6 border-b border-slate-100 pb-4">
                <div class="h-8 w-8 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center border border-rose-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Overdue Tasks</h3>
                    <p class="text-xs text-rose-600 font-semibold">Tasks that have passed their deadline and are still pending.</p>
                </div>
            </div>

            <?php if (empty($overdueTasks)): ?>
                <div class="text-center py-8 bg-emerald-50/10 border border-dashed border-emerald-150 rounded-2xl">
                    <div class="h-10 w-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-2.5 border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800">All caught up!</h4>
                    <p class="text-xs text-slate-605 font-semibold mt-0.5">No overdue tasks found.</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($overdueTasks as $task): ?>
                        <div class="bg-rose-50/10 hover:bg-rose-50/20 border border-rose-150/70 border-l-4 border-l-rose-500 rounded-2xl p-5 hover:shadow-sm transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                            <div class="space-y-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="bg-indigo-50/60 text-[#4F46E5] font-extrabold px-2.5 py-0.5 rounded-lg text-[10px] border border-indigo-100/50 uppercase tracking-wider">
                                        <?= esc($task['project_title']) ?>
                                    </span>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded border bg-rose-105 text-rose-700 border-rose-200">
                                        <?= esc($task['priority']) ?>
                                    </span>
                                </div>
                                <h4 class="text-base font-bold text-slate-900 leading-tight"><?= esc($task['title']) ?></h4>
                                <p class="text-xs font-semibold text-slate-600">Assignee: <span class="text-slate-800 font-bold"><?= esc($task['assignee_name'] ?? 'Unassigned') ?></span></p>
                            </div>
                            
                            <div class="flex items-center gap-3 shrink-0">
                                <div class="text-right">
                                    <span class="text-[10px] text-slate-600 block font-bold uppercase tracking-wider">Overdue Since</span>
                                    <span class="text-sm font-extrabold text-rose-600 flex items-center gap-1 mt-0.5 select-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <?= date('d M Y', strtotime($task['deadline'])) ?>
                                    </span>
                                </div>
                                <a href="<?= site_url('projects/' . esc($task['project_id'])) ?>" 
                                   class="h-10 w-10 bg-slate-100 hover:bg-rose-500 hover:text-white text-slate-700 hover:border-rose-500 rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm transition-all duration-200 active:scale-95 shrink-0"
                                   title="Go to Project">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Due Today Tasks -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] relative overflow-hidden">
            <div class="flex items-center gap-2.5 mb-6 border-b border-slate-100 pb-4">
                <div class="h-8 w-8 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center border border-amber-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Due Today</h3>
                    <p class="text-xs text-amber-600 font-semibold">Tasks that must be completed by the end of today.</p>
                </div>
            </div>

            <?php if (empty($dueTodayTasks)): ?>
                <div class="text-center py-8 bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl">
                    <div class="h-10 w-10 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center mx-auto mb-2.5 border border-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-slate-850">No tasks due today</h4>
                    <p class="text-xs text-slate-600 font-semibold mt-0.5">You have no tasks expiring today.</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($dueTodayTasks as $task): ?>
                        <div class="bg-amber-50/10 hover:bg-amber-50/20 border border-amber-150/70 border-l-4 border-l-amber-500 rounded-2xl p-5 hover:shadow-sm transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                            <div class="space-y-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="bg-indigo-50/60 text-[#4F46E5] font-extrabold px-2.5 py-0.5 rounded-lg text-[10px] border border-indigo-100/50 uppercase tracking-wider">
                                        <?= esc($task['project_title']) ?>
                                    </span>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded border 
                                        <?= $task['priority'] === 'high' 
                                            ? 'bg-rose-50 text-rose-700 border-rose-200' 
                                            : ($task['priority'] === 'medium' 
                                                ? 'bg-amber-50 text-amber-700 border-amber-200' 
                                                : 'bg-slate-100 text-slate-650 border-slate-200') ?>">
                                        <?= esc($task['priority']) ?>
                                    </span>
                                </div>
                                <h4 class="text-base font-bold text-slate-900 leading-tight"><?= esc($task['title']) ?></h4>
                                <p class="text-xs font-semibold text-slate-600">Assignee: <span class="text-slate-800 font-bold"><?= esc($task['assignee_name'] ?? 'Unassigned') ?></span></p>
                            </div>
                            
                            <div class="flex items-center gap-3 shrink-0">
                                <div class="text-right">
                                    <span class="text-[10px] text-slate-600 block font-bold uppercase tracking-wider">Due Date</span>
                                    <span class="text-sm font-extrabold text-amber-600 flex items-center gap-1 mt-0.5 select-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Today
                                    </span>
                                </div>
                                <a href="<?= site_url('projects/' . esc($task['project_id'])) ?>" 
                                   class="h-10 w-10 bg-slate-100 hover:bg-amber-500 hover:text-white text-slate-700 hover:border-amber-500 rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm transition-all duration-200 active:scale-95 shrink-0"
                                   title="Go to Project">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] relative overflow-hidden">
            <div class="flex items-center gap-2.5 mb-6 border-b border-slate-100 pb-4">
                <div class="h-8 w-8 bg-indigo-50 text-[#4F46E5] rounded-xl flex items-center justify-center border border-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Upcoming Deadlines</h3>
                    <p class="text-xs text-indigo-600 font-semibold">Tasks expiring in the next 7 days.</p>
                </div>
            </div>

            <?php if (empty($upcomingTasks)): ?>
                <div class="text-center py-8 bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl">
                    <div class="h-10 w-10 bg-slate-100 text-slate-500 rounded-xl flex items-center justify-center mx-auto mb-2.5 border border-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800">No upcoming deadlines</h4>
                    <p class="text-xs text-slate-600 font-semibold mt-0.5">No tasks expiring in the next 7 days.</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($upcomingTasks as $task): ?>
                        <div class="bg-slate-55/30 hover:bg-indigo-50/10 border border-slate-150 border-l-4 border-l-indigo-400 hover:border-indigo-150 rounded-2xl p-5 hover:shadow-sm transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                            <div class="space-y-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="bg-indigo-50/60 text-[#4F46E5] font-extrabold px-2.5 py-0.5 rounded-lg text-[10px] border border-indigo-100/50 uppercase tracking-wider">
                                        <?= esc($task['project_title']) ?>
                                    </span>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded border 
                                        <?= $task['priority'] === 'high' 
                                            ? 'bg-rose-50 text-rose-700 border-rose-200' 
                                            : ($task['priority'] === 'medium' 
                                                ? 'bg-amber-50 text-amber-700 border-amber-200' 
                                                : 'bg-slate-100 text-slate-650 border-slate-200') ?>">
                                        <?= esc($task['priority']) ?>
                                    </span>
                                </div>
                                <h4 class="text-base font-bold text-slate-900 leading-tight"><?= esc($task['title']) ?></h4>
                                <p class="text-xs font-semibold text-slate-600">Assignee: <span class="text-slate-800 font-bold"><?= esc($task['assignee_name'] ?? 'Unassigned') ?></span></p>
                            </div>
                            
                            <div class="flex items-center gap-3 shrink-0">
                                <div class="text-right">
                                    <span class="text-[10px] text-slate-600 block font-bold uppercase tracking-wider">Deadline</span>
                                    <span class="text-sm font-extrabold text-slate-800 flex items-center gap-1 mt-0.5 select-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 text-slate-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <?= date('d M Y', strtotime($task['deadline'])) ?>
                                    </span>
                                </div>
                                <a href="<?= site_url('projects/' . esc($task['project_id'])) ?>" 
                                   class="h-10 w-10 bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-700 hover:border-indigo-600 rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm transition-all duration-200 active:scale-95 shrink-0"
                                   title="Go to Project">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Right Column: Recent Activity Logs -->
    <div class="space-y-6">
        
        <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] border border-slate-100/50">
            <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-5 h-5 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <div>
                    <h3 class="text-lg font-bold text-slate-900 leading-tight">Recent Activity</h3>
                    <p class="text-xs text-slate-600 mt-0.5">Quick activity logs from your projects.</p>
                </div>
            </div>

            <div class="relative border-l border-slate-200 ml-3.5 pl-6 space-y-6">
                <?php if (empty($recentLogs)): ?>
                    <p class="text-xs text-slate-600 font-semibold italic">No recent activity.</p>
                <?php else: ?>
                    <?php foreach ($recentLogs as $log): ?>
                        <div class="relative group">
                            <!-- Mini Circle Node -->
                            <div class="absolute -left-[31px] top-1.5 h-3.5 w-3.5 rounded-full border-2 border-[#F5F8FF] <?= $log['entity_type'] === 'project' ? 'bg-[#4F46E5]' : ($log['entity_type'] === 'task' ? 'bg-sky-500' : ($log['entity_type'] === 'member' ? 'bg-emerald-500' : 'bg-slate-400')) ?> shadow-sm"></div>

                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-slate-800 leading-normal">
                                    <?= esc($log['message']) ?>
                                </p>
                                <span class="text-[10px] text-slate-500 font-bold block">
                                    <?= esc($log['formatted_time']) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>