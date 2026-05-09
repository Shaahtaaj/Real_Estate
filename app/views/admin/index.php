<?php
/** @var array{users?: int, listings?: int, pending?: int, inquiries?: int} $stats */
/** @var array{properties?: array<int, array{title?: string, status?: string}>} $store */
$stats = array_merge(['users' => 0, 'listings' => 0, 'pending' => 0, 'inquiries' => 0], $stats ?? []);
$store = array_merge(['properties' => []], $store ?? []);
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold">Admin panel</h1>
        <div class="mt-8 grid gap-4 md:grid-cols-4">
            <?php foreach ([[$stats['users'], 'Users'], [$stats['listings'], 'Listings'], [$stats['pending'], 'Pending approval'], [$stats['inquiries'], 'Inquiries']] as $stat): ?>
                <div class="soft-card rounded-3xl p-6">
                    <p class="text-3xl font-extrabold"><?= e($stat[0]) ?></p>
                    <p class="mt-2 text-sm text-slate-400"><?= e($stat[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-6 grid gap-6 lg:grid-cols-[1.2fr_.8fr]">
            <div class="soft-card rounded-3xl p-6">
                <h2 class="text-xl font-bold">Inquiry analytics</h2>
                <canvas id="adminChart" class="mt-6 max-h-80"></canvas>
                <a href="<?= url('/admin/inquiries') ?>" class="mt-5 inline-flex rounded-2xl bg-blue-500 px-5 py-3 text-sm font-bold text-white">Manage inquiries</a>
            </div>
            <div class="soft-card rounded-3xl p-6">
                <h2 class="text-xl font-bold">Approval queue</h2>
                <div class="mt-5 grid gap-3">
                    <?php $pendingProperties = array_filter($store['properties'] ?? [], fn (array $property): bool => ($property['status'] ?? '') === 'pending'); ?>
                    <?php foreach ($pendingProperties as $property): ?>
                        <div class="rounded-2xl bg-white/5 p-4"><?= e($property['title']) ?> <a class="float-right text-blue-300" href="<?= url('/admin/approvals') ?>">Review</a></div>
                    <?php endforeach; ?>
                    <?php if (!$pendingProperties): ?>
                        <p class="rounded-2xl bg-white/5 p-4 text-sm text-slate-400">No pending listings right now.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
