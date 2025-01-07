<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') - SISGED</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    @vite('resources/scss/app.scss')
    @vite('resources/scss/login.scss')

</head>
<body>
    @include('componentes.login.header')

    <main class="d-flex flex-column min-vh-100">
        @yield('main')
    </main>

    @include('componentes.login.footer')

    @vite('resources/js/app.js')

    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
