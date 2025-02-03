@extends('_layouts.master')

@section('body')
  <div x-data="{ showProgressModal: false, modalData: {} }">
    <div class="rounded-lg bg-green-600 p-4 text-center shadow-md">
      <h1 class="text-xl font-semibold text-white">{{ $titulo }}</h1>
    </div>

    <div class="p-6">
      <!-- Filtro por Turma -->
      <div class="mb-6 rounded-lg bg-white p-4 shadow-md">
        <h2 class="mb-4 text-lg font-medium">Filtrar Alunos</h2>
        <form method="GET" action="{{ route('professor.alunos.index') }}">
          <div class="flex items-center gap-4">
            <label for="turma" class="text-gray-600">Pesquisa:</label>
            <input type="text" name="pesquisa" placeholder="Nome ou CPF..." value="{{ request('pesquisa') }}"
              class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-green-300" />
            <select id="turma" name="turma" class="w-1/3 rounded-md border border-gray-300 p-2">
              <option value="todas" {{ request('turma') == 'todas' ? 'selected' : '' }}>Todas as Turmas</option>
              @foreach ($turmas as $turma)
                <option value="{{ $turma->codigo }}" {{ request('turma') == $turma->codigo ? 'selected' : '' }}>
                  {{ $turma->codigo }} - {{ $turma->curso->nome ?? 'Sem curso' }}
                </option>
              @endforeach
            </select>
            <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 font-medium text-white hover:bg-blue-600">
              Filtrar
            </button>
          </div>
        </form>
      </div>

      <!-- Lista de Alunos -->
      <div class="rounded-md bg-white p-4 shadow-md">
        <h2 class="mb-4 text-lg font-medium text-gray-700">Alunos</h2>
        <!-- Tabela de Certificados -->
        <table class="w-full border-collapse text-left">
          <thead>
            <tr>
              <th class="border-b border-gray-300 px-4 py-2">Aluno</th>
              <th class="border-b border-gray-300 px-4 py-2">CPF</th>
              <th class="border-b border-gray-300 px-4 py-2">Certificados V/I/P/E </th>
              <th class="border-b border-gray-300 px-4 py-2">Carga Horaria</th>
              <th class="border-b border-gray-300 px-4 py-2">Turma</th>
              <th class="border-b border-gray-300 px-4 py-2">Curso</th>
              <th class="border-b border-gray-300 px-4 py-2">Ações</th>
            </tr>
          </thead>

          <tbody>
            @forelse($alunos->items() as $aluno)
              <tr>
                <td class="flex border-b border-gray-200 px-4 py-2">
                  <div class="row relative block flex h-8 w-8 overflow-hidden rounded-full shadow focus:outline-none">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $aluno->foto_src) }}"
                      alt="Foto de perfil">
                  </div>
                  <span class="row mx-2 my-1 flex">
                    {{ $aluno->nome }}
                  </span>
                </td>
                <td class="border-b border-gray-200 px-4 py-2">{{ $aluno->format_cpf }}</td>
                <td class="border-b border-gray-200 px-4 py-2">
                  {{ $aluno->certificados->where('status', 'valido')->count() }}
                  / {{ $aluno->certificados->where('status', 'invalido')->count() }}
                  / {{ $aluno->certificados->where('status', 'pendente')->count() }}
                  / {{ $aluno->certificados->count() }}
                </td>
                <td class="border-b border-gray-200 px-4 py-2">
                  {{ $aluno->cargaHorariaTotal() }} horas
                  <button class="ml-2 text-green-600 hover:underline" title="Ver detalhes">
                    <svg class="h-4 w-4" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                      <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                    </svg>
                  </button>
                </td>
                <td class="border-b border-gray-200 px-4 py-2">{{ $aluno->turma->codigo ?? 'Sem turma' }}</td>
                <td class="border-b border-gray-200 px-4 py-2">{{ $aluno->turma->curso->nome ?? 'Sem curso' }}</td>
                <td class="border-b border-gray-200 px-4 py-2">
                  <a href="#" class="text-green-600 hover:underline" target="_blank">Ver detalhes</a>
                </td>
              </tr>
            @empty
              <tr>
                <td class="border-b border-gray-200 px-4 py-2 text-center" colspan="7">Nenhum aluno
                  encontrado.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Paginação -->
      <div class="mt-8">
        {{ $alunos->links() }}
      </div>
    </div>
  </div>
@endsection
