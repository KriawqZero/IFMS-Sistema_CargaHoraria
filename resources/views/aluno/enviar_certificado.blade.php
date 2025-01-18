@extends('_layouts.master')

@section('body')
  <div class="pl-12 pr-12 pb-12">
    <div class="sm:max-w-none shadow-2xl w-full max-w-full p-9 bg-white rounded-3xl z-10">
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
          <label class="text-sm font-bold text-gray-500 tracking-wide">Tipo</label>

          <select name="tipo"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
            name="tipo">
            <option value="" disabled selected>Selecione uma opção</option>
            <option value="Unidades curriculares optativa/eletivas">Unidades curriculares optativa/eletivas
            </option>
            <option value="Projetos de ensino, pesquisa e extensão">Projetos de ensino, pesquisa e extensão
            </option>
            <option value="Prática Profissional Integradora<">Prática Profissional Integradora</option>
            <option value="Práticas Desportivas">Práticas Desportivas</option>
            <option value="Práticas Artístico-Culturais">Práticas Artístico-Culturais</option>
          </select>

        </div>
        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Observação</label>
          <textarea name="observacao"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500"></textarea>
          <label class="text-sm font-bold text-gray-500 tracking-wide">Carga Horária (em horas)</label>
          <input type="text" name="carga_horaria"
            class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
            placeholder="2,5"/>
          <label class="text-sm font-bold text-gray-500 tracking-wide">Data do Certificado</label>
          <input x-data="{ today: new Date().toISOString().split('T')[0], selectedDate: '' }"
                type="date" name="data_do_certificado" min="2021-01-01" x-bind:max="today"
              class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500" />
        </div>
        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Anexar documento</label>
          <input type="file" name="arquivo"
            class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-green-600 file:py-2
                        file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-green-700 focus:outline-none
                        disabled:pointer-events-none disabled:opacity-60" />
        </div>
        <p class="text-sm text-gray-400">
          <span>Arquivos permitidos: .jpg, .png, .webp, .pdf</span>
        </p>
        <div>


          <button type="submit"
            class="my-5 w-full flex justify-center bg-green-600 text-white p-4  rounded-full tracking-wide
                                font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
            Enviar
          </button>
        </div>
      </form>


    </div>
  </div>
@endsection
