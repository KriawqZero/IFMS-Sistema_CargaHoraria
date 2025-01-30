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
  <div style="background-color: #CCE6D8;" class="flex justify-center items-center h-screen px-6">
    <div class="p-8 max-w-sm w-full bg-white shadow-2xl rounded-[50px]">
      <div class="flex justify-center items-center">
        <img class="object-cover h-24 m-7" src="{{ asset('images/SISCO.png') }}" />
      </div>

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mt-4" role="alert">
          <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
      @endif

      <form class="mt-4" action="{{ route('aluno.login.post') }}" method="POST">
        @csrf
        <label class="block">
          <span class="text-gray-700 text-sm ml-1">CPF</span>
          <input name="cpf" type="text" placeholder="012.345.678-90"
            class="bg-gray-100 p-2 border border-zinc-300 focus:border-green-500 mt-1 block w-full rounded-2xl"
            maxlength="14" id="cpf_form">
        </label>

        <label class="block mt-3" x-data="{ formattedDate: '' }">
          <span class="text-gray-700 text-sm ml-1">Senha</span>
          <input name="senha" type="password" placeholder="********"
            class="bg-gray-100 p-2 border border-zinc-300 focus:border-green-800 block w-full rounded-2xl"
            id="senha_form">
        </label>

        <!--<div class="flex justify-between items-center mt-4">-->
        <!--  <div>-->
        <!--    <label class="inline-flex items-center">-->
        <!--      <input type="checkbox" class="form-checkbox text-indigo-600">-->
        <!--      <span class="mx-2 text-gray-600 text-sm">Lembrar de mim</span>-->
        <!--    </label>-->
        <!--  </div>-->
        <!--</div>-->

        <div class="mt-6">
          <button type="submit"
            class="py-2 px-4 text-center bg-green-600 rounded-md w-full text-white text-sm hover:bg-green-700">
            Entrar
          </button>
        </div>

        <div class="flex justify-center mt-2">
          <a href="{{ route('professor.login') }}"
            class="text-blue-600 underline font-medium hover:text-blue-800 transition duration-300">
            Login Como Servidor
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
