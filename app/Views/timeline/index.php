<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Timeline<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header & Switcher Container -->
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight leading-none">Timeline</h2>
        <p class="text-slate-700 mt-2 font-medium">Track upcoming task deadlines and review recent team activity logs across all projects.</p>
    </div>
    
    <!-- Tab Switcher Menu -->
    <div class="inline-flex bg-white/80 backdrop-blur-sm p-1 rounded-2xl border border-slate-200/50 shadow-sm shrink-0">
        <a href="<?= site_url('timeline?view=deadlines') ?>" 
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?= $view === 'deadlines' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'text-slate-600 hover:text-slate-900' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Task Deadlines
        </a>
        <a href="<?= site_url('timeline?view=activity') ?>" 
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?= $view === 'activity' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'text-slate-600 hover:text-slate-900' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125H5.625a1.125 1.125 0 0 1-1.125-1.125V5.625c0-.621.504-1.125 1.125-1.125Z" />
            </svg>
            Activity Stream
        </a>
    </div>
</div>

<?php if ($view === 'deadlines'): ?>

    <?php if (empty($deadlines)): ?>
        <!-- Empty State -->
        <div class="bg-white rounded-3xl p-12 border border-slate-100 text-center shadow-[0_8px_30px_rgb(0,0,0,0.015)]">
            <div class="h-16 w-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-emerald-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900">No deadlines yet</h3>
            <p class="text-slate-600 max-w-md mx-auto mt-2 leading-relaxed font-semibold">All tasks are currently without deadlines, or you have completed all pending work. Great job!</p>
        </div>
    <?php else: ?>
        <div class="relative border-l-2 border-slate-200/60 ml-4 pl-8 space-y-6">
            <?php foreach ($deadlines as $task): ?>
                <?php
                    $isCompleted = ($task['status'] === 'done');
                    $isOverdue = false;
                    if (!$isCompleted && !empty($task['deadline'])) {
                        $deadlineTime = strtotime($task['deadline']);
                        if ($deadlineTime && $deadlineTime < time()) {
                            $isOverdue = true;
                        }
                    }

                    // Card visual styling based on priority & status
                    if ($isCompleted) {
                        $cardBorder = 'border-l-4 border-l-emerald-500 hover:border-emerald-300';
                        $cardBg = 'bg-emerald-50/5 hover:bg-emerald-50/10';
                        $dotColor = 'bg-emerald-500';
                        $dotPulse = false;
                    } elseif ($isOverdue) {
                        $cardBorder = 'border-l-4 border-l-rose-500 hover:border-rose-350';
                        $cardBg = 'bg-rose-50/10 hover:bg-rose-50/15';
                        $dotColor = 'bg-rose-500';
                        $dotPulse = true;
                    } else {
                        $dotPulse = false;
                        if ($task['priority'] === 'high') {
                            $cardBorder = 'border-l-4 border-l-rose-400 hover:border-rose-300';
                            $cardBg = 'bg-white hover:bg-slate-50/40';
                            $dotColor = 'bg-rose-400';
                        } elseif ($task['priority'] === 'medium') {
                            $cardBorder = 'border-l-4 border-l-amber-400 hover:border-amber-300';
                            $cardBg = 'bg-white hover:bg-slate-50/40';
                            $dotColor = 'bg-amber-400';
                        } else {
                            $cardBorder = 'border-l-4 border-l-indigo-400 hover:border-indigo-300';
                            $cardBg = 'bg-white hover:bg-slate-50/40';
                            $dotColor = 'bg-indigo-400';
                        }
                    }
                ?>
                <div class="relative group">
                    <!-- Timeline Dot -->
                    <div class="absolute -left-[41px] top-6 h-5 w-5 rounded-full border-4 border-[#F5F8FF] <?= $dotColor ?> shadow-sm flex items-center justify-center transition-all duration-200">
                        <?php if ($dotPulse): ?>
                            <span class="absolute -inset-0.5 rounded-full <?= $dotColor ?> animate-ping opacity-75"></span>
                        <?php endif; ?>
                        <?php if ($isCompleted): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 text-white">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                            </svg>
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="bg-white border border-slate-100 <?= $cardBorder ?> <?= $cardBg ?> rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="bg-indigo-50/60 text-indigo-700 font-extrabold px-2.5 py-0.5 rounded-lg text-[10px] border border-indigo-100/50 uppercase tracking-wider">
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

                                <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded border 
                                    <?= $task['status'] === 'done' 
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200' 
                                        : ($task['status'] === 'in_progress' 
                                            ? 'bg-blue-50 text-blue-700 border-blue-200' 
                                            : 'bg-slate-100 text-slate-705 border-slate-200') ?>">
                                    <?= esc($task['status']) ?>
                                </span>

                                <?php if ($isOverdue): ?>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded border bg-rose-100 text-rose-800 border-rose-300 animate-pulse">
                                        Overdue
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 leading-tight group-hover:text-indigo-650 transition-colors"><?= esc($task['title']) ?></h3>
                            
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 text-slate-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>Assignee: <strong class="text-slate-800 font-bold"><?= esc($task['assignee_name'] ?? 'Belum ditugaskan') ?></strong></span>
                            </div>
                        </div>

                        <!-- Date badge -->
                        <div class="shrink-0 flex items-center gap-3">
                            <div class="text-right">
                                <span class="text-[10px] text-slate-600 block font-bold uppercase tracking-wider">Deadline</span>
                                <span class="text-base font-extrabold flex items-center gap-1.5 mt-0.5 <?= $isOverdue ? 'text-rose-600' : 'text-slate-900' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75" />
                                    </svg>
                                    <?= date('d M Y', strtotime($task['deadline'])) ?>
                                </span>
                            </div>
                            
                            <!-- Action button linking to project details -->
                            <a href="<?= site_url('projects/' . esc($task['project_id'])) ?>" 
                               class="h-10 w-10 bg-slate-100 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 text-slate-700 rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm transition-all duration-200 active:scale-95 shrink-0"
                               title="View Project">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

