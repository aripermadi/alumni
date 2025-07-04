<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNISMA Alumni Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0d6efd">
    <style>
        body {
            padding-bottom: 60px;
            background-color: #f8f9fa;
        }
        .content-wrapper {
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <x-nav-bar :active="$active ?? 'home'" />
    <div class="content-wrapper fade-in">
        @yield('content')
    </div>
    <x-bottom-nav :active="$active ?? 'home'" class="d-lg-none" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
          .then(function(registration) {
            console.log('Service Worker registered with scope:', registration.scope);
          }).catch(function(error) {
            console.log('Service Worker registration failed:', error);
          });
      }
    </script>
</body>
</html> 