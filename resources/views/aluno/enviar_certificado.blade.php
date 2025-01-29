@extends('_layouts.master')

@section('body')
  <div class="lg:pl-12 lg:pr-12 lg:pb-12">
    <div class="sm:max-w-none shadow-2xl w-full lg:max-w-full p-9 bg-white rounded-3xl z-10">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900">
          Enviar Certificado!
        </h3>
        <p class="mt-2 text-sm text-gray-400">Aqui você pode enviar seu arquivo para validação de carga horária.</p>
      </div>

      @if ($errors->any())
        <div class="mt-5 bg-red-100 p-4 rounded-lg">
          <ul>
            @foreach ($errors->all() as $error)
              <li class="text-red-500">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @elseif(session('success'))
        <div class="mt-5 bg-green-100 p-4 rounded-lg">
          <ul>
            <li class="text-green">{{ session('success') }}</li>
          </ul>
        </div>
      @endif

      <form enctype="multipart/form-data" class="mt-8 space-y-3" action="{{ route('aluno.certificados.store') }}"
        method="POST">
        @csrf

        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Categoria</label>

          <select name="categoria_id"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500" >
            <option value="" disabled selected>Selecione uma opção</option>
            @foreach ($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
            @endforeach
          </select>
        </div>

        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Titulo do Certificado</label>
          <input type="text" name="titulo"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
            placeholder="Oficina/Workshop - Brinquedos com materiais reciclados" />
          <label class="text-sm font-bold text-gray-500 tracking-wide">Carga Horária (em horas)</label>
          <input type="text" name="carga_horaria" placeholder="hh:mm (Ex: 12:30)" pattern="^\d{1,3}:[0-5]\d$"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Data do Certificado</label>
          <input x-data="{ today: new Date().toISOString().split('T')[0], selectedDate: '' }"
                type="date" name="data_do_certificado" min="2021-01-01" x-bind:max="today"
              class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500" />
          <label class="text-sm font-bold text-gray-500 tracking-wide">Observação</label>
          <textarea name="observacao"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500"></textarea>
        </div>
        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Anexar documento</label>
          <input type="file" name="arquivo"
            class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-green-600 file:py-2
                        file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-green-700 focus:outline-none
                        disabled:pointer-events-none disabled:opacity-60 file:transition file:ease-in file:duration-300" />
        </div>
        <p class="text-sm text-gray-400">
          <span>Arquivos permitidos: .jpg, .png, .webp, .pdf</span>
        </p>
        <div>


          <button type="submit"
            class="my-5 w-full flex justify-center bg-green-600 text-white p-4 rounded-full tracking-wide
            font-semibold focus:outline-none focus:shadow-outline hover:bg-green-700 shadow-lg cursor-pointer transition ease-in duration-300">
            Enviar
          </button>
        </div>
      </form>


    </div>
  </div>
@endsection
