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
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=20260510-3">
</head>
<body class="bg-estate-bg text-slate-50 font-sans antialiased">
    <?php require APP_PATH . '/views/layouts/navbar.php'; ?>
    <main>
        <?php require $viewPath; ?>
    </main>
    <?php require APP_PATH . '/views/layouts/footer.php'; ?>
    <?php require APP_PATH . '/views/layouts/mobile-app-nav.php'; ?>
    <?php require APP_PATH . '/views/layouts/pwa-bar.php'; ?>

    <script>
        window.MEMON_ESTATE_BASE = '<?= e(url('/')) ?>';
    </script>
    <script src="<?= asset('js/app.js') ?>?v=20260510-3" defer></script>
</body>
</html>
