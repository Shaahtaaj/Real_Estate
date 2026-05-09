<?php
/** @var array<int, array{slug?: string, title?: string, location?: string, status?: string, price?: string}> $properties */
/** @var string|null $success */
$properties = $properties ?? [];
$success = $success ?? null;
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-4xl font-extrabold">My properties</h1>
                <p class="mt-3 text-slate-400">Add, edit, delete, and track admin approval status.</p>
            </div>
            <a href="<?= url('/dashboard/add-listing') ?>" class="rounded-2xl bg-blue-500 px-5 py-3 text-sm font-bold text-white">Add listing</a>
        </div>
        <?php if (!empty($success)): ?>
            <div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div>
        <?php endif; ?>
        <div class="soft-card mt-8 overflow-hidden rounded-[2rem]">
            <div class="grid grid-cols-5 gap-4 border-b border-white/10 p-4 text-sm font-bold text-slate-300">
                <span class="col-span-2">Property</span><span>Status</span><span>Price</span><span>Actions</span>
            </div>
            <?php foreach ($properties as $property): ?>
                <div class="grid grid-cols-5 gap-4 border-b border-white/5 p-4 text-sm text-slate-400">
                    <span class="col-span-2"><strong class="text-white"><?= e($property['title']) ?></strong><br><?= e($property['location']) ?></span>
                    <span><?= e($property['status']) ?></span>
                    <span><?= e($property['price']) ?></span>
                    <span class="flex flex-wrap gap-3">
                        <a class="text-blue-300" href="<?= url('/property/' . $property['slug']) ?>">View</a>
                        <a class="text-blue-300" href="<?= url('/properties/' . $property['slug'] . '/edit') ?>">Edit</a>
                        <a class="text-red-300" href="<?= url('/properties/' . $property['slug'] . '/delete') ?>">Delete</a>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
