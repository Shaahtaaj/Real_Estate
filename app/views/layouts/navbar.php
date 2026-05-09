<header class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-slate-950/60 backdrop-blur-xl">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="<?= url('/') ?>" class="flex items-center gap-3">
            <span class="grid h-12 w-12 place-items-center overflow-hidden rounded-2xl border border-white/10 bg-white/95 shadow-xl shadow-blue-950/30">
                <img src="<?= asset('images/logo-2.png') ?>" alt="Memon Estate" class="h-full w-full object-contain">
            </span>
            <span class="leading-tight">
                <span class="block text-base font-extrabold tracking-normal">Memon Estate</span>
                <span class="block text-xs font-medium text-slate-400">Premium property network</span>
            </span>
        </a>
        <details class="relative md:hidden">
            <summary class="list-none rounded-xl border border-white/10 p-2 text-slate-200" aria-label="Open navigation">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </summary>
            <div class="absolute right-0 top-14 w-64 rounded-3xl border border-white/10 bg-slate-950/95 p-4 shadow-2xl backdrop-blur-xl">
                <div class="grid gap-3 text-sm font-medium text-slate-300">
                    <a href="<?= url('/') ?>">Home</a>
                    <a href="<?= url('/properties') ?>">Properties</a>
                    <a href="<?= url('/app/') ?>">App</a>
                    <a href="<?= url('/about') ?>">About</a>
                    <a href="<?= url('/contact') ?>">Contact</a>
                    <?php if (is_logged_in()): ?>
                        <?php if (is_admin()): ?>
                            <a href="<?= url('/admin') ?>">Admin</a>
                            <a href="<?= url('/admin/users') ?>">Users</a>
                            <a href="<?= url('/admin/listings') ?>">Listings</a>
                            <a href="<?= url('/admin/inquiries') ?>">Inquiries</a>
                        <?php else: ?>
                            <a href="<?= url('/dashboard') ?>">Dashboard</a>
                        <?php endif; ?>
                        <a href="<?= url('/logout') ?>">Logout</a>
                    <?php else: ?>
                        <a href="<?= url('/login') ?>">Sign in</a>
                    <?php endif; ?>
                </div>
            </div>
        </details>
        <div class="hidden items-center gap-8 text-sm font-medium text-slate-300 md:flex" data-nav-menu>
            <a class="transition hover:text-white" href="<?= url('/') ?>">Home</a>
            <a class="transition hover:text-white" href="<?= url('/properties') ?>">Properties</a>
            <a class="transition hover:text-white" href="<?= url('/app/') ?>">App</a>
            <a class="transition hover:text-white" href="<?= url('/about') ?>">About</a>
            <a class="transition hover:text-white" href="<?= url('/contact') ?>">Contact</a>
            <?php if (is_logged_in()): ?>
                <?php if (is_admin()): ?>
                    <a class="transition hover:text-white" href="<?= url('/admin') ?>">Admin</a>
                    <a class="transition hover:text-white" href="<?= url('/admin/listings') ?>">Listings</a>
                    <a class="transition hover:text-white" href="<?= url('/admin/inquiries') ?>">Inquiries</a>
                <?php else: ?>
                    <a class="transition hover:text-white" href="<?= url('/dashboard') ?>">Dashboard</a>
                <?php endif; ?>
                <a href="<?= url('/logout') ?>" class="rounded-full border border-white/15 px-5 py-2.5 text-white transition hover:border-blue-400 hover:bg-blue-500/10">Logout</a>
            <?php else: ?>
                <a href="<?= url('/login') ?>" class="rounded-full border border-white/15 px-5 py-2.5 text-white transition hover:border-blue-400 hover:bg-blue-500/10">Sign in</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
