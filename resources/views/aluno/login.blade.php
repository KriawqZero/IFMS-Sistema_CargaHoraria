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
    <div style="background-color: #CCE6D8;" class="flex h-screen items-center justify-center px-6">
      <div class="w-full max-w-sm rounded-[50px] bg-white p-8 shadow-2xl">
        <div class="flex items-center justify-center">
          <img class="m-7 h-24 object-cover" src="{{ asset('images/SISCO.png') }}" />
        </div>

        <h1 class="text-center text-2xl font-semibold text-gray-700">Login</h1>

        @if ($errors->any())
          <div class="relative mt-4 rounded-xl border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert">
            <span class="block sm:inline">{{ $errors->first() }}</span>
          </div>
        @endif

        <form class="mt-4" action="{{ route('aluno.login.post') }}" method="POST">
          @csrf
          <label class="block">
            <span class="ml-1 text-sm text-gray-700">CPF</span>
            <input name="cpf" type="text" placeholder="012.345.678-90"
              class="mt-1 block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2 focus:border-green-500"
              maxlength="14" id="cpf_form">
          </label>

          <label class="mt-3 block" x-data="{ formattedDate: '' }">
            <span class="ml-1 text-sm text-gray-700">Senha</span>
            <input name="senha" type="password" placeholder="********"
              class="block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2 focus:border-green-800"
              id="senha_form">
          </label>

          <!--<div class="mt-4 flex items-center justify-between">-->
          <!--  <div>-->
          <!--    <label class="inline-flex items-center">-->
          <!--      <input type="checkbox" class="form-checkbox text-indigo-600">-->
          <!--      <span class="mx-2 text-sm text-gray-600">Lembrar de mim</span>-->
          <!--    </label>-->
          <!--  </div>-->
          <!--</div>-->

          <div class="mt-6">
            <button type="submit"
              class="w-full rounded-md bg-green-600 px-4 py-2 text-center text-sm text-white hover:bg-green-700">
              Entrar
            </button>
          </div>

          <div class="mt-2 flex justify-center">
            <a href="{{ route('professor.login') }}"
              class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
              Acesso Administrativo
            </a>
          </div>
        </form>

      </div>
    </div>

    <script>
      const input = document.getElementById("cpf_form");
      input.addEventListener('input', () => {
        let inputlength = input.value.length;

        if (inputlength === 3 || inputlength === 7) {
          input.value += '.';
        }

        if (inputlength === 11) {
          input.value += '-';
        }
      });

      //const input_nasc = document.getElementById('data_nasc_form');
      //input_nasc.addEventListener('input', () => {
      //  let inputlength_nasc = input_nasc.value.length;
      //
      //  // Adiciona barra após 2 e 5 caracteres na data
      //  if (inputlength_nasc === 2 || inputlength_nasc === 5) {
      //    input_nasc.value += '/';
      //  }
      //});
    </script>

  </body>

</html>
