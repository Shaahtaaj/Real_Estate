<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Memon Estate is a premium real estate listing platform for buying, selling, and renting property in Karachi.">
    <meta property="og:title" content="<?= e($title ?? 'Memon Estate') ?>">
    <meta property="og:description" content="Luxury property listings, map search, dashboards, inquiries, and verified real estate leads.">
    <meta property="og:type" content="website">
    <title><?= e($title ?? 'Memon Estate') ?></title>
    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Memon Estate">
    <link rel="manifest" href="<?= url('/manifest.json') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        estate: {
                            bg: '#0f172a',
                            panel: '#111827',
                            accent: '#3b82f6',
                            muted: '#94a3b8',
                            success: '#10b981'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>
<body class="bg-estate-bg text-slate-50 font-sans antialiased">
    <?php require APP_PATH . '/views/layouts/navbar.php'; ?>
    <main>
        <?php require $viewPath; ?>
    </main>
    <?php require APP_PATH . '/views/layouts/footer.php'; ?>
    <?php require APP_PATH . '/views/layouts/mobile-app-nav.php'; ?>
    <?php require APP_PATH . '/views/layouts/pwa-bar.php'; ?>

    <script src="https://unpkg.com/lucide@latest" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
    <script>
        window.MEMON_ESTATE_BASE = '<?= e(url('/')) ?>';
    </script>
    <script src="<?= asset('js/app.js') ?>" defer></script>
</body>
</html>
