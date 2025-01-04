i<!-- resources/views/layouts/login-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('headers.login-header')

    <main>
        @yield('main')
    </main>

    @include('footers.login-footer')
</body>
</html>
