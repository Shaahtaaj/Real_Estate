document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) {
        window.lucide.createIcons();
    }

    if (window.AOS) {
        AOS.init({ duration: 700, easing: 'ease-out-cubic', once: true, offset: 80 });
    }

    if (window.gsap) {
        gsap.from('[data-hero-reveal]', {
            y: 28,
            opacity: 0,
            duration: 0.9,
            stagger: 0.09,
            ease: 'power3.out'
        });
    }

    const toggle = document.querySelector('[data-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    toggle?.addEventListener('click', () => mobileMenu?.classList.toggle('hidden'));

    document.querySelectorAll('[data-drop-zone]').forEach((zone) => {
        const input = zone.querySelector('[data-file-input]');
        const summary = zone.querySelector('[data-file-summary]');
        const updateSummary = () => {
            const count = input.files?.length || 0;
            summary.textContent = count ? `${count} image file(s) selected` : 'No files selected yet';
        };

        input?.addEventListener('change', updateSummary);
        zone.addEventListener('dragover', (event) => {
            event.preventDefault();
            zone.classList.add('border-blue-400', 'bg-blue-500/10');
        });
        zone.addEventListener('dragleave', () => {
            zone.classList.remove('border-blue-400', 'bg-blue-500/10');
        });
        zone.addEventListener('drop', (event) => {
            event.preventDefault();
            zone.classList.remove('border-blue-400', 'bg-blue-500/10');
            if (input && event.dataTransfer?.files?.length) {
                input.files = event.dataTransfer.files;
                updateSummary();
            }
        });
    });

    document.querySelectorAll('[data-fill-login]').forEach((button) => {
        button.addEventListener('click', () => {
            const form = button.closest('form');
            form.querySelector('[name="email"]').value = button.dataset.email;
            form.querySelector('[name="password"]').value = button.dataset.password;
        });
    });

    const mapEl = document.getElementById('property-map');
    if (mapEl && window.L) {
        const map = L.map(mapEl, { scrollWheelZoom: false }).setView([24.8607, 67.0011], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);
        L.marker([24.8607, 67.0011]).addTo(map).bindPopup('Memon Estate property area');
    }

    const chartEl = document.getElementById('adminChart');
    if (chartEl && window.Chart) {
        new Chart(chartEl, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Inquiries',
                    data: [18, 26, 31, 44, 58, 73],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.18)',
                    fill: true,
                    tension: 0.42
                }]
            },
            options: {
                plugins: { legend: { labels: { color: '#cbd5e1' } } },
                scales: {
                    x: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,.12)' } },
                    y: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,.12)' } }
                }
            }
        });
    }

    let deferredInstallPrompt = null;
    const installBars = document.querySelectorAll('[data-pwa-install]');
    const installButtons = document.querySelectorAll('[data-pwa-install-button]');
    const dismissButtons = document.querySelectorAll('[data-pwa-dismiss]');

    const showInstall = () => installBars.forEach((bar) => bar.classList.remove('hidden'));
    const hideInstall = () => installBars.forEach((bar) => bar.classList.add('hidden'));

    window.addEventListener('beforeinstallprompt', (event) => {
        event.preventDefault();
        deferredInstallPrompt = event;
        if (localStorage.getItem('memon-pwa-dismissed') !== '1') {
            showInstall();
        }
    });

    installButtons.forEach((button) => {
        button.addEventListener('click', async () => {
            if (!deferredInstallPrompt) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Install from browser menu',
                        text: 'Use Add to Home screen or Install app from your browser menu.',
                        background: '#111827',
                        color: '#f8fafc'
                    });
                }
                return;
            }

            deferredInstallPrompt.prompt();
            await deferredInstallPrompt.userChoice;
            deferredInstallPrompt = null;
            hideInstall();
        });
    });

    dismissButtons.forEach((button) => {
        button.addEventListener('click', () => {
            localStorage.setItem('memon-pwa-dismissed', '1');
            hideInstall();
        });
    });

    window.addEventListener('appinstalled', hideInstall);

    if ('serviceWorker' in navigator) {
        const base = (window.MEMON_ESTATE_BASE || '/').replace(/\/$/, '');
        navigator.serviceWorker.register(`${base}/sw.js`, { scope: `${base}/` })
            .then((registration) => registration.update())
            .catch(() => {});
    }
});
