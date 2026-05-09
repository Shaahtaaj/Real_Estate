<?php
/** @var string|null $mode */
/** @var string|null $action */
/** @var array<string, mixed>|null $property */
$mode = $mode ?? 'Add';
$action = $action ?? url('/properties/add');
$property = $property ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <h1 class="text-4xl font-extrabold"><?= e($mode) ?> property</h1>
        <p class="mt-4 text-slate-400">Upload multiple property photos. Images are validated, compressed to WebP, thumbnailed, and submitted as pending for admin approval.</p>
        <form method="post" action="<?= e($action) ?>" enctype="multipart/form-data" class="soft-card mt-8 rounded-[2rem] p-6">
            <?= csrf_field() ?>
            <div class="grid gap-4 md:grid-cols-2">
                <input name="title" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Property title" value="<?= e($property['title'] ?? '') ?>" required>
                <input name="price" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Display price e.g. PKR 2.5 Cr" value="<?= e($property['price'] ?? '') ?>" required>
                <input name="price_value" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Numeric price for filters" value="<?= e((string) ($property['price_value'] ?? '')) ?>">
                <input name="city" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="City" value="<?= e($property['city'] ?? 'Karachi') ?>">
                <input name="area" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Area" value="<?= e($property['area'] ?? '') ?>">
                <input name="property_type" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Property type" value="<?= e($property['property_type'] ?? 'Apartment') ?>">
                <input name="beds" type="number" min="0" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Bedrooms" value="<?= e((string) ($property['beds'] ?? '')) ?>">
                <input name="baths" type="number" min="0" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Bathrooms" value="<?= e((string) ($property['baths'] ?? '')) ?>">
                <input name="area_size" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none" placeholder="Area size" value="<?= e($property['area_size'] ?? $property['area'] ?? '') ?>">
                <select name="purpose" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none">
                    <option value="sale" <?= ($property['purpose'] ?? '') === 'sale' ? 'selected' : '' ?>>For Sale</option>
                    <option value="rent" <?= ($property['purpose'] ?? '') === 'rent' ? 'selected' : '' ?>>For Rent</option>
                </select>
                <input name="image" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none md:col-span-2" placeholder="Image URL" value="<?= e($property['image'] ?? '') ?>">
                <textarea name="description" class="min-h-44 rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 outline-none md:col-span-2" placeholder="Rich text description"><?= e($property['description'] ?? '') ?></textarea>
                <label class="rounded-3xl border border-dashed border-white/20 p-10 text-center text-slate-400 md:col-span-2 transition hover:border-blue-400 hover:bg-blue-500/10" data-drop-zone>
                    <i data-lucide="upload-cloud" class="mx-auto mb-3 h-8 w-8 text-blue-300"></i>
                    <span class="block font-bold text-slate-200">Drag and drop property images</span>
                    <span class="mt-2 block text-sm">or click to choose JPG, PNG, or WebP files up to 5MB each</span>
                    <input name="images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple class="hidden" data-file-input>
                    <span class="mt-4 block text-xs text-blue-300" data-file-summary>
                        <?= !empty($property['images']) ? count($property['images']) . ' uploaded image(s) saved' : 'No files selected yet' ?>
                    </span>
                </label>
                <?php if (!empty($property['images'])): ?>
                    <div class="grid gap-3 md:col-span-2 md:grid-cols-4">
                        <?php foreach ($property['images'] as $image): ?>
                            <img src="<?= upload_asset($image['thumbnail'] ?? $image['webp'] ?? $image['original']) ?>" alt="Property upload" class="h-28 w-full rounded-2xl object-cover">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <button class="mt-6 rounded-2xl bg-blue-500 px-6 py-3 font-bold text-white">Save property</button>
        </form>
    </div>
</section>
