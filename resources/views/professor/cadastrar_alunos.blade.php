@extends('_layouts.master')

@section('body')
  <div class="container mx-auto px-4 py-8">
    <div class="rounded-lg bg-green-600 p-4 text-center shadow-md mb-8">
      <h1 class="text-xl font-semibold text-white">{{ $titulo }}</h1>
      <p class="mt-2 text-gray-100">Importe dados dos alunos através de um arquivo CSV ou texto formatado.</p>  
    </div>
    @if ($errors->any())
      <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-700">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="mb-6 rounded-lg bg-green-50 p-4 text-green-700">
        {{ session('success') }}
      </div>
    @endif

    @if (session('warning'))
      <div class="mb-6 rounded-lg bg-yellow-50 p-4 text-yellow-700">
        {{ session('warning') }}
      </div>
    @endif

    <form action="{{ route('professor.create.alunos.post') }}" method="POST">
      @csrf
      
      <div class="grid gap-8 lg:grid-cols-3">
        <!-- Coluna da Esquerda - Instruções -->
        <div class="lg:col-span-1">
          <div class="sticky top-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Instruções</h3>
            
            <div class="space-y-4">
              <div class="rounded-lg bg-blue-50 p-4">
                <h4 class="mb-2 font-medium text-blue-800">Dados necessários</h4>
                <ul class="space-y-2 text-sm text-gray-700">
                  <li class="flex items-center">
                    <svg class="mr-2 h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    CPF no formato XXX.XXX.XXX-XX
                  </li>
                  <li class="flex items-center">
                    <svg class="mr-2 h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Data de Nascimento (obrigatório)
                  </li>
                </ul>
              </div>

              <div class="rounded-lg bg-gray-50 p-4">
                <h4 class="mb-2 font-medium text-gray-800">Formatos aceitos</h4>
                <div class="space-y-2 text-sm">
                  <p class="text-gray-700">Separadores: vírgula (,) ou ponto e vírgula (;)</p>
                  <p class="text-gray-700">Datas: DD/MM/AAAA, DD-MM-AAAA, AAAA-MM-DD</p>
                </div>
              </div>

              <div class="rounded-lg bg-gray-50 p-4">
                <h4 class="mb-2 font-medium text-gray-800">Exemplo</h4>
                <div class="rounded bg-white p-3 text-xs font-mono">
                  <p class="text-gray-600">CPF,Data Nascimento</p>
                  <p class="text-blue-600">123.456.789-00,15/05/2000</p>
                  <p class="text-blue-600">987.654.321-00,01/01/2001</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Coluna da Direita - Formulário -->
        <div class="lg:col-span-2">
          <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <!-- Campo CSV -->
            <div>
              <label for="csv_text" class="mb-2 block font-medium text-gray-700">Dados dos alunos</label>
              <textarea id="csv_text" name="csv_text" rows="12"
                class="w-full rounded-lg border border-gray-300 p-4 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="CPF,Data Nascimento
123.456.789-00,15/05/2000
987.654.321-00,01/01/2001
456.789.123-00,30/12/2002"></textarea>
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
              class="mt-6 w-full rounded-lg bg-green-500 py-3 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
              Cadastrar Alunos
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@push('scripts')
  @vite('resources/js/components/seletor-turma.js')
@endpush
