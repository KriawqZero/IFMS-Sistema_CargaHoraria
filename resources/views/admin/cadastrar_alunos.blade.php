@extends('_layouts.master')

@section('body')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
    <h1 class="text-2xl font-bold mb-6">Cadastrar alunos em massa</h1>

    <!---->
    <!--@if ($errors->any())-->
    <!--    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">-->
    <!--        <ul class="list-disc pl-5">-->
    <!--            @foreach ($errors->all() as $error)-->
    <!--                <li>{{ $error }}</li>-->
    <!--            @endforeach-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--@endif-->
    <!---->
    <!--@if (session('success'))-->
    <!--    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">-->
    <!--        {{ session('success') }}-->
    <!--    </div>-->
    <!--@endif-->
    <!---->

    <form action="{{ route('admin.create.alunos.post') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="csv_text" class="block text-gray-700 font-medium mb-2">Conteúdo CSV</label>
            <textarea id="csv_text" name="csv_text" rows="10" class="w-full border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Exemplo: 123.456.789-00,2000-01-01\n987.654.321-00,1998-02-15"></textarea>
        </div>

        <div>
            <label for="turma" class="block text-gray-700 font-medium mb-2">Nome da Turma</label>
            <input id="turma" name="turma" type="text" class="w-full border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Digite o nome da turma">
        </div>

        <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg
            hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Cadastrar Alunos</button>
    </form>
</div>
@endsection
