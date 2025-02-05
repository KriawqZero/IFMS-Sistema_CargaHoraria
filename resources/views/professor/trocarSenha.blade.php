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
      <div class="w-full max-w-sm rounded-[50px] bg-white p-8 shadow-2xl">
        <div class="flex items-center justify-center">
          <img class="m-7 h-24 object-cover" src="{{ asset('images/SISCO.png') }}" />
        </div>

        @if ($errors->any())
          <div class="relative mt-4 rounded-xl border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert">
            <span class="block sm:inline">{{ $errors->first() }}</span>
          </div>
        @endif

        <h1 class="text-center text-2xl font-semibold text-gray-700">Trocar Senha</h1>
        <p class="mt-2 text-left text-gray-500">Ao acessar o sistema pela primeira vez você tem que digitar
          uma senha para uso.</p>

        <form class="mt-4" action="{{ route('professor.trocarSenha') }}" method="POST">
          @csrf
          <label class="block">
            <span class="ml-1 text-sm text-gray-700">Nova Senha</span>
            <input name="nova_senha" type="password" placeholder="********"
              class="mt-1 block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2 focus:border-green-500"
              id="nova_senha">
          </label>

          <label class="mt-3 block">
            <span class="ml-1 text-sm text-gray-700">Confirmar Senha</span>
            <input name="nova_senha_confirmation" type="password" placeholder="********"
              class="block w-full rounded-2xl border border-zinc-300 bg-gray-100 p-2 focus:border-green-800"
              id="confirmar_senha">
          </label>

          <div class="mt-6">
            <button type="submit"
              class="text-md w-full rounded-md bg-green-600 px-4 py-2 text-center text-white hover:bg-green-700">
              Atualizar Senha
            </button>
          </div>

          <div class="mt-3 flex items-center justify-center text-sm">
            <a href="{{ route('professor.logout') }}"
              class="font-medium text-blue-600 underline transition duration-300 hover:text-blue-800">
              Sair
            </a>
          </div>

        </form>

      </div>
    </div>

    <script>
      // Função de verificação da senha
      const novaSenhaInput = document.getElementById("nova_senha");
      const confirmarSenhaInput = document.getElementById("confirmar_senha");

      confirmarSenhaInput.addEventListener('input', () => {
        if (novaSenhaInput.value !== confirmarSenhaInput.value) {
          confirmarSenhaInput.setCustomValidity("As senhas não coincidem.");
        } else {
          confirmarSenhaInput.setCustomValidity("");
        }
      });
    </script>

  </body>

</html>
