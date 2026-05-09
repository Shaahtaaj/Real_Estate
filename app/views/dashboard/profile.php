<?php
/** @var string|null $success */
/** @var string|null $error */
$success = $success ?? null;
$error = $error ?? null;
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
        <h1 class="text-4xl font-extrabold">Profile settings</h1>
        <?php if (!empty($success)): ?>
            <div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div>
        <?php endif; ?>
        <form method="post" action="<?= url('/dashboard/profile') ?>" class="soft-card mt-8 rounded-[2rem] p-6">
            <?= csrf_field() ?>
            <div class="grid gap-4 md:grid-cols-2">
                <input name="name" value="<?= e(current_user()['name'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Full name">
                <input name="phone" value="<?= e(current_user()['phone'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Phone">
                <input name="email" value="<?= e(current_user()['email'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none md:col-span-2" placeholder="Email">
                <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white md:col-span-2">Update profile</button>
            </div>
        </form>
    </div>
</section>
