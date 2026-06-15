<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>Edit Comment<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Back Link -->
<div class="flex justify-start mb-6">
    <a href="<?= site_url('projects/' . esc($project['id'])) ?>" class="inline-flex items-center gap-2 py-2.5 px-4 bg-white border border-slate-300 hover:border-indigo-400 hover:bg-indigo-50/30 text-slate-800 hover:text-[#4F46E5] rounded-xl text-sm font-extrabold transition-all duration-200 shadow-sm group">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back to Project
    </a>
</div>

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Comment</h2>
    <p class="text-slate-700 mt-1 font-medium">Modify your reply for the task below.</p>
</div>

<!-- Form Container -->
<div class="flex justify-center w-full py-4">
    <div class="w-full max-w-2xl bg-white border-t-4 border-t-[#4F46E5] border-x border-b border-slate-200 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.015)] overflow-hidden">
        
        <!-- Context Banner -->
        <div class="bg-indigo-50/40 px-8 py-4 border-b border-indigo-100 flex items-center gap-2.5">
            <div class="h-8 w-8 bg-indigo-100/80 text-[#4F46E5] rounded-xl flex items-center justify-center border border-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192" />
                </svg>
            </div>
            <div>
                <span class="text-[10px] text-slate-650 font-bold block uppercase tracking-wider">Task Context</span>
                <span class="text-sm font-bold text-slate-800 block leading-tight"><?= esc($task['title']) ?></span>
            </div>
        </div>

        <!-- Error Feedback -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="p-6 bg-rose-50 border-b border-rose-100 text-rose-800 flex flex-col gap-2">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    Ada beberapa kesalahan input:
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 font-medium pl-6">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form action="/comments/<?= esc($comment['id']) ?>/update" method="post" class="p-8 space-y-6">
            <?= csrf_field() ?>

            <!-- Comment Body Textarea -->
            <div class="space-y-2">
                <label for="body" class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-widest">Comment Message</label>
                <textarea 
                    name="body" 
                    id="body" 
                    rows="5"
                    required
                    placeholder="Update your reply..."
                    class="w-full bg-[#F8FAFF] border border-slate-200 rounded-xl px-4 py-3.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-200 font-medium"
                ><?= old('body', $comment['body']) ?></textarea>
            </div>

            <!-- Form Actions -->
            <div class="border-t border-slate-100 pt-6 flex items-center justify-end gap-4">
                <a href="<?= site_url('projects/' . esc($project['id'])) ?>" class="px-6 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white text-sm font-bold transition-all duration-200 flex items-center gap-1.5 focus:outline-none focus:ring-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-95 text-white text-sm font-bold transition-all duration-200 shadow-md shadow-indigo-500/25 flex items-center gap-1.5"
                >
                    Update Comment
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>