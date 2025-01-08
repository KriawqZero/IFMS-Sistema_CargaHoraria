<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="#">

    <meta name="description">

    <title>Login</title>

    @vite('resources/css/app.css')
    @vite('resources/scss/main.scss')
    @vite('resources/js/main.js')
</head>

<body>
    <div style="background-color: var(--colorWeak);" class="flex justify-center items-center h-screen px-6">
        <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
            <div class="flex justify-center items-center">
                <img src="{{ asset('images/ifmslogo.png') }}" />
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4"
                    role="alert">
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            @endif

            <form class="mt-4" action="{{ route('aluno.login.post') }}" method="POST">
                @csrf
                <label class="block">
                    <span class="text-gray-700 text-sm">CPF</span>
                    <input name="cpf" type="text"
                        class="form-input mt-1 block w-full rounded-md focus:border-green-300">
                </label>

                <label class="block mt-3">
                    <span class="text-gray-700 text-sm">Senha</span>
                    <input name="senha" type="password"
                        class="form-input mt-1 block w-full rounded-md focus:border-green-300">
                </label>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-indigo-600">
                            <span class="mx-2 text-gray-600 text-sm">Lembrar de mim</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="py-2 px-4 text-center bg-green-600 rounded-md w-full text-white text-sm hover:bg-green-700">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
