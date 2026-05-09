<?php if (is_admin()): ?>
<nav class="fixed inset-x-0 bottom-0 z-40 border-t border-white/10 bg-slate-950/95 px-2 py-2 backdrop-blur-xl md:hidden">
    <div class="grid grid-cols-5 text-center text-[11px] font-semibold text-slate-400">
        <a href="<?= url('/admin') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
            Admin
        </a>
        <a href="<?= url('/admin/users') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="users" class="h-5 w-5"></i>
            Users
        </a>
        <a href="<?= url('/admin/listings') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 text-blue-300 hover:bg-blue-500/15">
            <i data-lucide="building-2" class="h-5 w-5"></i>
            Listings
        </a>
        <a href="<?= url('/admin/approvals') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="badge-check" class="h-5 w-5"></i>
            Approve
        </a>
        <a href="<?= url('/admin/inquiries') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="messages-square" class="h-5 w-5"></i>
            Leads
        </a>
    </div>
</nav>
<?php else: ?>
<nav class="fixed inset-x-0 bottom-0 z-40 border-t border-white/10 bg-slate-950/95 px-2 py-2 backdrop-blur-xl md:hidden">
    <div class="grid grid-cols-5 text-center text-[11px] font-semibold text-slate-400">
        <a href="<?= url('/') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="home" class="h-5 w-5"></i>
            Home
        </a>
        <a href="<?= url('/search') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="search" class="h-5 w-5"></i>
            Search
        </a>
        <a href="<?= is_logged_in() ? url('/dashboard/add-listing') : url('/login') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 text-blue-300 hover:bg-blue-500/15">
            <i data-lucide="plus-circle" class="h-5 w-5"></i>
            Add
        </a>
        <a href="<?= is_logged_in() ? url('/dashboard/favorites') : url('/login') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="heart" class="h-5 w-5"></i>
            Saved
        </a>
        <a href="<?= is_logged_in() ? url('/dashboard') : url('/login') ?>" class="grid place-items-center gap-1 rounded-2xl px-2 py-1.5 hover:bg-white/8 hover:text-white">
            <i data-lucide="user" class="h-5 w-5"></i>
            Account
        </a>
    </div>
</nav>
<?php endif; ?>
