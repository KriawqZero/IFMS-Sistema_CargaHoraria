@extends('_layouts.master')

@section('body')
  <div>
    <div class="rounded-lg bg-green-600 p-4 text-center shadow-md">
      <h1 class="text-xl font-semibold text-white">Turmas</h1>
    </div>

    <div class="p-6">
      <div class="mb-6 flex items-end justify-end rounded-lg p-4">
        <a href="{{ route('professor.turmas.create') }}"
          class="rounded-md bg-blue-500 px-4 py-2 font-medium text-white hover:bg-blue-600">
          Nova Turma
        </a>
      </div>

      <div class="rounded-md bg-white p-4 shadow-md overflow-x-auto xl:overflow-visible">
        <table class="w-full border-collapse text-left">
          <thead>
            <tr>
              <th class="border-b border-gray-300 px-4 py-2">Código</th>
              <th class="border-b border-gray-300 px-4 py-2">Curso</th>
              <th class="border-b border-gray-300 px-4 py-2">Professor</th>
              <th class="border-b border-gray-300 px-4 py-2">Carga Horária</th>
              <th class="border-b border-gray-300 px-4 py-2"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($turmas as $turma)
              <tr>
                <td class="border-b border-gray-200 px-4 py-2 font-mono">{{ $turma->codigo }}</td>
                <td class="border-b border-gray-200 px-4 py-2">{{ $turma->curso->nome ?? 'Nenhum' }}</td>
                <td class="border-b border-gray-200 px-4 py-2">{{ $turma->professor->nomeCompleto ?? 'Sem professor' }}
                </td>
                <td class="border-b border-gray-200 px-4 py-2">{{ $turma->carga_horaria_minima }}h</td>
                <td class="border-b border-gray-200 px-4 py-2">
                  <div class="flex gap-2">
                    <a class="text-gray-600 hover:text-gray-800" href="{{ route('professor.turmas.edit', $turma->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6" viewBox="0 0 16 16">
                        <path
                          d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                      </svg>
                    </a>

                    <div x-data="{ showModal: false }">
                      <!-- Botão de exclusão -->
                      <a href="javascript:void(0)" class="text-red-500 hover:text-red-800"
                        @click.prevent="showModal = true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-6 w-6" viewBox="0 0 16 16">
                          <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                          <path
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                      </a>
                      <!-- Modal de exclusão -->
                      <div x-show="showModal"
                        class="fixed inset-0 flex h-full w-full items-center justify-center overflow-y-auto bg-gray-600 bg-opacity-50">
                        <div @click.away="showModal = false" class="w-11/12 rounded-lg bg-white p-6 shadow-lg md:w-1/3">
                          <h2 class="mb-4 text-lg font-semibold text-gray-700">Tem certeza que deseja excluir esta turma?
                          </h2>
                          <div class="flex justify-end space-x-2">
                            <button @click="showModal = false"
                              class="rounded bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400">Cancelar</button>
                            <form action="{{ route('professor.turmas.destroy', $turma->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">Excluir</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
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
