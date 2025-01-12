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
  @vite('resources/scss/main.scss')
  @vite('resources/js/main.js')
</head>

<body>
  <div style="background-color: #CCE6D8;" class="flex h-screen items-center justify-center px-6">
    <div class="relative flex h-96 w-3/4 max-w-4xl overflow-hidden rounded-lg bg-white shadow-lg">
      <!-- Área grande à esquerda -->
      <div class="z-10 -mr-6 hidden flex-1 rounded-[30px] bg-gray-600 shadow-lg md:block">
        <div class="flex justify-center items-center">
          <img class="object-cover mt-12 h-24 m-7" src="{{ asset('images/SISCO.png') }}" />
        </div>
      </div>
      <!-- Área de caixas à direita -->
      <div class="z-0 flex w-full flex-col justify-between rounded-3xl bg-white p-12 shadow-2xl md:w-1/3">
        <h2>Login</h2>
        @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ $errors->first() }}</span>
          </div>
        @endif
        <form class="mt-4" action="{{ route('aluno.login.post') }}" method="POST">
          @csrf
          <label class="block">
            <span class="ml-1 text-sm text-gray-700">CPF</span>
            <input name="cpf" type="text" placeholder="012.345.678-90"
              class="mt-1 block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2 focus:border-green-500" />
          </label>

          <label class="mt-3 block">
            <span class="ml-1 text-sm text-gray-700">Senha</span>
            <input name="senha" type="password" placeholder="********"
              class="block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2 focus:border-green-800" />
          </label>

          <div class="mt-4 flex items-center justify-between">
            <div>
              <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-indigo-600" />
                <span class="mx-2 text-sm text-gray-600">Lembrar de mim</span>
              </label>
            </div>
          </div>

          <div class="mt-6">
            <button type="submit"
              class="w-full rounded-md bg-green-600 px-4 py-2 text-center text-sm text-white hover:bg-green-700">Entrar</button>
          </div>

          <div class="mt-2 flex justify-center">
            <a href="{{ route('professor.login') }}"
              class="font-small text-blue-600 underline transition duration-300 hover:text-blue-800"> Login Como
              Professor </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
