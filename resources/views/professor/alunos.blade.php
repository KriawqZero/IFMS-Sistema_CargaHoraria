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
            <form>
                <div class="flex items-center gap-4">
                    <label for="turma" class="text-gray-600">Selecione a Turma:</label>
                    <select id="turma" name="turma" class="w-1/3 p-2 border border-gray-300 rounded-md">
                        <option value="todas">Todas as Turmas</option>
                        <option value="turma1">Turma 20210</option>
                        <option value="turma2">Turma 1079</option>
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
                    <tr>
                        <td class="p-3 border border-gray-300">João Silva</td>
                        <td class="p-3 border border-gray-300">Turma 20210</td>
                        <td class="p-3 border border-gray-300">
                            <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3 border border-gray-300">Rato Oliveira</td>
                        <td class="p-3 border border-gray-300">Turma 1079</td>
                        <td class="p-3 border border-gray-300">
                            <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3 border border-gray-300">Tiririca</td>
                        <td class="p-3 border border-gray-300">Todas</td>
                        <td class="p-3 border border-gray-300">
                            <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
