@extends('_layouts.master')

@section('body')
  <div class="mt-4">
    <!-- Card do Professor -->
    <div class="-mx-6 flex flex-wrap">
      <div class="mt-0 w-full px-6 sm:w-1/2 md:mt-8 xl:mt-6 xl:w-1/3">
        <x-master::card iconBg="bg-red-600 bg-opacity-75" titulo="{{ $professor->nome_completo }}" subtitulo="Professor(a)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
            <path
              d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
          </svg>
        </x-master::card>
      </div>
      <div class="mt-0 w-full px-6 sm:w-1/2 md:mt-8 xl:mt-6 xl:w-1/3">
        <x-master::card iconBg="bg-red-600 bg-opacity-75" titulo="{{ $professor->certificadosPendentes() }}"
          subtitulo="Certificados Pendentes">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
            <path
              d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
          </svg>
        </x-master::card>
      </div>
      <div class="mt-0 w-full px-6 sm:w-1/2 md:mt-8 xl:mt-6 xl:w-1/3">
        <x-master::card iconBg="bg-indigo-400 bg-opacity-75" titulo="{{ $professor->cargo_enum }}" subtitulo="Cargo">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
            <path
              d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5" />
            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z" />
          </svg>
        </x-master::card>
      </div>
    </div>

    <!-- Cards das Turmas -->
    <div class="mt-8">
      <div class="rounded-2xl bg-white p-8 shadow-lg">
        <h3 class="mb-6 text-center text-3xl font-bold text-gray-800">Turmas Designadas</h3>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          @foreach ($turmas as $turma)
            <!-- Turma 2 -->
            <a href="{{ route('professor.alunos.index', ['turma' => $turma->codigo]) }}"
              style="background-color: #CCE6D8;"
              class="flex transform items-center rounded-xl p-5 shadow-md transition-transform hover:scale-105">
              <div class="mr-5 flex h-14 w-14 items-center justify-center rounded-full bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-700" fill="currentColor"
                  viewBox="0 0 16 16">
                  <path d="M4 4h8v1H4V4zm0 3h8v1H4V7zm0 3h8v1H4v-1zm0 3h8v1H4v-1z" />
                </svg>
              </div>
              <span class="text-xl font-semibold text-gray-900">Turma {{ $turma->codigo }}</span>
            </a>
          @endforeach
        </div>
      </div>

      <!-- Certificados -->
      <div class="mt-8 flex flex-col rounded-3xl bg-zinc-200 shadow-2xl">
        <h1 class="font-regular my-2 px-5 py-2 text-3xl text-gray-700">Ultimos Certificados Recebidos</h1>
        <div class="-mt-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
          <x-aluno::certificados-table :certificados="$certificados->items()" :colunas="['aluno', 'categoria', 'data_enviada', 'status']" />
        </div>
      </div>
      <!-- Fim dos certificados -->

    </div>
  </div>
@endsection
