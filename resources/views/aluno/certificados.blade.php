@extends('_layouts.master')

@section('body')
  <div class="flex flex-col mt-8">
    <div class="-my-2 py-2 pb-12 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

      <div class="flex justify-end">
        <a href="{{ route('aluno.certificados.create') }}"
          class="shadow-xl mb-5 px-6 py-3 bg-green-600 rounded-3xl text-white font-medium tracking-wide hover:bg-green-700 ml-3 mr-8 ">
          Enviar Certificado</a>
      </div>

      <!-- Certificados Table -->
      <x-aluno::certificados-table :certificados="$certificados" />
    </div>
  </div>
@endsection
