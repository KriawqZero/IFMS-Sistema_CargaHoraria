@extends('_layouts.master')

@section('body')
  <div class="lg:pb-12 lg:pl-12 lg:pr-12">
    <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900">
          Editar '{{ $curso->nome }}'
        </h3>
      </div>

      @if ($errors->any())
        <div class="mt-5 rounded-lg bg-red-100 p-4">
          <ul>
            @foreach ($errors->all() as $error)
              <li class="text-red-500">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @elseif(session('success'))
        <div class="mt-5 rounded-lg bg-green-100 p-4">
          <ul>
            <li class="text-green">{{ session('success') }}</li>
          </ul>
        </div>
      @endif

      <form enctype="multipart/form-data" class="mt-8 space-y-3"
        action="{{ route('professor.cursos.update', ['id' => $curso->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 space-y-2" x-data="{ data: { nome: '{{ $curso->nome }}', sigla: '{{ $curso->sigla }}' } }">
          <div class="flex items-center" x-data="{ isNomeEditable: false }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Nome</label>
              <input type="text" id="titulo" name="nome"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                x-model="data.nome" :disabled="!isNomeEditable">
              <input type="hidden" name="nome" x-model="data.nome">
            </div>
            <button type="button" @click="isNomeEditable= !isNomeEditable"
              class="ml-4 text-green-500 hover:text-green-700">
              <span x-text="isNomeEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <div class="flex items-center" x-data="{ isSiglaEditable: false }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Sigla</label>
              <input type="text" id="sigla" name="sigla"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                x-model="data.sigla" :disabled="!isSiglaEditable">
              <input type="hidden" name="sigla" x-model="data.sigla">
            </div>
            <button type="button" @click="isSiglaEditable= !isSiglaEditable"
              class="ml-4 text-green-500 hover:text-green-700">
              <span x-text="isSiglaEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>
        </div>

        <div class="flex">
          <button type="submit"
            class="focus:shadow-outline mx-2 my-5 flex w-3/4 cursor-pointer justify-center rounded-full bg-green-600 p-4 font-semibold tracking-wide text-white shadow-lg transition duration-300 ease-in hover:bg-green-700 focus:outline-none">
            Enviar
          </button>
          <a href="{{ route('professor.cursos.index') }}"
            class="focus:shadow-outline mx-2 my-5 flex w-1/4 cursor-pointer justify-center rounded-full bg-red-600 p-4 font-semibold tracking-wide text-white shadow-lg transition duration-300 ease-in hover:bg-red-700 focus:outline-none">
            Cancelar
          </a>
        </div>
      </form>

    </div>
  </div>
@endsection
