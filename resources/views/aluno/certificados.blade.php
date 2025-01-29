@extends('_layouts.master')

@section('body')
  <div class="flex flex-col mt-8">
    <div class="py-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
        <!-- Formulário de Busca e Seleção de Itens por Página -->
        <form method="GET" action="{{ route('aluno.certificados.index') }}" class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
          <!-- Seleção de Itens por Página -->
          <div class="flex items-center space-x-2">
            <label for="per_page" class="text-sm font-medium text-gray-700">Itens por página:</label>
            <select
              name="per_page"
              id="per_page"
              onchange="this.form.submit()"
              class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
            >
              <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
              <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
              <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
              <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            </select>
          </div>
          <!-- Campo de Busca -->
          <input
            type="text"
            name="pesquisa"
            value="{{ request('pesquisa') }}"
            placeholder="Pesquisar por titulo"
            class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
          />


          <!-- Botão de Buscar -->
          <button
            type="submit"
            class="w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded-md font-medium hover:bg-green-700 transition"
          >
            Buscar
          </button>
        </form>

        <!-- Botão Enviar Certificado -->
        <a
          href="{{ route('aluno.certificados.create') }}"
          class="px-5 text-center py-2 flex text-blue-600 visited:text-violet-600 visited:underline rounded-full font-medium"
        >
        <span class="hover:underline flex col"> Enviar Certificado </span>
          <svg class="w-6 ml-2 flex col h-6" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707"/>
          </svg>
        </a>
      </div>
    </div>


    <!-- Tabela de Certificados -->
    <x-aluno::certificados-table class="shadow-3xl" :certificados="$certificados->items()" />

    <!-- Links de Paginação -->
    <div class="mt-4">
      {{ $certificados->links() }}
    </div>
  </div>
@endsection
