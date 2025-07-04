self.addEventListener('install', function(event) {
  console.log('Service Worker installing.');
  self.skipWaiting();
});

self.addEventListener('activate', function(event) {
  console.log('Service Worker activating.');
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request).catch(() => {
        // return fallback image jika request gambar gagal
        if (event.request.destination === 'image') {
          return caches.match('/images/placeholder-profile.png');
        }
      });
    })
  );
}); 