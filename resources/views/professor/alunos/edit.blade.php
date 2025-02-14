@extends('_layouts.master')

@section('body')
  <div class="lg:pb-12 lg:pl-12 lg:pr-12">
    <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900"> Editar Aluno: {{ $aluno->nomeCompleto }} </h3>
      </div>
      <form class="mt-8 space-y-6" action="{{ route('professor.alunos.update', $aluno->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <!-- Nome Completo -->
          <div class="flex items-center md:col-span-2" x-data="{ isNomeEditable: false, nomeAluno: '{{ $aluno->nome }}' }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
              <input type="text" x-model="nomeAluno"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                :disabled="!isNomeEditable">
              <input type="hidden" name="nome" x-model="nomeAluno">
            </div>
            <button type="button" @click="isNomeEditable = !isNomeEditable"
              class="ml-4 mt-6 text-green-500 hover:text-green-700">
              <span x-text="isNomeEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- CPF -->
          <div class="flex items-center" x-data="{ cpfEditavel: false, alunoCpf: '{{ $aluno->format_cpf }}' }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">CPF</label>
              <input type="text" x-model="alunoCpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                placeholder="000.000.000-00" title="Formato: 000.000.000-00" :disabled="!cpfEditavel">
              <input type="hidden" name="cpf" x-model="alunoCpf">
            </div>
            <button type="button" @click="cpfEditavel = !cpfEditavel"
              class="ml-4 mt-6 text-green-500 hover:text-green-700">
              <span x-text="cpfEditavel ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- Data de Nascimento -->
          <div class="flex items-center" x-data="{ isDataEditable: false, dataNascimento: '{{ $aluno->data_nascimento }}' }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
              <div x-show="!isDataEditable"
                class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-200 p-2 shadow-sm">
                {{ $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : 'Não informada' }}
              </div>
              <input type="date" x-model="dataNascimento" x-show="isDataEditable"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
              <input type="hidden" name="data_nascimento" x-model="dataNascimento">
            </div>
            <button type="button" @click="isDataEditable = !isDataEditable"
              class="ml-4 mt-6 text-green-500 hover:text-green-700">
              <span x-text="isDataEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- Seletor de Turma -->
          <div class="md:col-span-2" x-data="seletorTurma({
              maxTurmas: 1,
              turmas: {{ json_encode(
                  $turmas->map(
                      fn($turma) => [
                          'id' => $turma->id,
                          'codigo' => $turma->codigo,
                          'nomeCurso' => optional($turma->curso)->nome,
                          'textoBusca' => $turma->codigo . ' - ' . optional($turma->curso)->nome,
                          'qtdAlunos' => $turma->alunos->count(),
                          'professorAtual' => optional($turma->professor)->nomeCompleto,
                      ],
                  ),
              ) }},
              turmasSelecionadas: {{ json_encode(
                  $aluno->turma
                      ? [
                          [
                              'id' => $aluno->turma->id,
                              'codigo' => $aluno->turma->codigo,
                              'nomeCurso' => optional($aluno->turma->curso)->nome,
                              'textoBusca' => $aluno->turma->codigo . ' - ' . optional($aluno->turma->curso)->nome,
                              'qtdAlunos' => $aluno->turma->alunos->count(),
                              'professorAtual' => optional($aluno->turma->professor)->nomeCompleto,
                          ],
                      ]
                      : [],
              ) }}
          })">
            <label class="block text-sm font-medium text-gray-700">Turma</label>

            <div class="relative mt-1" x-cloak>
              <input type="text" x-model="termoPesquisa" placeholder="Pesquisar por código ou curso..."
                class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 disabled:cursor-not-allowed disabled:bg-gray-200"
                :disabled="turmasSelecionadas.length >= 1" @input.debounce.500ms="">

              <template x-if="termoPesquisa.length > 0">
                <div class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-md">
                  <template x-for="turma in turmasFiltradas()" :key="turma.id">
                    <div @click="clicarTurma(turma)"
                      class="cursor-pointer border-b border-gray-100 p-3 transition-colors last:border-0 hover:bg-blue-50">
                      <div class="font-medium text-gray-900" x-text="turma.codigo + ' - ' + turma.nomeCurso"></div>
                      <div class="mt-1 text-sm text-gray-500">
                        Professor: <span x-text="turma.professorAtual || 'Sem professor'"></span>
                      </div>
                    </div>
                  </template>

                  <div x-show="turmasFiltradas().length === 0" class="p-3 text-gray-500">
                    Nenhuma turma encontrada
                  </div>
                </div>
              </template>
            </div>

            <div class="mt-3 space-y-2">
              <template x-for="(turma, index) in turmasSelecionadas" :key="turma.id">
                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3 shadow-sm">
                  <div>
                    <div class="font-medium text-gray-900" x-text="turma.codigo + ' - ' + turma.nomeCurso"></div>
                    <div class="mt-1 text-sm text-gray-500">
                      Alunos: <span x-text="turma.qtdAlunos"></span>
                    </div>
                  </div>
                  <button type="button" @click="turmasSelecionadas.splice(index, 1)"
                    class="ml-4 text-red-500 transition-colors hover:text-red-700" title="Remover turma">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                  <input type="hidden" name="id_turma" x-model="turma.id">
                </div>
              </template>
            </div>
          </div>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
            Salvar Alterações
          </button>
          <a href="{{ route('professor.alunos.show', $aluno->id) }}"
            class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  @vite('resources/js/components/seletor-turma.js')
  <script>
    /*    document.addEventListener('alpine:init', () => {
                    Alpine.data('seletorTurma', (config) => ({
                      maxTurmas: config.maxTurmas || 1,
                      turmas: config.turmas || [],
                      termoPesquisa: '',
                      turmasSelecionadas: config.turmasSelecionadas || [],

                      turmasFiltradas() {
                        const termo = this.removerAcentos(this.termoPesquisa.toLowerCase());
                        return this.turmas.filter(turma => {
                          const texto = this.removerAcentos(turma.textoBusca.toLowerCase());
                          return texto.includes(termo) && !this.turmasSelecionadas.find(t => t.id === turma.id);
                        });
                      },

                      clicarTurma(turma) {
                        if (this.turmasSelecionadas.length < this.maxTurmas) {
                          this.turmasSelecionadas.push(turma);
                          this.termoPesquisa = '';
                        }
                      },

                      removerAcentos(texto) {
                        return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
                      }
                    }));
                  });
  </script>
@endpush
