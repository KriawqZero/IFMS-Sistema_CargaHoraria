@extends('_layouts.master')

@section('body')
    <div class="sm:max-w-none w-full max-w-full p-9 bg-white rounded-3xl z-10">
        <div>
            <h3 class="mt-5 text-3xl font-bold text-gray-900">
                Enviar Certificado!
                </h2>
                <p class="mt-2 text-sm text-gray-400">Aqui você pode enviar seu arquivo para validação de carga horária.</p>
        </div>
        <form class="mt-8 space-y-3" action="#" method="POST">
        <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Tipo</label>
                <select class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" name="tipo">
                    <option value="" disabled selected>Selecione uma opção</option>
                    <option value="optativas">Unidades curriculares optativa/eletivas</option>
                    <option value="projetos">Projetos de ensino, pesquisa e extensão</option>
                    <option value="pratica-integradora">Prática Profissional Integradora</option>
                    <option value="desportivas">Práticas Desportivas</option>
                    <option value="artistico-culturais">Práticas Artístico-Culturais</option>
                </select>
            </div>
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Observação</label>
                <textarea class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
            </div>
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Anexar documento</label>
                @livewire('enviar-arquivo')
            </div>
            <p class="text-sm text-gray-400">
                <span>Arquivos permitidos: .jpg, .png, .webp, .pdf</span>
            </p>
            <div>
                <button type="submit"
                    class="my-5 w-full flex justify-center bg-green-600 text-white p-4  rounded-full tracking-wide
                            font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                    Enviar
                </button>
            </div>
        </form>
    </div>
@endsection
