<?php
/** @var string|null $success */
/** @var string|null $error */
$success = $success ?? null;
$error = $error ?? null;
?>
<section class="grid min-h-screen place-items-center px-4 pt-24">
    <form method="post" action="<?= url('/forgot-password') ?>" class="glass w-full max-w-md rounded-[2rem] p-6">
        <h1 class="text-3xl font-extrabold">Reset password</h1>
        <p class="mt-2 text-slate-400">Enter your email to receive a secure reset link.</p>
        <?= csrf_field() ?>
        <?php if (!empty($success)): ?><div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div><?php endif; ?>
        <?php if (!empty($error)): ?><div class="mt-5 rounded-2xl border border-red-400/30 bg-red-500/10 px-4 py-3 text-sm text-red-100"><?= e($error) ?></div><?php endif; ?>
        <div class="mt-6 grid gap-4">
            <input name="email" type="email" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Email" required>
            <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white">Send reset link</button>
        </div>
    </form>
</section>
