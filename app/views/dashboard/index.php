<?php
/** @var array<int, array<string, mixed>> $properties */
/** @var array<int, array<string, mixed>> $favorites */
/** @var array{inquiries?: array<int, array{property_slug?: string}>} $store */
/** @var string|null $success */
$properties = $properties ?? [];
$favorites = $favorites ?? [];
$store = array_merge(['inquiries' => []], $store ?? []);
$success = $success ?? null;
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-6 lg:grid-cols-[17rem_1fr]">
        <aside class="glass h-fit rounded-[2rem] p-5">
            <nav class="grid gap-2 text-sm font-semibold text-slate-300">
                <a class="rounded-2xl bg-blue-500 px-4 py-3 text-white" href="<?= url('/dashboard') ?>">Overview</a>
                <a class="rounded-2xl px-4 py-3 hover:bg-white/8" href="<?= url('/dashboard/properties') ?>">My properties</a>
                <a class="rounded-2xl px-4 py-3 hover:bg-white/8" href="<?= url('/dashboard/add-listing') ?>">Add listing</a>
                <a class="rounded-2xl px-4 py-3 hover:bg-white/8" href="<?= url('/dashboard/favorites') ?>">Saved properties</a>
                <a class="rounded-2xl px-4 py-3 hover:bg-white/8" href="<?= url('/dashboard/profile') ?>">Profile</a>
            </nav>
        </aside>
        <div>
            <h1 class="text-4xl font-extrabold">User dashboard</h1>
            <?php if (!empty($success)): ?>
                <div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div>
            <?php endif; ?>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <?php
                $userSlugs = array_column($properties, 'slug');
                $inquiryCount = count(array_filter($store['inquiries'] ?? [], fn (array $inquiry): bool => in_array($inquiry['property_slug'], $userSlugs, true)));
                foreach ([[count($properties), 'My listings'], [$inquiryCount, 'Inquiries'], [count($favorites), 'Favorites']] as $stat):
                ?>
                    <div class="soft-card rounded-3xl p-6">
                        <p class="text-3xl font-extrabold"><?= e($stat[0]) ?></p>
                        <p class="mt-2 text-sm text-slate-400"><?= e($stat[1]) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-6 soft-card rounded-3xl p-6">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                    <h2 class="text-xl font-bold">Recent listings</h2>
                    <a href="<?= url('/dashboard/add-listing') ?>" class="rounded-2xl bg-blue-500 px-5 py-3 text-sm font-bold text-white">Add listing</a>
                </div>
                <div class="mt-5 grid gap-3">
                    <?php foreach (array_slice($properties, 0, 4) as $property): ?>
                        <div class="grid gap-3 rounded-2xl bg-white/5 p-4 text-sm text-slate-300 md:grid-cols-[1fr_auto_auto] md:items-center">
                            <div>
                                <p class="font-bold text-white"><?= e($property['title']) ?></p>
                                <p class="text-slate-400"><?= e($property['location']) ?> · <?= e($property['price']) ?></p>
                            </div>
                            <span class="rounded-full bg-blue-500/15 px-3 py-1 text-xs font-bold text-blue-200"><?= e($property['status']) ?></span>
                            <a class="text-blue-300" href="<?= url('/properties/' . $property['slug'] . '/edit') ?>">Edit</a>
                        </div>
                    <?php endforeach; ?>
                    <?php if (!$properties): ?>
                        <p class="rounded-2xl bg-white/5 p-4 text-sm text-slate-400">No listings yet. Add your first property.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
