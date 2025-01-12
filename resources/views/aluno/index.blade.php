@extends('_layouts.master')

@section('body')
  <div class="mt-4">
    <div class="flex flex-wrap -mx-6">
      <div class="w-full xl:mt-6 px-6 sm:w-1/2 xl:w-1/4 md:mt-8 mt-0">
        <x-master::card iconBg="bg-red-600 bg-opacity-75" titulo="{{ $aluno->nome_completo }}" subtitulo="Aluno(a)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
            <path
              d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
          </svg>
        </x-master::card>
      </div>

      <div class="w-full xl:mt-6 px-6 sm:w-1/2 xl:w-1/4 mt-8">
        <x-master::card iconBg="bg-green-600 bg-opacity-75" titulo="{{ $aluno->codigo_turma ?? 'Não designado' }}"
          subtitulo="Turma{{ $aluno->curso ? ' - ' . $aluno->curso : '' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
            <path
              d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
            <path
              d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
          </svg>
        </x-master::card>
      </div>

      <div class="w-full xl:mt-6 px-6 sm:w-1/2 xl:w-1/4 mt-8">
        <x-master::card iconBg="bg-fuchsia-600 bg-opacity-75" titulo="{{ count($certificados) }}"
          subtitulo="Certificados Enviados">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewBox="0 0 16 16">
            <path
              d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
          </svg>
        </x-master::card>
      </div>

      <div class="w-full xl:mt-6 px-6 sm:w-1/2 xl:w-1/4 mt-8">
        <x-master::card iconBg="bg-pink-600 bg-opacity-75" titulo="{{ $aluno->professor ?? 'Não designado' }}"
          subtitulo="Professor(a) Responsável">
          <svg class="h-8 w-8 text-white" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
          </svg>
        </x-master::card>
      </div>
    </div>
  </div>

  <div class="flex flex-col mt-8">
    <div class="-my-2 py-2 pb-12 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <x-aluno::certificados-table
        :certificados="$certificados"
        :colunas="['tipo', 'data_enviada', 'status' ]" />
    </div>
  </div>
@endsection
