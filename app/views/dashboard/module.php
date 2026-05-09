<?php
/** @var string|null $module */
$module = $module ?? 'Dashboard Module';
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold"><?= e($module) ?></h1>
        <p class="mt-4 max-w-2xl text-slate-400">This dashboard module is routed and ready for backend data.</p>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="soft-card rounded-3xl p-6"><p class="font-bold">Active state</p><p class="mt-2 text-sm text-slate-400">No broken link or placeholder hash.</p></div>
            <div class="soft-card rounded-3xl p-6"><p class="font-bold">CRUD ready</p><p class="mt-2 text-sm text-slate-400">Forms and actions connect here.</p></div>
            <div class="soft-card rounded-3xl p-6"><p class="font-bold">Secure flow</p><p class="mt-2 text-sm text-slate-400">CSRF/session protections are planned in.</p></div>
        </div>
    </div>
</section>
