@extends('_layouts.master')

@section('body')
  <div class="lg:pb-12 lg:pl-12 lg:pr-12">
    <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900">
          Editar Professor: {{ $professor->nome }}
        </h3>
      </div>

      <form class="mt-8 space-y-6" action="{{ route('professor.professores.update', $professor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <!-- Campos existentes do create -->

          <div class="md:col-span-2" x-data="{
              search: '',
              selectedTurmas: {{ json_encode($professor->turmas) }},
              allTurmas: {{ json_encode($turmas) }},
              filteredTurmas() {
                  return this.allTurmas.filter(turma =>
                      turma.nome.toLowerCase().includes(this.search.toLowerCase()) &&
                      !this.selectedTurmas.find(t => t.id === turma.id)
                  );
              }
          }" x-init="selectedTurmas = selectedTurmas.map(t => ({ id: t.id, nome: t.nome }))">
            <label class="block text-sm font-medium text-gray-700">Turmas (Máximo 3)</label>

            <!-- Mesmo componente de seleção do create -->

            <div class="mt-2 space-y-2">
              <template x-for="(turma, index) in selectedTurmas" :key="turma.id">
                <div class="flex items-center justify-between rounded bg-gray-100 p-2">
                  <span x-text="turma.nome"></span>
                  <button type="button" @click="selectedTurmas.splice(index, 1)" class="text-red-500 hover:text-red-700">
                    &times;
                  </button>
                  <input type="hidden" name="turmas[]" x-model="turma.id">
                </div>
              </template>
            </div>
          </div>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
            Atualizar
          </button>
          <a href="{{ route('professor.professores.index') }}" class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
