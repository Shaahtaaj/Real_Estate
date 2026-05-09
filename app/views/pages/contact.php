<?php
/** @var string|null $success */
/** @var string|null $error */
$success = $success ?? null;
$error = $error ?? null;
?>
<section class="px-4 py-32 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-2">
        <div>
            <h1 class="text-5xl font-extrabold">Contact</h1>
            <p class="mt-6 text-lg leading-8 text-slate-300">Send an inquiry or connect through WhatsApp for property buying, selling, renting, and agent onboarding.</p>
        </div>
        <form method="post" action="<?= url('/contact') ?>" class="glass rounded-[2rem] p-6">
            <?= csrf_field() ?>
            <?php if (!empty($success)): ?><div class="mb-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div><?php endif; ?>
            <?php if (!empty($error)): ?><div class="mb-5 rounded-2xl border border-red-400/30 bg-red-500/10 px-4 py-3 text-sm text-red-100"><?= e($error) ?></div><?php endif; ?>
            <div class="grid gap-4">
                <input name="name" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Name" required>
                <input name="phone" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Phone" required>
                <textarea name="message" class="min-h-36 rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Message" required></textarea>
                <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white">Send message</button>
            </div>
        </form>
    </div>
</section>
