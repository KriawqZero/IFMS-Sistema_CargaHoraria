@extends('_layouts.master')

@section('body')
  <div class="lg:pb-12 lg:pl-12 lg:pr-12">
    <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900">
          Editar Turma {{ $turma->codigo }}
        </h3>
      </div>

      <form class="mt-8 space-y-6" action="{{ route('professor.turmas.update', $turma->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">Código</label>
            <input type="text" name="codigo" value="{{ old('codigo', $turma->codigo) }}" required
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Carga Horária Mínima</label>
            <input type="number" name="carga_horaria_minima"
              value="{{ old('carga_horaria_minima', $turma->carga_horaria_minima) }}"
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Curso</label>
            <select name="curso_id" class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
              @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $turma->curso_id == $curso->id ? 'selected' : '' }}>
                  {{ $curso->nome }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="md:col-span-2" x-data="seletorProfessor({
              professors: {{ json_encode(
                  $professores->map(
                      fn($professor) => [
                          'id' => $professor->id,
                          'nome' => $professor->nome,
                          'email' => $professor->email,
                          'cargo' => $professor->cargo,
                          'textoBusca' => $professor->nome . ' - ' . $professor->email,
                      ],
                  ),
              ) }},
              professorSelecionado: {{ json_encode(
                  $turma->professor
                      ? [
                          'id' => $turma->professor->id,
                          'nome' => $turma->professor->nome,
                          'email' => $turma->professor->email,
                          'cargo' => $turma->professor->cargo,
                          'textoBusca' => $turma->professor->nome . ' - ' . $turma->professor->email,
                      ]
                      : null,
              ) }}
          })">
            <label class="block text-sm font-medium text-gray-700">Professor</label>

            <div class="relative mt-1" x-cloak>
              <input type="text" x-model="termoPesquisa" placeholder="Pesquisar professor por nome ou email..."
                class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 disabled:cursor-not-allowed disabled:bg-gray-200"
                :disabled="!!professorSelecionado" @input.debounce.500ms="">

              <template x-if="termoPesquisa.length > 0">
                <div class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-md">
                  <template x-for="professor in professoresFiltrados()" :key="professor.id">
                    <div @click="selecionarProfessor(professor)"
                      class="cursor-pointer border-b border-gray-100 p-3 transition-colors last:border-0 hover:bg-blue-50">
                      <div class="font-medium text-gray-900" x-text="professor.nome"></div>
                      <div class="mt-1 text-sm text-gray-500">
                        Email: <span x-text="professor.email"></span>
                      </div>
                      <div class="mt-1 text-sm text-gray-500">
                        Cargo: <span x-text="professor.cargo"></span>
                      </div>
                    </div>
                  </template>

                  <div x-show="professoresFiltrados().length === 0" class="p-3 text-gray-500">
                    Nenhum professor encontrado
                  </div>
                </div>
              </template>
            </div>

            <div class="mt-3 space-y-2">
              <template x-if="professorSelecionado">
                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3 shadow-sm">
                  <div>
                    <div class="font-medium text-gray-900" x-text="professorSelecionado.nome"></div>
                    <div class="mt-1 text-sm text-gray-500">
                      Email: <span x-text="professorSelecionado.email"></span>
                    </div>
                  </div>

                  <button type="button" @click="professorSelecionado = null"
                    class="ml-4 text-red-500 transition-colors hover:text-red-700" title="Remover professor">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                  <input type="hidden" name="professor_id" x-model="professorSelecionado.id">
                </div>
              </template>
            </div>
          </div>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
            Salvar
          </button>
          <a href="{{ route('professor.turmas.index') }}" class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('seletorProfessor', (config) => ({
        professors: config.professors || [],
        professorSelecionado: config.professorSelecionado || null,
        termoPesquisa: '',

        professoresFiltrados() {
          const termo = this.removerAcentos(this.termoPesquisa.toLowerCase());
          return this.professors.filter(professor => {
            const texto = this.removerAcentos(professor.textoBusca.toLowerCase());
            return texto.includes(termo) &&
              (!this.professorSelecionado || professor.id !== this.professorSelecionado.id);
          });
        },

        selecionarProfessor(professor) {
          this.professorSelecionado = professor;
          this.termoPesquisa = '';
        },

        removerAcentos(texto) {
          return texto.normalize('NFD').replace(/[̀-ͯ]/g, '');
        }
      }));
    });
  </script>
@endpush
