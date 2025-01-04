<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'SISGED')</title>
    <!-- Pode incluir seus arquivos CSS aqui -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @stack('css') <!-- Inclui arquivos CSS adicionais -->

    @vite('resources/css/default.scss')
</head>

<body>
    <!-- Componente Header -->
    @unless (isset($noHeader) && $noHeader)
        @include('componentes.header')
    @endunless

    <main>
        @yield('main')
    </main>

    <footer id="rodape">
        <div class="row">
            <div class="col-12">
                <p></p>
            </div>
        </div>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
