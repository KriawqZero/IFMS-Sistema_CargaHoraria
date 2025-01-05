<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>

    @vite('resources/scss/app.scss')

    @stack("styles")
</head>
<body>
    @include('componentes.login.header')

    <main>
        @yield('main')
    </main>

    @include('componentes.login.footer')

    @vite('resources/js/app.js')
</body>
</html>
