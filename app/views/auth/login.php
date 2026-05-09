<?php
/** @var array<string, array{name?: string, email?: string, password?: string}> $demoUsers */
/** @var string|null $error */
/** @var string|null $success */
$demoUsers = $demoUsers ?? [];
$error = $error ?? null;
$success = $success ?? null;
?>
<section class="grid min-h-screen place-items-center px-4 pt-24">
    <form method="post" action="<?= url('/login') ?>" class="glass w-full max-w-md rounded-[2rem] p-6">
        <h1 class="text-3xl font-extrabold">Welcome back</h1>
        <p class="mt-2 text-slate-400">Login to manage favorites, inquiries, and listings.</p>
        <?= csrf_field() ?>
        <?php if (!empty($error)): ?>
            <div class="mt-5 rounded-2xl border border-red-400/30 bg-red-500/10 px-4 py-3 text-sm text-red-100"><?= e($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div>
        <?php endif; ?>
        <div class="mt-6 grid gap-4">
            <input name="email" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Email" autocomplete="email" required>
            <input name="password" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" type="password" placeholder="Password" autocomplete="current-password" required>
            <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white">Login</button>
            <a href="<?= url('/register') ?>" class="text-center text-sm text-blue-300">Create account</a>
        </div>
        <div class="mt-6 rounded-3xl bg-white/5 p-4 text-sm text-slate-300">
            <p class="font-bold text-white">Test accounts</p>
            <div class="mt-3 grid gap-2 text-xs text-slate-400">
                <?php foreach ($demoUsers as $demoUser): ?>
                    <button type="button" class="rounded-2xl bg-slate-950/70 px-3 py-2 text-left transition hover:bg-blue-500/20" data-fill-login data-email="<?= e($demoUser['email']) ?>" data-password="<?= e($demoUser['password']) ?>">
                        <span class="font-semibold text-slate-200"><?= e($demoUser['name']) ?></span>
                        <span class="block"><?= e($demoUser['email']) ?> / <?= e($demoUser['password']) ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</section>
