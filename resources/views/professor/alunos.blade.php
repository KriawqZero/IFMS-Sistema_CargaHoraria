@extends('_layouts.master')

@section('body')
<div>
    <div class="p-4 rounded-lg text-center bg-green-600 shadow-md">
        <h1 class="text-xl font-semibold text-white">{{ $titulo }}</h1>
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
            <!-- Tabela de Certificados -->
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-2">Nome</th>
                        <th class="border-b border-gray-300 px-4 py-2">Turma</th>
                        <th class="border-b border-gray-300 px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dados simulados -->
                    @forelse($alunos as $aluno)
                    <tr>
                        <td class="border-b border-gray-200 px-4 py-2">{{$aluno->nome}}</td>
                        <td class="border-b border-gray-200 px-4 py-2">{{$aluno->turma->codigo}}</td>
                        <td class="border-b border-gray-200 px-4 py-2"><a href="#" class="text-green-600 hover:underline" target="_blank">Ver detalhes</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border-b border-gray-200 px-4 py-2 text-center" colspan="3">Nenhum aluno encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
