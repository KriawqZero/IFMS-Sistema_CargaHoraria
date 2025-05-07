<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="always">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="Ajuda - Sistema de Certificados IFMS Corumbá">
    <meta property="og:description" content="Informações de ajuda para acesso ao sistema de certificados do IFMS Campus Corumbá">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta name="description" content="Ajuda e suporte para acesso ao sistema de certificados do IFMS Campus Corumbá">

    <title>{{ $titulo . ' - ' . env('APP_NAME') }}</title>

    @vite('resources/css/app.css')
    @vite('resources/css/main.css')
    @vite('resources/js/main.js')
</head>

<body>
    <div style="background-color: #CCE6D8;" class="min-h-screen py-12 px-6">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-[50px] bg-white p-8 shadow-2xl">
                <div class="flex items-center justify-center">
                    <img class="m-7 h-24 object-cover" src="{{ asset('images/SISCO.png') }}" />
                </div>

                <h1 class="text-center text-2xl font-semibold text-gray-700 mb-8">Ajuda para Login</h1>

                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Como fazer login?</h2>
                        <p class="text-gray-600 mb-4">Para acessar o sistema, você precisa usar:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>CPF como login (com pontos e traço)</li>
                            <li>Sua senha inicial é seu CPF (apenas números)</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Primeiro acesso?</h2>
                        <p class="text-gray-600 mb-4">Se é seu primeiro acesso:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Use seu CPF como login (com pontos e traço)</li>
                            <li>Use seu CPF como senha (apenas números)</li>
                            <li>Se seu CPF começar com zero, remova-o ao digitar a senha</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Não consegue acessar?</h2>
                        <p class="text-gray-600 mb-4">Se você não conseguir acessar o sistema:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Verifique se está digitando o CPF corretamente</li>
                            <li>Certifique-se de que a senha está correta</li>
                            <li>Se seu CPF começa com zero, tente remover o zero ao digitar a senha</li>
                            <li>Se ainda assim não conseguir, procure a CEREL para redefinição de senha</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 flex justify-center">
                    <a href="{{ route('aluno.login') }}" 
                       class="rounded-md bg-green-600 px-6 py-2 text-center text-sm text-white hover:bg-green-700">
                        Voltar para o Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 