<?php
/** @var string|null $title */
/** @var string|null $success */
/** @var array<int, array{slug?: string, title?: string, location?: string, price?: string, user_id?: int|string, status?: string}> $properties */
$title = $title ?? 'Listings';
$success = $success ?? null;
$properties = $properties ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold"><?= e($title ?? 'Listings') ?></h1>
        <?php if (!empty($success)): ?><div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div><?php endif; ?>
        <div class="soft-card mt-8 overflow-hidden rounded-[2rem]">
            <div class="grid grid-cols-5 gap-4 border-b border-white/10 p-4 text-sm font-bold text-slate-300">
                <span class="col-span-2">Listing</span><span>Owner</span><span>Status</span><span>Moderation</span>
            </div>
            <?php foreach ($properties as $property): ?>
                <div class="grid grid-cols-5 gap-4 border-b border-white/5 p-4 text-sm text-slate-400">
                    <span class="col-span-2"><strong class="text-white"><?= e($property['title']) ?></strong><br><?= e($property['location']) ?> · <?= e($property['price']) ?></span>
                    <span>User #<?= e((string) $property['user_id']) ?></span>
                    <span><?= e($property['status']) ?></span>
                    <form method="post" action="<?= url('/admin/listings/' . $property['slug'] . '/status') ?>" class="flex flex-wrap gap-2">
                        <?= csrf_field() ?>
                        <select name="status" class="rounded-xl border border-white/10 bg-slate-950 px-2 py-1">
                            <?php foreach (['pending', 'active', 'sold', 'hidden', 'rejected'] as $status): ?>
                                <option value="<?= e($status) ?>" <?= $property['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="text-blue-300">Update</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <?php if (!$properties): ?><p class="p-5 text-slate-400">No listings in this queue.</p><?php endif; ?>
        </div>
    </div>
</section>
