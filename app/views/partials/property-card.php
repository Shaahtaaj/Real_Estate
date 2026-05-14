<?php
/**
 * @var array{
 *     slug?: string,
 *     title?: string,
 *     type?: string,
 *     price?: string,
 *     location?: string,
 *     beds?: int|string,
 *     baths?: int|string,
 *     area?: string,
 *     area_size?: string,
 *     image?: string,
 *     status?: string
 * } $property
 */
$cardProperty = array_merge([
    'slug' => '',
    'title' => 'Property',
    'type' => 'For Sale',
    'price' => 'Price on request',
    'location' => 'Karachi',
    'beds' => 0,
    'baths' => 0,
    'area' => '',
    'area_size' => '',
    'image' => 'assets/images/property-1.svg',
    'status' => 'active',
], $property ?? []);
?>
<article class="property-card soft-card overflow-hidden rounded-3xl">
    <div class="relative aspect-[4/3] overflow-hidden">
        <?php $cardImage = media_url((string) $cardProperty['image']); ?>
        <img src="<?= e($cardImage) ?>" alt="<?= e((string) $cardProperty['title']) ?>" class="h-full w-full object-cover" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/10 to-transparent"></div>
        <div class="absolute left-4 top-4 rounded-full bg-blue-500 px-3 py-1 text-xs font-bold text-white shadow-lg shadow-blue-950/40"><?= e((string) $cardProperty['type']) ?></div>
        <?php if (is_logged_in()): ?>
            <form method="post" action="<?= url('/property/' . $cardProperty['slug'] . '/favorite') ?>" class="absolute right-4 top-4">
                <?= csrf_field() ?>
                <button class="grid h-10 w-10 place-items-center rounded-full border border-white/20 bg-slate-950/45 text-white backdrop-blur transition hover:bg-blue-500" aria-label="Add to favorites">
                    <i data-lucide="heart" class="h-4 w-4"></i>
                </button>
            </form>
        <?php else: ?>
            <a href="<?= url('/login') ?>" class="absolute right-4 top-4 grid h-10 w-10 place-items-center rounded-full border border-white/20 bg-slate-950/45 text-white backdrop-blur transition hover:bg-blue-500" aria-label="Login to save favorite">
                <i data-lucide="heart" class="h-4 w-4"></i>
            </a>
        <?php endif; ?>
        <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between gap-4">
            <p class="text-2xl font-extrabold"><?= e((string) $cardProperty['price']) ?></p>
            <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-300"><?= e((string) $cardProperty['status']) ?></span>
        </div>
    </div>
    <div class="p-5">
        <h3 class="text-lg font-bold"><?= e((string) $cardProperty['title']) ?></h3>
        <p class="mt-2 flex items-center gap-2 text-sm text-slate-400">
            <i data-lucide="map-pin" class="h-4 w-4 text-blue-300"></i>
            <?= e((string) $cardProperty['location']) ?>
        </p>
        <div class="mt-5 grid grid-cols-3 gap-3 text-sm text-slate-300">
            <span class="rounded-2xl bg-white/5 px-3 py-2"><strong><?= e((string) $cardProperty['beds']) ?></strong> Beds</span>
            <span class="rounded-2xl bg-white/5 px-3 py-2"><strong><?= e((string) $cardProperty['baths']) ?></strong> Baths</span>
            <span class="rounded-2xl bg-white/5 px-3 py-2"><strong><?= e((string) ($cardProperty['area_size'] ?: $cardProperty['area'])) ?></strong></span>
        </div>
        <a href="<?= url('/property/' . $cardProperty['slug']) ?>" class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-bold text-slate-950 transition hover:bg-blue-100">
            View details
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
        </a>
    </div>
</article>
