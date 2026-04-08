const CACHE_NAME = 'krc-v4'; // Increment version to force update
const ASSETS = [
  './',
  'login.php',
  'index.php',        // Added index.php so the dashboard is cached too
  'manifest.json',
  'icon-512.png',
  'header.png',       // Added your assets for the report
  'footer.png'
];

// 1. Install Phase
self.addEventListener('install', (e) => {
  e.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('SW: Precise Caching Initiated');
      return Promise.all(
        ASSETS.map(url => {
          return cache.add(url).catch(err => console.warn(`SW: Static asset skip: ${url}`));
        })
      );
    })
  );
  self.skipWaiting();
});

// 2. Activate Phase: Cleanup
self.addEventListener('activate', (e) => {
  e.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            console.log('SW: Removing outdated cache:', cache);
            return caches.delete(cache);
          }
        })
      );
    })
  );
  return self.clients.claim(); // Immediately take control of all open tabs
});

// 3. Fetch Phase: Strategy - Network First for PHP, Cache First for Images
self.addEventListener('fetch', (e) => {
  const url = new URL(e.request.url);

  // If it's a PHP file, try network first so data stays fresh
  if (url.pathname.endsWith('.php') || url.pathname === '/') {
    e.respondWith(
      fetch(e.request).catch(() => caches.match(e.request))
    );
  } else {
    // For images and manifest, use Cache First
    e.respondWith(
      caches.match(e.request).then((res) => {
        return res || fetch(e.request);
      })
    );
  }
});