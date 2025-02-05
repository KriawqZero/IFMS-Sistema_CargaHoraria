<!DOCTYPE html>
<html lang="pt_BR">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="{{ $titulo }}">

    @php
      $notificacoes = $usuarioLogado->unreadNotifications->count();
      if ($notificacoes > 0) {
          $notificacoes = $notificacoes > 9 ? '9+' : $notificacoes;
          $notificacoes = '(' . $notificacoes . ') ';
      } else {
          $notificacoes = '';
      }
    @endphp
    <title>
      {{ $notificacoes . $titulo . ' - ' . env('APP_NAME') }}
    </title>

    @vite(['resources/css/main.css', 'resources/css/app.css'])
    @livewireStyles
  </head>

  <body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">
      @if (auth()->guard('professor')->check())
        @include('_layouts.sidebar_professor')
      @elseif(auth()->guard('aluno')->check())
        @include('_layouts.sidebar')
      @endif

      <div class="flex flex-1 flex-col overflow-hidden">
        @include('_layouts.header')

        <main style="" class="flex-1 overflow-y-auto overflow-x-hidden bg-zinc-300">
          @if ($errors->any())
            <x-alerts::erro-alert :erros="$errors->all()" timeout="10000" />
          @endif

          @if (session()->has('success'))
            <x-alerts::success-alert :mensagem="session('success')" timeout="10000" />
          @endif

          @if (session()->has('info'))
            <x-alerts::info-alert :mensagem="session('info')" timeout="10000" />
          @endif

          @if (session()->has('error'))
            <x-alerts::erro-alert :erros="[session('error')]" timeout="10000" />
          @endif

          <div class="container mx-auto px-6 py-8">
            @yield('body')
          </div>
        </main>
      </div>
    </div>

    @stack('scripts')
    @livewireScripts
  </body>

</html>
