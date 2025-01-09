<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="#">

    <meta name="description">

    <title>{{ $titulo . " - " . env("APP_NAME")}}</title>

    @vite('resources/css/app.css')
    @vite('resources/scss/main.scss')
    @vite('resources/js/main.js')
</head>

<body>
    <div style="background-color: var(--colorWeak);" class="flex justify-center items-center h-screen px-6">
        <div class="p-8 max-w-sm w-full bg-white shadow-md rounded-3xl">
            <div class="flex justify-center items-center">
                <img class="object-cover h-24 m-7" src="{{ asset('images/SISCO.png') }}" />
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
                    <span class="text-gray-700 text-sm ml-1">CPF</span>
                    <input name="cpf" type="text" placeholder="012.345.678-90"
                        class="bg-gray-100 p-2 border border-zinc-300 mt-1 block w-full rounded-2xl">
                </label>

                <label class="block mt-3">
                    <span class="text-gray-700 text-sm ml-1">Senha</span>
                    <input name="senha" type="password" placeholder="********"
                        class="bg-gray-100 p-2 border border-zinc-300 block w-full rounded-2xl">
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
