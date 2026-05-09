<?php
/** @var array<int, array{id?: int|string, name?: string, email?: string, role?: string, status?: string}> $users */
/** @var string|null $success */
$users = $users ?? [];
$success = $success ?? null;
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold">User management</h1>
        <?php if (!empty($success)): ?><div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div><?php endif; ?>
        <div class="soft-card mt-8 overflow-hidden rounded-[2rem]">
            <div class="grid grid-cols-5 gap-4 border-b border-white/10 p-4 text-sm font-bold text-slate-300">
                <span>Name</span><span>Email</span><span>Role</span><span>Status</span><span>Action</span>
            </div>
            <?php foreach ($users as $user): ?>
                <div class="grid grid-cols-5 gap-4 border-b border-white/5 p-4 text-sm text-slate-400">
                    <span class="text-white"><?= e($user['name']) ?></span>
                    <span><?= e($user['email']) ?></span>
                    <span><?= e($user['role']) ?></span>
                    <span><?= e($user['status']) ?></span>
                    <form method="post" action="<?= url('/admin/users/' . $user['id'] . '/status') ?>" class="flex gap-2">
                        <?= csrf_field() ?>
                        <select name="status" class="rounded-xl border border-white/10 bg-slate-950 px-2 py-1">
                            <option value="active">Active</option>
                            <option value="blocked">Blocked</option>
                        </select>
                        <button class="text-blue-300">Save</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
