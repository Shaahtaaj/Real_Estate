<?php
/** @var array<string, string> $filters */
/** @var array<int, array<string, mixed>> $properties */
$filters = $filters ?? [];
$properties = $properties ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold sm:text-5xl">Advanced search</h1>
        <p class="mt-4 max-w-2xl text-slate-400">Premium AJAX-style filtering surface for city, area, bedrooms, bathrooms, price range, property type, and sale/rent.</p>
        <form method="get" action="<?= url('/search') ?>" class="glass mt-8 grid gap-4 rounded-[2rem] p-5 md:grid-cols-4">
            <input name="city" value="<?= e($filters['city'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="City">
            <input name="area" value="<?= e($filters['area'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Area">
            <input name="beds" value="<?= e($filters['beds'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Bedrooms">
            <input name="baths" value="<?= e($filters['baths'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Bathrooms">
            <input name="min_price" value="<?= e($filters['min_price'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Min price">
            <input name="max_price" value="<?= e($filters['max_price'] ?? '') ?>" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Max price">
            <select name="purpose" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none">
                <option value="">Sale/Rent</option>
                <option value="sale" <?= ($filters['purpose'] ?? '') === 'sale' ? 'selected' : '' ?>>Sale</option>
                <option value="rent" <?= ($filters['purpose'] ?? '') === 'rent' ? 'selected' : '' ?>>Rent</option>
            </select>
            <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white">Apply filters</button>
        </form>
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($properties as $property): ?>
                <?php require APP_PATH . '/views/partials/property-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
