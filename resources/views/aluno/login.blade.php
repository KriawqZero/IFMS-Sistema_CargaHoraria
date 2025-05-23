<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="Login de Alunos - Sistema de Certificados IFMS Corumbá">
    <meta property="og:description" content="Acesso ao sistema de emissão e gestão de certificados digitais para alunos do IFMS Campus Corumbá">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta name="description" content="Acesso seguro ao sistema de certificados do IFMS Campus Corumbá. Alunos, realize login com seu CPF e senha para gerenciar seus certificados digitais.">

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

    <div class="fixed bottom-8 left-0 right-0 flex justify-center">
      <a href="{{ route('ajuda') }}"
         class="flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-medium text-green-600 shadow-lg transition-all hover:bg-green-50 hover:shadow-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
        Não consegue logar?
      </a>
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
