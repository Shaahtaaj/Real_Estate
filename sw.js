const CACHE_NAME = 'memon-estate-app-v6';
const APP_SHELL = [
  './',
  'offline',
  'app/',
  'public/assets/css/app.css',
  'public/assets/js/app.js',
  'public/assets/images/logo-2.png',
  'public/assets/images/property-hero.svg',
  'public/assets/images/property-1.svg',
  'public/assets/images/property-2.svg',
  'public/assets/images/property-3.svg',
  'manifest.json'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => Promise.allSettled(APP_SHELL.map((url) => cache.add(url))))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys()
      .then((keys) => Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))))
      .then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') {
    return;
  }

  const request = event.request;
  const url = new URL(request.url);
  const privateRoute = /\/(admin|dashboard|login|logout|register|forgot-password)(\/|$)/.test(url.pathname);
  const acceptsHtml = request.headers.get('accept')?.includes('text/html');

  if (privateRoute) {
    event.respondWith(fetch(request));
    return;
  }

  if (acceptsHtml) {
    event.respondWith(
      fetch(request)
        .then((response) => {
          if (response.ok) {
            const copy = response.clone();
            caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
          }
          return response;
        })
        .catch(() => caches.match(request).then((cached) => cached || caches.match('offline')))
    );
    return;
  }

  event.respondWith(
    caches.match(request).then((cached) => {
      if (cached) {
        return cached;
      }

      return fetch(request).then((response) => {
        if (response.ok) {
          const copy = response.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
        }
        return response;
      });
    })
  );
});
