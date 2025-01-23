@extends('_layouts.master')

@section('body')
<div class="bg-gray-100 min-h-screen rounded-md">
    <!-- Header -->
    <div class="p-4 bg-white shadow-md">
        <h1 class="text-xl font-semibold text-gray-800">Alunos</h1>
    </div>

    <div class="p-6">
        <!-- Filtro por Turma -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-medium text-gray-700 mb-4">Filtrar Alunos</h2>
            <form method="GET" action="{{ route('professor.alunos.index') }}">
                <div class="flex items-center gap-4">
                    <label for="turma" class="text-gray-600">Selecione a Turma:</label>
                    <select id="turma" name="turma" class="w-1/3 p-2 border border-gray-300 rounded-md">
                        <option value="todas" {{ request('turma') == 'todas' ? 'selected' : '' }}>Todas as Turmas</option>
                        @foreach($turmas as $turma)
                            <option value="{{ $turma->codigo }}" {{ request('turma') == $turma->codigo ? 'selected' : '' }}>
                                {{ $turma->codigo }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de Alunos -->
        <div class="bg-white p-4 rounded-md shadow-md">
            <h2 class="text-lg font-medium text-gray-700 mb-4">Alunos</h2>
            <table class="min-w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 text-left border border-gray-300">Nome</th>
                        <th class="p-3 text-left border border-gray-300">Turma</th>
                        <th class="p-3 text-left border border-gray-300">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alunos as $aluno)
                    <tr>
                        <td class="p-3 border border-gray-300">{{ $aluno->nome }}</td>
                        <td class="p-3 border border-gray-300">{{ $aluno->turma->codigo }}</td>
                        <td class="p-3 border border-gray-300">
                            <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
