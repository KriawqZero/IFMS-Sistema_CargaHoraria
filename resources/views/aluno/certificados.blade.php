@extends('_layouts.master')

@section('body')
  <div class="mt-8 flex flex-col">
    <div class="mb-4 rounded-[30px] bg-white p-6 shadow-sm">
      <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <!-- Filtros Section -->
        <div class="flex flex-1 flex-col gap-4 sm:flex-row sm:items-center">
          <!-- Items per Page Selector -->
          <div class="relative flex items-center">
            <label for="per_page" class="sr-only">Itens por página</label>
            <div class="relative flex items-center">
              <select name="per_page" id="per_page" onchange="this.form.submit()"
                class="h-10 px-3 rounded-lg border border-gray-200 bg-white pl-3 pr-8 text-sm shadow-sm hover:border-green-500 focus:border-green-500 focus:ring-1 focus:ring-green-500">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5 itens</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 itens</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 itens</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 itens</option>
              </select>
              <div class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 transform">
              </div>
            </div>
          </div>

          <!-- Search Input -->
          <div class="flex flex-1 items-center rounded-lg border border-gray-200 bg-white shadow-sm focus-within:ring-1 focus-within:ring-green-500">
              <!-- Ícone da Lupa -->
              <div class="pointer-events-none flex items-center justify-center pl-3 text-gray-400">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
              </div>

              <!-- Input de Busca -->
              <input type="text" name="pesquisa" value="{{ request('pesquisa') }}" placeholder="Buscar certificados..."
                  class="h-10 w-full border-0 bg-transparent pl-3 pr-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-0 focus:ring-0" />
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
          <button type="submit"
            class="flex h-10 items-center justify-center gap-2 rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <span>Buscar</span>
          </button>

          <a href="{{ route('aluno.certificados.create') }}"
            class="flex h-10 items-center justify-center gap-2 rounded-lg bg-white px-5 py-2.5 text-sm font-medium text-green-600 shadow-sm ring-1 ring-inset ring-gray-300 transition-all hover:bg-gray-50 hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Novo Certificado</span>
          </a>
        </div>
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
