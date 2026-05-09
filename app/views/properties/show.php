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
 *     images?: array<int, array{original?: string, webp?: string, thumbnail?: string}>
 * } $property
 * @var string|null $success
 */
$viewProperty = array_merge([
    'slug' => '',
    'title' => 'Property',
    'type' => 'For Sale',
    'price' => 'Price on request',
    'location' => 'Karachi',
    'beds' => 0,
    'baths' => 0,
    'area' => '',
    'area_size' => '',
    'image' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
    'images' => [],
], $property ?? []);
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-8 lg:grid-cols-[1.1fr_.9fr]">
            <div>
                <div class="overflow-hidden rounded-[2rem] border border-white/10">
                    <?php $heroImage = str_starts_with((string) $viewProperty['image'], 'uploads/') ? upload_asset((string) $viewProperty['image']) : (string) $viewProperty['image']; ?>
                    <img src="<?= e($heroImage) ?>" alt="<?= e((string) $viewProperty['title']) ?>" class="h-[34rem] w-full object-cover">
                </div>
                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <?php foreach (($viewProperty['images'] ?? []) as $image): ?>
                        <img src="<?= upload_asset($image['thumbnail'] ?? $image['webp'] ?? $image['original'] ?? '') ?>" alt="<?= e((string) $viewProperty['title']) ?>" class="h-28 w-full rounded-3xl object-cover">
                    <?php endforeach; ?>
                    <?php if (empty($viewProperty['images'])): ?>
                        <div class="skeleton h-28 rounded-3xl"></div>
                        <div class="skeleton h-28 rounded-3xl"></div>
                        <div class="skeleton h-28 rounded-3xl"></div>
                    <?php endif; ?>
                </div>
            </div>
            <aside class="glass h-fit rounded-[2rem] p-6">
                <?php if (!empty($success)): ?>
                    <div class="mb-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div>
                <?php endif; ?>
                <p class="text-sm font-bold text-blue-300"><?= e((string) $viewProperty['type']) ?></p>
                <h1 class="mt-3 text-4xl font-extrabold"><?= e((string) $viewProperty['title']) ?></h1>
                <p class="mt-3 flex items-center gap-2 text-slate-400"><i data-lucide="map-pin" class="h-4 w-4"></i><?= e((string) $viewProperty['location']) ?></p>
                <p class="mt-6 text-4xl font-extrabold text-white"><?= e((string) $viewProperty['price']) ?></p>
                <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                    <span class="rounded-2xl bg-white/8 p-4"><strong><?= e((string) $viewProperty['beds']) ?></strong><br><small class="text-slate-400">Beds</small></span>
                    <span class="rounded-2xl bg-white/8 p-4"><strong><?= e((string) $viewProperty['baths']) ?></strong><br><small class="text-slate-400">Baths</small></span>
                    <span class="rounded-2xl bg-white/8 p-4"><strong><?= e((string) ($viewProperty['area_size'] ?: $viewProperty['area'])) ?></strong><br><small class="text-slate-400">Area</small></span>
                </div>
                <p class="mt-6 leading-7 text-slate-300">A premium listing page foundation with gallery, overview, amenities, map, agent info, inquiry form, related properties, image zoom, and lightbox-ready layout.</p>
                <form method="post" action="<?= url('/property/' . $viewProperty['slug'] . '/favorite') ?>" class="mt-6">
                    <?= csrf_field() ?>
                    <button class="w-full rounded-2xl border border-white/10 px-4 py-3 font-bold text-white">Save to favorites</button>
                </form>
                <form method="post" action="<?= url('/property/' . $viewProperty['slug'] . '/inquiry') ?>" class="mt-4 grid gap-3">
                    <?= csrf_field() ?>
                    <input name="name" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Your name" required>
                    <input name="phone" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Phone or WhatsApp" required>
                    <textarea name="message" class="min-h-28 rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="I am interested in this property" required></textarea>
                    <button class="rounded-2xl bg-blue-500 px-4 py-3 font-bold text-white">Send inquiry</button>
                    <a class="rounded-2xl bg-emerald-500 px-4 py-3 text-center font-bold text-white" href="https://wa.me/923000000000?text=I%20am%20interested%20in%20<?= rawurlencode((string) $viewProperty['title']) ?>" target="_blank" rel="noopener">WhatsApp agent</a>
                </form>
            </aside>
        </div>
        <div class="mt-10 overflow-hidden rounded-[2rem] border border-white/10">
            <div id="property-map" class="h-96"></div>
        </div>
    </div>
</section>
