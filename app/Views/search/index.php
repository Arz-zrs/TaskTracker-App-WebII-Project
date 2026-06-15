<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Search Results<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Search Results</h2>
    <p class="text-slate-700 mt-1">Found projects and tasks matching your search query.</p>
</div>

<?php if (($q ?? '') === ''): ?>
    <!-- Empty Search State -->
    <div class="text-center py-16 bg-white rounded-3xl border border-slate-150/50 shadow-[0_8px_30px_rgb(0,0,0,0.01)] max-w-lg mx-auto">
        <div class="h-16 w-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-indigo-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Find Projects or Tasks</h3>
        <p class="text-slate-500 text-sm mt-2 max-w-xs mx-auto">Type keywords in the search bar at the top of the dashboard to search for projects or tasks by keyword.</p>
    </div>
<?php else: ?>

    <div class="mb-6">
        <p class="text-sm font-semibold text-slate-700">
            Showing results for: <span class="text-indigo-650 bg-indigo-50 border border-indigo-100 px-3 py-1 rounded-full text-xs font-bold ml-1">"<?= esc($q) ?>"</span>
        </p>
    </div>

    <!-- Results Grid -->
    <div class="space-y-10">
        
        <!-- Projects Section -->
        <div>
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    Projects
                    <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold"><?= count($projects) ?></span>
                </h3>
            </div>

            <?php if (empty($projects)): ?>
                <div class="bg-white rounded-3xl p-8 border border-slate-100 text-center text-slate-500 text-sm">
                    No projects match your keyword.
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($projects as $project): ?>
                        <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] border border-slate-100/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                            <!-- Color border based on project status -->
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 
                                <?= $project['status'] === 'active' 
                                    ? 'bg-emerald-500' 
                                    : ($project['status'] === 'completed' 
                                        ? 'bg-[#4F46E5]' 
                                        : 'bg-slate-400') ?>">
                            </div>
                            
                            <div class="pl-2">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full border 
                                        <?= $project['status'] === 'active' 
                                            ? 'bg-emerald-50 text-emerald-700 border-emerald-150' 
                                            : ($project['status'] === 'completed' 
                                                ? 'bg-indigo-50 text-[#4F46E5] border-indigo-150' 
                                                : 'bg-slate-50 text-slate-600 border-slate-200') ?>">
                                        <?= esc($project['status']) ?>
                                    </span>
                                </div>
                                <h4 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors duration-200">
                                    <a href="<?= site_url('projects/' . esc($project['id'])) ?>">
                                        <?= esc($project['title']) ?>
                                    </a>
                                </h4>
                                <p class="text-slate-600 text-xs mt-2 line-clamp-2 leading-relaxed">
                                    <?= esc($project['description'] ?: 'No description provided.') ?>
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-end pl-2">
                                <a 
                                    href="<?= site_url('projects/' . esc($project['id'])) ?>"
                                    class="text-xs font-bold text-indigo-600 hover:text-indigo-700 inline-flex items-center gap-1.5"
                                >
                                    View Project
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tasks Section -->
        <div>
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    Tasks
                    <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold"><?= count($tasks) ?></span>
                </h3>
            </div>

            <?php if (empty($tasks)): ?>
                <div class="bg-white rounded-3xl p-8 border border-slate-100 text-center text-slate-500 text-sm">
                    No tasks match your keyword.
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($tasks as $task): ?>
                        <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] border border-slate-100/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                            
                            <!-- Color border based on priority -->
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 
                                <?= $task['priority'] === 'high' 
                                    ? 'bg-rose-500' 
                                    : ($task['priority'] === 'medium' 
                                        ? 'bg-amber-400' 
                                        : 'bg-emerald-400') ?>">
                            </div>

                            <div class="pl-2">
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50/70 border border-indigo-100 px-2.5 py-0.5 rounded-md truncate max-w-[150px]">
                                        <?= esc($task['project_title'] ?? 'Global') ?>
                                    </span>
                                    
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        <!-- Priority -->
                                        <span class="text-[9px] font-extrabold uppercase tracking-wide px-2 py-0.5 rounded-md border
                                            <?= $task['priority'] === 'high' 
                                                ? 'bg-rose-50 text-rose-700 border-rose-100' 
                                                : ($task['priority'] === 'medium' 
                                                    ? 'bg-amber-50 text-amber-700 border-amber-100' 
                                                    : 'bg-emerald-50 text-emerald-700 border-emerald-100') ?>">
                                            <?= esc($task['priority']) ?>
                                        </span>

                                        <!-- Status -->
                                        <span class="text-[9px] font-extrabold uppercase tracking-wide px-2 py-0.5 rounded-md border
                                            <?= $task['status'] === 'done' 
                                                ? 'bg-emerald-50 text-emerald-700 border-emerald-150' 
                                                : ($task['status'] === 'review' 
                                                    ? 'bg-purple-50 text-purple-700 border-purple-150' 
                                                    : ($task['status'] === 'in_progress' 
                                                        ? 'bg-indigo-50 text-[#4F46E5] border-indigo-150' 
                                                        : 'bg-slate-50 text-slate-600 border-slate-200')) ?>">
                                            <?= esc(str_replace('_', ' ', $task['status'])) ?>
                                        </span>
                                    </div>
                                </div>

                                <h4 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors duration-200">
                                    <a href="<?= site_url('projects/' . esc($task['project_id'])) ?>">
                                        <?= esc($task['title']) ?>
                                    </a>
                                </h4>

                                <?php if (!empty($task['description'])): ?>
                                    <p class="text-slate-600 text-xs mt-2 line-clamp-2 leading-relaxed">
                                        <?= esc($task['description']) ?>
                                    </p>
                                <?php endif; ?>

                                <!-- Info footer inside card -->
                                <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-700">
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <span class="font-semibold"><?= esc($task['assignee_name'] ?? 'Unassigned') ?></span>
                                    </div>

                                    <?php if ($task['deadline']): ?>
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <span class="font-bold text-slate-800"><?= date('d M Y', strtotime($task['deadline'])) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php endif; ?>

<?= $this->endSection() ?>
