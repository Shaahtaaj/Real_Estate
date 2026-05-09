<section class="px-4 pb-20 pt-32 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
        <div>
            <h1 class="text-5xl font-extrabold leading-tight">Memon Estate works like a mobile app.</h1>
            <p class="mt-5 text-lg leading-8 text-slate-300">Install it from the browser, launch from the home screen, browse cached pages offline, and keep buyer/seller workflows inside a fast app-like shell.</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <button class="rounded-full bg-blue-500 px-6 py-3.5 text-sm font-bold text-white" data-pwa-install-button>Install app</button>
                <a href="<?= url('/properties') ?>" class="rounded-full border border-white/15 px-6 py-3.5 text-center text-sm font-bold text-white">Browse listings</a>
            </div>
        </div>
        <div class="glass rounded-[2rem] p-5">
            <div class="mx-auto max-w-sm rounded-[2rem] border border-white/10 bg-slate-950 p-4 shadow-2xl">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-400">Memon Estate</span>
                    <span class="h-2 w-16 rounded-full bg-white/20"></span>
                </div>
                <div class="mt-5 rounded-3xl bg-white/5 p-4">
                    <img src="<?= asset('images/logo-2.png') ?>" alt="Memon Estate" class="h-20 rounded-2xl bg-white object-contain p-2">
                    <p class="mt-5 text-2xl font-extrabold">Find property anywhere</p>
                    <p class="mt-2 text-sm text-slate-400">Search, save, inquire, and manage listings from one installed app.</p>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-3 text-center text-xs text-slate-300">
                    <div class="rounded-2xl bg-blue-500/15 p-3">Offline</div>
                    <div class="rounded-2xl bg-blue-500/15 p-3">Installable</div>
                    <div class="rounded-2xl bg-blue-500/15 p-3">Fast</div>
                </div>
            </div>
        </div>
    </div>
</section>
