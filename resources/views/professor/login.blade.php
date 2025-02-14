<!DOCTYPE html>
<html lang="pt_BR">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="#">

    <meta name="description">

    <title>{{ $titulo . ' - ' . env('APP_NAME') }}</title>

    @vite('resources/css/app.css')
    @vite('resources/css/main.css')
    @vite('resources/js/main.js')
  </head>

  <body>
    <div class="flex h-screen items-center justify-center bg-stone-400 px-6">
      <div class="w-full max-w-sm rounded-3xl bg-stone-200 p-8 shadow-md">
        <div class="flex items-center justify-center">
          <img class="m-7 h-24 object-cover" src="{{ asset('images/SISCO.png') }}" />
        </div>

        @if ($errors->any())
          <div class="relative mt-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert">
            <span class="block sm:inline">{{ $errors->first() }}</span>
          </div>
        @endif

        <form class="mt-4" action="{{ route('professor.login.post') }}" method="POST">
          @csrf
          <label class="block">
            <span class="ml-1 text-sm text-gray-700">Login (nome.sobrenome)</span>
            <input name="login" type="text" placeholder="012.345.678-90"
              class="mt-1 block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2">
          </label>

          <label class="mt-3 block">
            <span class="ml-1 text-sm text-gray-700">Senha</span>
            <input name="senha" type="password" placeholder="********"
              class="block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2">
          </label>

          <div class="mt-6">
            <button type="submit"
              class="w-full rounded-md bg-green-600 px-4 py-2 text-center text-sm text-white hover:bg-green-700">
              Entrar
            </button>
          </div>

          <div class="mt-4 flex justify-center">
            <a href="{{ route('aluno.login') }}"
              class="font-medium text-blue-600 hover:underline hover:text-blue-800">
              Login Como Aluno
            </a>
          </div>
        </form>
      </div>
    </div>
  </body>

</html>
