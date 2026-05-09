<?php
/** @var string|null $error */
$error = $error ?? null;
?>
<section class="grid min-h-screen place-items-center px-4 pt-24">
    <form method="post" action="<?= url('/register') ?>" class="glass w-full max-w-lg rounded-[2rem] p-6">
        <h1 class="text-3xl font-extrabold">Create account</h1>
        <p class="mt-2 text-slate-400">Register as buyer, seller, or agent.</p>
        <?= csrf_field() ?>
        <?php if (!empty($error)): ?>
            <div class="mt-5 rounded-2xl border border-red-400/30 bg-red-500/10 px-4 py-3 text-sm text-red-100"><?= e($error) ?></div>
        <?php endif; ?>
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            <input name="name" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Full name" required>
            <input name="phone" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Phone">
            <input name="email" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none sm:col-span-2" placeholder="Email" type="email" required>
            <select name="role" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none sm:col-span-2">
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
                <option value="agent">Agent</option>
            </select>
            <input name="password" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none sm:col-span-2" type="password" placeholder="Password" minlength="8" required>
            <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white sm:col-span-2">Register</button>
        </div>
    </form>
</section>
