<footer class="border-t border-white/10 bg-slate-950">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-[1.5fr_1fr_1fr] lg:px-8">
        <div>
            <div class="flex items-center gap-3">
                <img src="<?= asset('images/logo-2.png') ?>" alt="Memon Estate" class="h-12 w-12 rounded-2xl bg-white object-contain">
                <div>
                    <p class="font-bold">Memon Estate</p>
                    <p class="text-sm text-slate-400">Karachi real estate, made simpler.</p>
                </div>
            </div>
            <p class="mt-5 max-w-md text-sm leading-6 text-slate-400">Buy, sell, rent, and manage verified properties with a premium listing platform built for agents, sellers, and serious buyers.</p>
        </div>
        <div>
            <p class="font-semibold">Platform</p>
            <div class="mt-4 grid gap-3 text-sm text-slate-400">
                <a href="<?= url('/properties') ?>">Listings</a>
                <a href="<?= url('/app/') ?>">PWA app</a>
                <?php if (is_logged_in() && !is_admin()): ?>
                    <a href="<?= url('/dashboard') ?>">User dashboard</a>
                <?php endif; ?>
                <?php if (is_admin()): ?>
                    <a href="<?= url('/admin') ?>">Admin panel</a>
                    <a href="<?= url('/admin/inquiries') ?>">Manage inquiries</a>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <p class="font-semibold">Contact</p>
            <div class="mt-4 grid gap-3 text-sm text-slate-400">
                <span>Karachi, Pakistan</span>
                <span>WhatsApp ready inquiries</span>
                <span>info@memonestate.local</span>
            </div>
        </div>
    </div>
</footer>
