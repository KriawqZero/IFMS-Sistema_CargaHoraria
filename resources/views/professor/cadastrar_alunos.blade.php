@extends('_layouts.master')

@section('body')
  <div class="w-full max-w-2xl rounded-lg bg-white p-8 shadow-md">
    <h1 class="mb-6 text-2xl font-bold">Cadastrar alunos em massa</h1>

    @if ($errors->any())
      <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('professor.create.alunos.post') }}" method="POST" class="space-y-6">
      @csrf

      <!-- Campo CSV -->
      <div>
        <label for="csv_text" class="mb-2 block font-medium text-gray-700">Conteúdo CSV</label>
        <textarea id="csv_text" name="csv_text" rows="10"
          class="w-full rounded-lg border border-gray-300 p-4 focus:outline-none focus:ring-2 focus:ring-green-500"
          placeholder="Exemplo: 123.456.789-00\n987.654.321-00"></textarea>
        <p class="mt-2 text-sm text-gray-500">Insira um CPF por linha, no formato: 000.000.000-00</p>
      </div>

      <!-- Seletor de Turma -->
      <div x-data="seletorTurma({
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

      <button type="submit"
        class="w-full rounded-lg bg-green-500 py-3 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
        Cadastrar Alunos
      </button>
    </form>
  </div>
@endsection

@push('scripts')
  @vite('resources/js/components/seletor-turma.js')
@endpush
