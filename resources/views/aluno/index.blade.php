@extends('_layouts.master')

@section('body')
  <div x-data="{ showProgressModal: false }">
    <!-- Cards -->
    <div class="mt-4">
      <div class="-mx-6 flex flex-wrap">
        <div class="mt-0 w-full px-6 sm:w-1/2 md:mt-8 xl:mt-6 xl:w-1/4">
          <x-master::card iconBg="bg-red-600 bg-opacity-75" titulo="{{ $aluno->nome_completo }}" subtitulo="Aluno(a)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
              <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
            </svg>
          </x-master::card>
        </div>

        <div class="mt-8 w-full px-6 sm:w-1/2 xl:mt-6 xl:w-1/4">
          <x-master::card iconBg="bg-green-600 bg-opacity-75" titulo="{{ $aluno->turma->codigo ?? 'Não designado' }}"
            subtitulo="Turma{{ $aluno->curso ? ' - ' . $aluno->curso : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
              <path
                d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
              <path
                d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
            </svg>
          </x-master::card>
        </div>

        <div class="mt-8 w-full px-6 sm:w-1/2 xl:mt-6 xl:w-1/4">
          <x-master::card iconBg="bg-fuchsia-600 bg-opacity-75" titulo="{{ count($aluno->certificados()->get()) }}"
            subtitulo="Certificados Enviados">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
              <path
                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
            </svg>
          </x-master::card>
        </div>

        <div class="mt-8 w-full px-6 sm:w-1/2 xl:mt-6 xl:w-1/4">
          <x-master::card iconBg="bg-pink-600 bg-opacity-75" titulo="{{ $aluno->professor ?? 'Não designado' }}"
            subtitulo="Professor(a) Responsável">
            <svg class="h-8 w-8 text-white" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            </svg>
          </x-master::card>
        </div>
      </div>
    </div>
    <!-- Fim dos cards -->

    <!-- Seção de Progresso -->
    <div class="my-5 mb-1 flex items-center justify-between gap-4">
      <div class="flex-1">
        <div class="mb-1 flex justify-between">
          <span class="text-sm font-medium text-gray-600">Progresso</span>
          <span class="text-sm text-gray-600">
            {{ $cargaHorariaTotal }}h de {{ $maxCargaHoraria }}h
            ({{ round(min(($cargaHorariaTotal / $maxCargaHoraria) * 100, 100)) }}%)
          </span>
        </div>
        <div class="h-2.5 w-full rounded-full bg-gray-500">
          <div class="h-2.5 rounded-full bg-green-500 transition-all duration-300"
            style="width: {{ min(($cargaHorariaTotal / $maxCargaHoraria) * 100, 100) }}%">
          </div>
        </div>
      </div>

      <!-- Botão do Modal -->
      <button @click="showProgressModal = true"
        class="flex items-center gap-2 rounded-full bg-green-500 px-4 py-2 text-white transition-colors hover:bg-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Detalhes
      </button>
    </div>

    <!-- Modal de progresso -->
    <x-aluno::modal-progresso :aluno="$aluno" />

    <!-- Certificados -->
    <div class="mt-8 flex flex-col rounded-3xl bg-zinc-200 shadow-2xl">
      <h1 class="font-regular my-2 px-5 py-2 text-3xl text-gray-700">Ultimos Certificados Enviados</h1>
      <div class="-mt-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <x-aluno::certificados-table :certificados="$certificados" :colunas="['categoria', 'data_enviada', 'status']" />
      </div>
    </div>
    <!-- Fim dos certificados -->

  </div>
@endsection
