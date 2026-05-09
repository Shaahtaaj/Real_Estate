<?php
/** @var array{slug?: string, title?: string}|null $property */
$property = $property ?? [];
?>
<section class="grid min-h-screen place-items-center px-4 pt-24">
    <div class="glass max-w-lg rounded-[2rem] p-6 text-center">
        <i data-lucide="trash-2" class="mx-auto h-10 w-10 text-red-300"></i>
        <h1 class="mt-5 text-3xl font-extrabold">Delete property</h1>
        <p class="mt-3 text-slate-400">Confirm deletion for <?= e($property['title'] ?? 'this property') ?>. The real backend will protect this action with CSRF and ownership/admin checks.</p>
        <div class="mt-6 flex justify-center gap-3">
            <a href="<?= url('/dashboard/properties') ?>" class="rounded-2xl border border-white/10 px-5 py-3 font-bold text-white">Cancel</a>
            <form method="post" action="<?= url('/properties/' . ($property['slug'] ?? '') . '/delete') ?>">
                <?= csrf_field() ?>
                <button class="rounded-2xl bg-red-500 px-5 py-3 font-bold text-white">Delete</button>
            </form>
        </div>
    </div>
</section>
