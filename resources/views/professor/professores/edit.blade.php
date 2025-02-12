@extends('_layouts.master')

@section('body')
  <div class="lg:pb-12 lg:pl-12 lg:pr-12">
    <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900">
          Editar Professor: {{ $professor->nome }}
        </h3>
      </div>

      <div class="relative mt-6 rounded border border-yellow-400 bg-yellow-100 px-4 py-3 text-yellow-700" role="alert">
        <p>Se você deseja resetar a senha deste professor, clique no botão "Resetar Senha".</p>
      </div>

      <form class="mt-8 space-y-6" action="{{ route('professor.professores.update', $professor->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-2 gap-6 md:grid-cols-1">
          <div class="col-span-2 flex items-center md:col-span-1" x-data="{ isNomeEditable: false, nomeProfessor: '{{ $professor->nome }}' }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
              <input type="text" required
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                x-model="nomeProfessor" :disabled="!isNomeEditable" value="{{ old('nome', $professor->nome) }}">
              <input type="hidden" name="nome" x-model="nomeProfessor">
            </div>
            <button type="button" @click="isNomeEditable = !isNomeEditable"
              class="ml-4 mt-6 text-green-500 hover:text-green-700">
              <span x-text="isNomeEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <div class="flex items-center md:col-span-1" x-data="{ isCargoEditable: false, cargo: '{{ $professor->cargo }}' }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Cargo</label>
              <select x-model="cargo" name="cargo"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                :disabled="!isCargoEditable">
                <option value="professor" {{ $professor->cargo === 'professor' ? 'selected' : '' }}>Professor</option>
                <option value="coordenador" {{ $professor->cargo === 'coordenador' ? 'selected' : '' }}>Coordenador
                </option>
              </select>
              <input type="hidden" name="cargo" x-model="cargo">
            </div>
            <button type="button" @click="isCargoEditable = !isCargoEditable"
              class="ml-4 mt-6 text-green-500 hover:text-green-700">
              <span x-text="isCargoEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <div class="md:col-span-2" x-data="seletorTurma({
              maxTurmas: 3,
              mensagens: { turmaOcupada: 'Esta turma já possui um professor' },
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
                  $professor->turmas->map(
                      fn($t) => [
                          'id' => $t->id,
                          'codigo' => $t->codigo,
                          'nomeCurso' => optional($t->curso)->nome,
                          'textoBusca' => $t->codigo . ' - ' . optional($t->curso)->nome,
                          'qtdAlunos' => $t->alunos->count(),
                          'professorAtual' => optional($t->professor)->nomeCompleto,
                      ],
                  ),
              ) }}
          })">
            <label class="block text-sm font-medium text-gray-700">Turmas (Máximo 3)</label>

            <div class="relative mt-1" x-cloak>
              <input type="text" x-model="termoPesquisa" placeholder="Pesquisar por código ou nome do curso..."
                class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 disabled:cursor-not-allowed disabled:bg-gray-200"
                :disabled="turmasSelecionadas.length >= 3" @input.debounce.500ms="">

              <template x-if="termoPesquisa.length > 0">
                <div class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-md">
                  <template x-for="turma in turmasFiltradas()" :key="turma.id">
                    <div @click="clicarTurma(turma)"
                      class="cursor-pointer border-b border-gray-100 p-3 transition-colors last:border-0"
                      :class="{
                          'text-red-800 cursor-not-allowed': turma.professorAtual,
                          'hover:bg-blue-50': !turma.professorAtual
                      }">
                      <div class="font-medium"
                        :class="{ 'text-red-800': turma.professorAtual, 'text-gray-900': !turma.professorAtual }"
                        x-text="textoTurma(turma)">
                      </div>
                      <div class="mt-1 text-sm text-gray-500">
                        Curso: <span class="font-mono" x-text="turma.nomeCurso"></span>
                      </div>
                      <div class="mt-1 text-sm text-red-700" x-show="turma.professorAtual">
                        Professor Atual: <span x-text="turma.professorAtual"></span>
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
                    <div class="font-medium text-gray-900" x-text="textoTurma(turma)"></div>
                    <div class="mt-1 text-sm text-gray-500">
                      Código: <span class="font-mono" x-text="turma.codigo"></span>
                    </div>
                    <div class="mt-1 text-sm text-gray-500">
                      Alunos: <span class="font-mono" x-text="turma.qtdAlunos"></span>
                    </div>
                    <div class="mt-1 text-sm text-gray-500">
                      Curso: <span class="font-mono" x-text="turma.nomeCurso"></span>
                    </div>
                  </div>
                  <button type="button" @click="turmasSelecionadas.splice(index, 1)"
                    class="ml-4 text-red-500 transition-colors hover:text-red-700" title="Remover turma">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                  <input type="hidden" name="turmas[]" x-model="turma.id">
                </div>
              </template>
            </div>
          </div>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
            Atualizar
          </button>
          <a href="{{ route('professor.professores.index') }}" class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400">
            Cancelar
          </a>

        </div>
      </form>

      <form action="{{ route('professor.professores.resetarSenha', $professor->id) }}" method="POST" class="ml-auto">
        @csrf
        @method('PATCH')
        <button type="submit" class="rounded bg-yellow-500 px-4 py-2 text-red-800 hover:bg-yellow-600"
          onclick="return confirm('Tem certeza que deseja resetar a senha deste professor?')">
          Resetar Senha
        </button>
      </form>

    </div>
  </div>
@endsection

@push('scripts')
  @vite('resources/js/components/seletor-turma.js')
@endpush
