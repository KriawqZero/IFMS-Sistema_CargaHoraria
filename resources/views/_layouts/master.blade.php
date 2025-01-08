<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="{{ $titulo }}">

    <title>{{ $titulo }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/main.js')

    @vite('resources/scss/main.scss')
</head>

<body>
    <div x-data="{ sidebarOpen: false }" style="background-color: var(--colorMdWeak);" class="flex h-screen font-roboto">
        @include('_layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('_layouts.header')

            <main style="" class="flex-1 bg-zinc-100 overflow-x-hidden overflow-y-auto">
                <div class="container mx-auto px-6 py-8">
                    @yield('body')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
