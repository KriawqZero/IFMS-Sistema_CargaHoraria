@extends('_layouts.master')

@section('body')
<div class="p-2 lg:p-3 xl:p-5 text-sm lg:text-xl xl:text-3xl">
  <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-md">
    <div class="mb-3 border-b pb-4">
      <h1 class="text-3xl font-bold text-gray-800">Histórico de Atualizações</h1>
      <p class="text-gray-600 mt-2">Registro de todas as mudanças significativas no sistema</p>
    </div>

    <!-- Legenda -->
    <div class="mb-8 rounded-lg bg-gray-50 p-4">
      <h4 class="mb-3 text-sm font-semibold text-gray-700">Legenda:</h4>
      <div class="flex flex-wrap gap-4">
        <div class="flex items-center gap-2">
          <div class="h-3 w-3 rounded-full bg-green-600"></div>
          <span class="text-sm text-gray-600">Nova funcionalidade</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="h-3 w-3 rounded-full bg-blue-600"></div>
          <span class="text-sm text-gray-600">Melhoria</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="h-3 w-3 rounded-full bg-red-600"></div>
          <span class="text-sm text-gray-600">Correção crítica</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="h-3 w-3 rounded-full bg-yellow-600"></div>
          <span class="text-sm text-gray-600">Otimização</span>
        </div>
      </div>
    </div>

    <!--
      Nova funcionalidade
      <div class="h-2 w-2 mt-2 rounded-full bg-green-600"></div>

      Melhoria
      <div class="h-2 w-2 mt-2 rounded-full bg-blue-600"></div>

      Correção Crítica
      <div class="h-2 w-2 mt-2 rounded-full bg-red-600"></div>

      Otimização
      <div class="h-2 w-2 mt-2 rounded-full bg-yellow-600"></div>

      Funcionalidade Básica/Genérica
      <div class="h-2 w-2 mt-2 rounded-full bg-gray-400"></div>
    -->

    <!-- Versões -->
    <div class="space-y-8">
      @foreach(array_reverse($notas) as $nota)
      <div class="relative pl-6 border-l-4 border-gray-200">
        <!-- Bolinha da versão -->
        <div class="absolute -left-2.5 top-0 h-5 w-5 rounded-full
          {{ $nota['version'] === '1.0' ? 'bg-gray-300' : 'bg-green-600' }}"></div>

        <h3 class="text-xl font-semibold text-gray-800">
          V{{ $nota['version'] }} - {{ $nota['date'] }}
          <span class="text-sm text-gray-500 font-normal">por {{ $nota['author'] }}</span>
        </h3>

        <div class="mt-2 space-y-3 text-gray-700">
          @foreach($nota['changes'] as $change)
          <div class="flex items-start gap-2">
            <div class="h-2 w-2 mt-2 rounded-full
              @switch($change['type'])
                @case('feature') bg-green-600 @break
                @case('improvement') bg-blue-600 @break
                @case('critical') bg-red-600 @break
                @case('optimization') bg-yellow-600 @break
                @default bg-gray-400 @break
              @endswitch"></div>
            <p>{{ $change['description'] }}</p>
          </div>
          @endforeach
        </div>
      </div>
        @endforeach
    </div>
  </div>
</div>
@endsection
