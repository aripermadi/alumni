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
        if (event.request.destination === 'image') {
          // fallback ke gambar lokal
          return caches.match('/images/placeholder-profile.png');
        }
        // fallback ke response kosong (atau bisa custom response)
        return new Response('', { status: 404, statusText: 'Not Found' });
      });
    })
  );
}); 