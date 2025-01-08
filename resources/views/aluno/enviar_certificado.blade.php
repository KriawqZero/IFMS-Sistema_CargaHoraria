@extends('_layouts.master')

@section('body')
    
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Enviar Certificado</h2>

    <!-- Tipo de Atividade -->
    <div class="mb-4">
        <label for="tipoAtividade" class="block text-sm font-medium text-gray-700 mb-1">
            Tipo de Atividade <span class="text-red-500">*</span>
        </label>
        <select
            id="tipoAtividade"
            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500"
        >
            <option>Unidades curriculares optativas/eletivas</option>
            <option>Práticas artístico-culturais</option>
            <option>Projetos de ensino, pesquisa e extensão</option>
        </select>
    </div>

    <!-- Arquivo -->
    <div class="mb-4">
        <label for="arquivo" class="block text-sm font-medium text-gray-700 mb-1">
            Arquivo <span class="text-red-500">*</span>
        </label>
        <input
            type="file"
            id="arquivo"
            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500"
        />
    </div>

    <!-- Observação -->
    <div class="mb-4">
        <label for="observacao" class="block text-sm font-medium text-gray-700 mb-1">
            Observação
        </label>
        <textarea
            id="observacao"
            rows="4"
            placeholder="Hint text"
            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500"
        ></textarea>
    </div>

    <!-- Mensagem de status -->
    <div class="text-sm mb-4">
        <span class="text-green-600">Enviado com sucesso</span> - 
        <span class="text-red-600">Falha no envio</span>
    </div>

    <!-- Botão Enviar -->
    <div class="flex justify-end">
        <button
            class="px-6 py-3 bg-green-600 text-white font-medium rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
        >
            Enviar
        </button>
    </div>
</div>

@endsection
