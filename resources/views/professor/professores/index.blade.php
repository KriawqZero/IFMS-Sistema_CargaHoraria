@extends('_layouts.master')

@section('body')
  <div>
    <div class="rounded-lg bg-green-600 p-4 text-center shadow-md">
      <h1 class="text-xl font-semibold text-white">Professores</h1>
    </div>

    <div class="p-6">
      <div class="mb-6 flex items-end justify-end rounded-lg p-4">
        <a href="{{ route('professor.professores.create') }}"
          class="rounded-md bg-blue-500 px-4 py-2 font-medium text-white hover:bg-blue-600">
          Novo Professor
        </a>
      </div>

      <div class="rounded-md bg-white p-4 shadow-md">
        <table class="w-full border-collapse text-left">
          <thead>
            <tr>
              <th class="border-b border-gray-300 px-4 py-2">Nome</th>
              <th class="border-b border-gray-300 px-4 py-2">Cargo</th>
              <th class="border-b border-gray-300 px-4 py-2">Turmas</th>
              <th class="border-b border-gray-300 px-4 py-2"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($professores as $professor)
              <tr>
                <td class="border-b border-gray-200 px-4 py-2">{{ $professor->nomeCompleto }}</td>
                <td class="border-b border-gray-200 px-4 py-2">{{ ucfirst($professor->cargo) }}</td>
                <td class="border-b border-gray-200 px-4 py-2">
                  @foreach ($professor->turmas->take(3) as $turma)
                    <span class="rounded bg-gray-100 px-2 py-1 text-sm">{{ $turma->codigo }}</span>
                  @endforeach
                </td>
                <td class="border-b border-gray-200 px-4 py-2">
                  <div class="flex gap-2">
                    <a href="{{ route('professor.professores.edit', $professor->id) }}"
                      class="text-blue-500 hover:text-blue-700">
                      <!-- Ícone de edição -->
                    </a>
                    <!-- Modal de exclusão similar ao do curso -->
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
