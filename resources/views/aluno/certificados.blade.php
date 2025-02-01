@extends('_layouts.master')

@section('body')
  <div class="mt-8 flex flex-col">
    <div class="py-4 sm:px-6 lg:px-8">
      <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between md:space-y-0">
        <!-- Formulário de Busca e Seleção de Itens por Página -->
        <form method="GET" action="{{ route('aluno.certificados.index') }}"
          class="flex flex-col items-center space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
          <!-- Seleção de Itens por Página -->
          <div class="flex items-center space-x-2">
            <label for="per_page" class="text-sm font-medium text-gray-700">Itens por página:</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()"
              class="rounded-xl border border-gray-300 bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
              <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
              <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
              <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
              <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            </select>
          </div>
          <!-- Campo de Busca -->
          <input type="text" name="pesquisa" value="{{ request('pesquisa') }}" placeholder="Pesquisar por titulo"
            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 sm:w-auto" />

          <!-- Botão de Buscar -->
          <button type="submit"
            class="w-full rounded-xl bg-green-600 px-6 py-2 font-medium text-white transition hover:bg-green-700 sm:w-auto">
            Buscar
          </button>
        </form>

        <!-- Botão Enviar Certificado -->
        <a href="{{ route('aluno.certificados.create') }}"
          class="flex rounded-full px-5 py-2 text-center font-medium text-blue-600 visited:text-violet-600 visited:underline">
          <span class="col flex hover:underline"> Enviar Certificado </span>
          <svg class="col ml-2 flex h-6 w-6" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707" />
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
