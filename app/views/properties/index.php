<?php
/** @var array<int, array<string, mixed>> $properties */
$properties = $properties ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div>
                <h1 class="text-4xl font-extrabold sm:text-5xl">Property listings</h1>
                <p class="mt-4 max-w-2xl text-slate-400">AJAX-ready filters for city, area, price, bedrooms, bathrooms, type, sale, and rent.</p>
            </div>
            <button class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-500 px-5 py-3 text-sm font-bold text-white">
                <i data-lucide="sliders-horizontal" class="h-4 w-4"></i> Advanced filters
            </button>
        </div>
        <div class="glass mt-8 grid gap-4 rounded-3xl p-4 md:grid-cols-5">
            <input class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="City">
            <input class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Area">
            <select class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none"><option>Property type</option></select>
            <select class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none"><option>Price range</option></select>
            <button class="rounded-2xl bg-white px-4 py-3 font-bold text-slate-950">Search</button>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($properties as $property): ?>
                <?php require APP_PATH . '/views/partials/property-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
