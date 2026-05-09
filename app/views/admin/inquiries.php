<?php
/** @var string|null $success */
/** @var array<int, array{id?: int|string, property_slug?: string, name?: string, phone?: string, message?: string, status?: string, created_at?: string}> $inquiries */
$success = $success ?? null;
$inquiries = $inquiries ?? [];
?>
<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="text-4xl font-extrabold">Inquiry management</h1>
                <p class="mt-3 text-slate-400">Track buyer leads, call or WhatsApp them, and move each inquiry through the sales pipeline.</p>
            </div>
            <a href="<?= url('/admin') ?>" class="rounded-2xl border border-white/10 px-5 py-3 text-sm font-bold text-white">Back to admin</a>
        </div>
        <?php if (!empty($success)): ?><div class="mt-5 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100"><?= e($success) ?></div><?php endif; ?>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <?php
            $newCount = count(array_filter($inquiries, fn (array $item): bool => ($item['status'] ?? '') === 'new'));
            $contactedCount = count(array_filter($inquiries, fn (array $item): bool => ($item['status'] ?? '') === 'contacted'));
            $closedCount = count(array_filter($inquiries, fn (array $item): bool => ($item['status'] ?? '') === 'closed'));
            foreach ([[$newCount, 'New leads'], [$contactedCount, 'Contacted'], [$closedCount, 'Closed']] as $stat):
            ?>
                <div class="soft-card rounded-3xl p-6">
                    <p class="text-3xl font-extrabold"><?= e((string) $stat[0]) ?></p>
                    <p class="mt-2 text-sm text-slate-400"><?= e($stat[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8 grid gap-4">
            <?php foreach ($inquiries as $inquiry): ?>
                <div class="soft-card rounded-3xl p-5">
                    <div class="grid gap-4 md:grid-cols-[1fr_auto] md:items-start">
                        <div>
                            <p class="font-bold text-white"><?= e($inquiry['name']) ?> · <?= e($inquiry['phone']) ?></p>
                            <p class="mt-2 text-sm text-slate-400"><?= e($inquiry['message']) ?></p>
                            <p class="mt-2 text-xs text-blue-300"><?= e($inquiry['property_slug']) ?> · <?= e($inquiry['status']) ?> · <?= e($inquiry['created_at'] ?? '') ?></p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <?php if (($inquiry['property_slug'] ?? '') !== 'general-contact'): ?>
                                    <a class="rounded-xl border border-white/10 px-3 py-2 text-xs font-bold text-slate-200" href="<?= url('/property/' . $inquiry['property_slug']) ?>">View property</a>
                                <?php endif; ?>
                                <a class="rounded-xl bg-emerald-500 px-3 py-2 text-xs font-bold text-white" href="https://wa.me/<?= preg_replace('/\D+/', '', $inquiry['phone']) ?>" target="_blank" rel="noopener">WhatsApp</a>
                                <a class="rounded-xl bg-blue-500 px-3 py-2 text-xs font-bold text-white" href="tel:<?= e($inquiry['phone']) ?>">Call</a>
                            </div>
                        </div>
                        <form method="post" action="<?= url('/admin/inquiries/' . $inquiry['id'] . '/status') ?>" class="flex gap-2">
                            <?= csrf_field() ?>
                            <select name="status" class="rounded-xl border border-white/10 bg-slate-950 px-2 py-1">
                                <option value="new" <?= ($inquiry['status'] ?? '') === 'new' ? 'selected' : '' ?>>New</option>
                                <option value="contacted" <?= ($inquiry['status'] ?? '') === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                                <option value="closed" <?= ($inquiry['status'] ?? '') === 'closed' ? 'selected' : '' ?>>Closed</option>
                            </select>
                            <button class="rounded-xl bg-blue-500 px-4 py-2 text-sm font-bold text-white">Save</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (!$inquiries): ?>
                <p class="rounded-3xl bg-white/5 p-6 text-slate-400">No inquiries yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
