<?php
/** @var array<int, array{name?: string, message?: string, phone?: string, status?: string}> $notifications */
$notifications = $notifications ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <h1 class="text-4xl font-extrabold">Notifications</h1>
        <div class="mt-8 grid gap-4">
            <?php foreach ($notifications as $notification): ?>
                <div class="soft-card rounded-3xl p-5">
                    <p class="font-bold text-white">New inquiry from <?= e($notification['name']) ?></p>
                    <p class="mt-2 text-sm text-slate-400"><?= e($notification['message']) ?></p>
                    <p class="mt-3 text-xs text-blue-300"><?= e($notification['phone']) ?> · <?= e($notification['status']) ?></p>
                </div>
            <?php endforeach; ?>
            <?php if (!$notifications): ?>
                <p class="rounded-3xl bg-white/5 p-6 text-slate-400">No notifications yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
