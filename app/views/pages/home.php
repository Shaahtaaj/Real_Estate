<?php
/** @var array<int, array<string, mixed>> $properties */
$properties = $properties ?? [];
?>
<section class="relative min-h-screen overflow-hidden px-4 pt-28 sm:px-6 lg:px-8">
    <div class="absolute inset-0 -z-10">
        <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=2200&q=90" alt="Luxury property interior" class="h-full w-full object-cover opacity-35">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/70 via-slate-950/82 to-slate-950"></div>
    </div>
    <div class="mx-auto grid max-w-7xl items-center gap-10 pb-20 lg:grid-cols-[1.05fr_.95fr]">
        <div class="max-w-3xl">
            <img data-hero-reveal src="<?= asset('images/logo-2.png') ?>" alt="Memon Estate" class="mb-8 h-24 w-auto rounded-3xl bg-white/95 p-2 shadow-2xl shadow-blue-950/40">
            <h1 data-hero-reveal class="text-5xl font-extrabold leading-[1.02] tracking-normal text-white sm:text-6xl lg:text-7xl">Find Karachi property with premium clarity.</h1>
            <p data-hero-reveal class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">Memon Estate brings verified listings, smart search, map discovery, lead inquiries, and agent-ready dashboards into one modern real estate platform.</p>
            <div data-hero-reveal class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="<?= url('/properties') ?>" class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-500 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-blue-950/40 transition hover:bg-blue-400">
                    Explore listings <i data-lucide="building-2" class="h-4 w-4"></i>
                </a>
                <a href="<?= url('/register') ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/15 bg-white/8 px-6 py-3.5 text-sm font-bold text-white backdrop-blur transition hover:bg-white/15">
                    Add property <i data-lucide="plus" class="h-4 w-4"></i>
                </a>
            </div>
        </div>
        <div data-hero-reveal class="glass rounded-[2rem] p-4 sm:p-6">
            <form method="get" action="<?= url('/search') ?>" class="grid gap-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="grid gap-2 text-sm font-semibold text-slate-200">City
                        <select name="city" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-slate-200 outline-none focus:border-blue-400">
                            <option value="Karachi">Karachi</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Lahore">Lahore</option>
                        </select>
                    </label>
                    <label class="grid gap-2 text-sm font-semibold text-slate-200">Purpose
                        <select name="purpose" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-slate-200 outline-none focus:border-blue-400">
                            <option value="sale">Buy</option>
                            <option value="rent">Rent</option>
                            <option value="">Any</option>
                        </select>
                    </label>
                </div>
                <label class="grid gap-2 text-sm font-semibold text-slate-200">Search area, society, or landmark
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 focus-within:border-blue-400">
                        <i data-lucide="search" class="h-5 w-5 text-slate-400"></i>
                        <input name="area" class="w-full bg-transparent text-slate-100 outline-none placeholder:text-slate-500" placeholder="DHA, Clifton, Bahria Town, Gulshan...">
                    </div>
                </label>
                <div class="grid gap-4 sm:grid-cols-3">
                    <input name="min_price" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-slate-200 outline-none focus:border-blue-400" placeholder="Min price">
                    <input name="max_price" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-slate-200 outline-none focus:border-blue-400" placeholder="Max price">
                    <select name="beds" class="rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-slate-200 outline-none focus:border-blue-400">
                        <option value="">Any beds</option>
                        <option value="2">2+</option>
                        <option value="3">3+</option>
                        <option value="5">5+</option>
                    </select>
                </div>
                <button class="rounded-2xl bg-white px-5 py-4 text-sm font-extrabold text-slate-950 transition hover:bg-blue-100">Search properties</button>
            </form>
            <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                <div class="rounded-2xl bg-white/8 p-4">
                    <p class="text-2xl font-extrabold">1.8k</p>
                    <p class="mt-1 text-xs text-slate-400">Listings</p>
                </div>
                <div class="rounded-2xl bg-white/8 p-4">
                    <p class="text-2xl font-extrabold">24h</p>
                    <p class="mt-1 text-xs text-slate-400">Approval</p>
                </div>
                <div class="rounded-2xl bg-white/8 p-4">
                    <p class="text-2xl font-extrabold">92%</p>
                    <p class="mt-1 text-xs text-slate-400">Lead reply</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div data-aos="fade-up">
                <h2 class="text-3xl font-extrabold sm:text-4xl">Featured properties</h2>
                <p class="mt-3 max-w-2xl text-slate-400">Image-rich listing cards with badges, favorites, pricing, location, quick specs, hover motion, and clean CTAs.</p>
            </div>
            <a href="<?= url('/properties') ?>" class="inline-flex items-center gap-2 text-sm font-bold text-blue-300">View all <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <?php foreach ($properties as $property): ?>
                <div data-aos="fade-up">
                    <?php require APP_PATH . '/views/partials/property-card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-6 lg:grid-cols-4">
        <?php foreach ([['Home', 'Villas and family houses', 'home'], ['Apartments', 'High-rise and studio units', 'building'], ['Commercial', 'Shops, offices, and plots', 'briefcase-business'], ['Rentals', 'Short and long-term homes', 'key-round']] as $category): ?>
            <div data-aos="fade-up" class="soft-card rounded-3xl p-6">
                <i data-lucide="<?= e($category[2]) ?>" class="h-8 w-8 text-blue-300"></i>
                <h3 class="mt-5 text-xl font-bold"><?= e($category[0]) ?></h3>
                <p class="mt-2 text-sm text-slate-400"><?= e($category[1]) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
        <div data-aos="fade-right">
            <h2 class="text-3xl font-extrabold sm:text-4xl">Built for buyers, sellers, agents, and admins.</h2>
            <p class="mt-4 text-slate-400">The platform roadmap already includes user dashboards, property approval flows, analytics, inquiries, PWA installability, and secure CRUD modules.</p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <?php foreach ([['ShieldCheck', 'Verified listings'], ['MapPinned', 'Location search'], ['MessagesSquare', 'Inquiry pipeline'], ['ChartNoAxesCombined', 'Admin analytics']] as $item): ?>
                <div data-aos="fade-up" class="glass rounded-3xl p-6">
                    <i data-lucide="<?= strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $item[0])) ?>" class="h-7 w-7 text-emerald-300"></i>
                    <p class="mt-4 font-bold"><?= e($item[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="px-4 pb-24 sm:px-6 lg:px-8">
    <div class="mx-auto overflow-hidden rounded-[2rem] border border-white/10 bg-blue-500 p-8 shadow-2xl shadow-blue-950/40 md:p-12">
        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-white">Ready to list a premium property?</h2>
                <p class="mt-3 max-w-2xl text-blue-50">Create an account, submit property details, upload multiple images, and send listings for admin approval.</p>
            </div>
            <a href="<?= url('/register') ?>" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3.5 text-sm font-extrabold text-slate-950">Start now <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
        </div>
    </div>
</section>