<?php else: ?>

    <?php if (empty($logs)): ?>
        <!-- Empty State -->
        <div class="bg-white rounded-3xl p-12 border border-slate-100 text-center shadow-[0_8px_30px_rgb(0,0,0,0.015)]">
            <div class="h-16 w-16 bg-slate-100 text-slate-500 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900">No activity yet</h3>
            <p class="text-slate-600 max-w-md mx-auto mt-2 leading-relaxed font-semibold">There are no project actions or updates logged in the timeline yet.</p>
        </div>
    <?php else: ?>
        <div class="relative border-l-2 border-slate-200/60 ml-6 pl-10 space-y-6">
            <?php foreach ($logs as $log): ?>
                <?php
                    $dotColorClass = 'bg-slate-100 text-slate-600 border-slate-200';
                    $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>';
                    $leftBorderClass = 'border-l-4 border-l-slate-400';
                    $logBgClass = 'bg-white';

                    if ($log['entity_type'] === 'project') {
                        $dotColorClass = 'bg-indigo-55 text-[#4F46E5] border-indigo-200';
                        $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-19.5 0A2.25 2.25 0 0 0 4.5 15h15a2.25 2.25 0 0 0 2.25-2.25m-19.5 0v.25A2.25 2.25 0 0 0 4.5 17.5h15a2.25 2.25 0 0 0 2.25-2.25m-19.5 0v.25a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25m-19.5 0v-4.5A2.25 2.25 0 0 1 4.5 6h4.5a2.25 2.25 0 0 1 1.62.69l1.01 1.01a2.25 2.25 0 0 0 1.62.69h6A2.25 2.25 0 0 1 21.75 9.75v3.25" /></svg>';
                        $leftBorderClass = 'border-l-4 border-l-indigo-500 hover:border-indigo-400';
                        $logBgClass = 'bg-white hover:bg-indigo-50/10';
                    } elseif ($log['entity_type'] === 'task') {
                        $dotColorClass = 'bg-sky-100 text-sky-700 border-sky-200';
                        $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 0A48.536 48.536 0 0 1 12 3m0 0c2.917 0 5.747.294 8.5.862m-21 10.398c0-.552.448-1 1-1h6.25a1 1 0 0 1 1 1v3.83a1 1 0 0 1-1 1H2.5a1 1 0 0 1-1-1v-3.83Z" /></svg>';
                        $leftBorderClass = 'border-l-4 border-l-sky-500 hover:border-sky-400';
                        $logBgClass = 'bg-white hover:bg-sky-50/10';
                    } elseif ($log['entity_type'] === 'comment') {
                        $dotColorClass = 'bg-amber-100 text-amber-700 border-amber-200';
                        $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.132.136.208.307.19.5l-.262 1.632a.75.75 0 0 0 .866.866l1.632-.262a.75.75 0 0 1 .5.19A8.932 8.932 0 0 0 12 20.25Z" /></svg>';
                        $leftBorderClass = 'border-l-4 border-l-amber-500 hover:border-amber-400';
                        $logBgClass = 'bg-white hover:bg-amber-50/10';
                    } elseif ($log['entity_type'] === 'member') {
                        $dotColorClass = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                        $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>';
                        $leftBorderClass = 'border-l-4 border-l-emerald-500 hover:border-emerald-400';
                        $logBgClass = 'bg-white hover:bg-emerald-50/10';
                    }
                ?>
                <div class="relative group">
                    <!-- Timeline Node Icon -->
                    <div class="absolute -left-[59px] top-4 h-9 w-9 rounded-full border-4 border-[#F5F8FF] <?= $dotColorClass ?> shadow-sm flex items-center justify-center transition-transform group-hover:scale-110 duration-200">
                        <?= $iconSvg ?>
                    </div>

                    <!-- Card Body -->
                    <div class="<?= $logBgClass ?> border border-slate-100 <?= $leftBorderClass ?> rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md transition-all duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                            <div class="space-y-2">
                                <p class="text-sm font-semibold text-slate-800 leading-normal">
                                    <?= esc($log['message']) ?>
                                </p>
                                
                                <?php if (! empty($log['project_title'])): ?>
                                    <div class="inline-flex items-center gap-1 bg-indigo-50/60 text-[#4F46E5] font-extrabold px-2.5 py-0.5 rounded-lg text-[10px] border border-indigo-100/50 uppercase tracking-wider">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75" />
                                        </svg>
                                        <span>Project: <?= esc($log['project_title']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Timestamp -->
                            <span class="text-xs text-slate-600 font-semibold flex items-center gap-1 mt-0.5 shrink-0 select-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <?= esc($log['formatted_time']) ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?= $this->endSection() ?>