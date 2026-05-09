<?php
/** @var string|null $module */
$module = $module ?? 'Admin Module';
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold"><?= e($module) ?></h1>
        <p class="mt-4 max-w-2xl text-slate-400">Admin module routed for approvals, users, listings, reports, and inquiries.</p>
        <div class="soft-card mt-8 overflow-hidden rounded-[2rem]">
            <div class="grid grid-cols-4 gap-4 border-b border-white/10 p-4 text-sm font-bold text-slate-300">
                <span>Name</span><span>Status</span><span>Updated</span><span>Action</span>
            </div>
            <?php foreach (['DHA Phase 8 Villa', 'Clifton Sea View Penthouse', 'Bahadurabad Apartment'] as $row): ?>
                <div class="grid grid-cols-4 gap-4 border-b border-white/5 p-4 text-sm text-slate-400">
                    <span><?= e($row) ?></span><span>Pending</span><span>Today</span><a class="text-blue-300" href="<?= url('/admin/approvals') ?>">Review</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
