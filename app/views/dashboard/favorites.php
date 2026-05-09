<?php
/** @var array<int, array<string, mixed>> $properties */
$properties = $properties ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-4xl font-extrabold">Saved properties</h1>
        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($properties as $property): ?>
                <?php require APP_PATH . '/views/partials/property-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <?php if (!$properties): ?>
            <p class="mt-8 rounded-3xl bg-white/5 p-6 text-slate-400">No saved properties yet.</p>
        <?php endif; ?>
    </div>
</section>
