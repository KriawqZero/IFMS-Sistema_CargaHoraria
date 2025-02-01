@extends('_layouts.master')

@section('body')
  <div class="w-full max-w-2xl rounded-lg bg-white p-8 shadow-md">
    <h1 class="mb-6 text-2xl font-bold">Cadastrar alunos em massa</h1>

    <!---->
    <!--@if ($errors->any())
  -->
    <!--    <div class="mb-4 rounded bg-red-100 p-4 text-red-700">-->
    <!--        <ul class="list-disc pl-5">-->
    <!--            @foreach ($errors->all() as $error)
  -->
    <!--                <li>{{ $error }}</li>-->
    <!--
  @endforeach-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--
  @endif-->
    <!---->
    <!--@if (session('success'))
  -->
    <!--    <div class="mb-4 rounded bg-green-100 p-4 text-green-700">-->
    <!--        {{ session('success') }}-->
    <!--    </div>-->
    <!--
  @endif-->
    <!---->

    <form action="{{ route('professor.create.alunos.post') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label for="csv_text" class="mb-2 block font-medium text-gray-700">Conteúdo CSV</label>
        <textarea id="csv_text" name="csv_text" rows="10"
          class="w-full rounded-lg border border-gray-300 p-4 focus:outline-none focus:ring-2 focus:ring-green-500"
          placeholder="Exemplo: 123.456.789-00,2000-01-01\n987.654.321-00,1998-02-15"></textarea>
      </div>

      <div>
        <label for="turma" class="mb-2 block font-medium text-gray-700">Nome da Turma</label>
        <input id="turma" name="turma" type="text"
          class="w-full rounded-lg border border-gray-300 p-4 focus:outline-none focus:ring-2 focus:ring-green-500"
          placeholder="Digite o nome da turma">
      </div>

      <button type="submit"
        class="w-full rounded-lg bg-green-500 py-3 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Cadastrar
        Alunos</button>
    </form>
  </div>
@endsection
