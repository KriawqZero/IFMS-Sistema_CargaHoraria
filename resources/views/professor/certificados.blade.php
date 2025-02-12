@extends('_layouts.master')

@section('body')
  <div x-data="{ showModal: false, modalData: {} }" class="container mx-auto">
    <div class="mb-5 rounded-lg bg-green-600 p-4 text-center shadow-md">
      <h1 class="text-xl font-semibold text-white">{{ $titulo }}</h1>
    </div>

    <!-- Filtro por Turmas -->
    <div class="mb-6 rounded-lg bg-white p-6 shadow-md">
      <h2 class="mb-4 text-lg font-semibold">Filtrar Certificados</h2>
      <!-- Filtro de Turma e Pesquisa -->
      <div class="mb-6 flex items-center gap-4">
        <form action="{{ route('professor.certificados.index') }}" method="GET" class="flex w-full gap-4">
          <input type="text" name="pesquisa" placeholder="Pesquisar aluno..." value="{{ request('pesquisa') }}"
            class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-green-300" />

          <select name="turma"
            class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-green-300">
            <option value="todas">Todas as turmas</option>
            @foreach ($turmas as $turma)
              <option value="{{ $turma->id }}" {{ request('turma') == $turma->id ? 'selected' : '' }}>
                @php
                  $certificadosPendentes = $turma->alunos->reduce(function ($carry, $aluno) {
                      return $carry + $aluno->certificados->where('status', 'pendente')->count();
                  }, 0);
                @endphp
                {{ $turma->codigo }} ({{ $certificadosPendentes }}) - {{ $turma->curso->nome ?? 'Sem curso' }}
              </option>
            @endforeach
          </select>

          <select name="status"
            class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-green-300">
            <option value="todos" {{ request('status') == 'todos' ? 'selected' : '' }}>Todos</option>
            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}> Apenas Pendentes</option>
            <option value="valido" {{ request('status') == 'valido' ? 'selected' : '' }}> Apenas Válidos
            </option>
            <option value="invalido" {{ request('status') == 'invalido' ? 'selected' : '' }}> Apenas Inválidos
            </option>
          </select>

          <button type="submit"
            class="rounded-md bg-green-500 px-4 py-2 text-white hover:bg-green-600 focus:outline-none">
            Filtrar
          </button>
        </form>
      </div>
    </div>

    <div class="rounded-lg bg-white p-4 shadow-md sm:p-6">
      <h2 class="mb-4 text-lg font-semibold">Certificados de Alunos</h2>

      <div class="overflow-x-auto xl:overflow-visible">
        <table class="w-full min-w-[1100px] xl:min-w-full xl:table-fixed">
          <thead>
            <tr class="text-xs sm:text-sm xl:text-base">
              <th class="w-[14%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Aluno</th>
              <th class="w-[12%] border-b border-gray-300 px-1.5 py-2 xl:px-3">CPF</th>
              <th class="w-[8%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Turma</th>
              <th class="w-[16%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Titulo</th>
              <th class="w-[12%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Categoria</th>
              <th class="w-[10%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Data Constante</th>
              <th class="w-[10%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Carga Horária</th>
              <th class="w-[10%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Status</th>
              <th class="w-[8%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Arquivo</th>
            </tr>
          </thead>
          <tbody class="text-xs sm:text-sm xl:text-base">
            @forelse($certificados->items() as $certificado)
              <tr class="cursor-pointer hover:bg-gray-100"
                @click="if (!event.target.closest('a')) {
                      showModal = true;
                      modalData = {
                          id: {{ $certificado->id }},
                          aluno: '{{ addslashes($certificado->aluno->nome) }}',
                          cert_src: '{{ url($certificado->src_url) }}',
                          turma: '{{ addslashes($certificado->aluno->turma->codigo) }}',
                          categoria_id: '{{ addslashes($certificado->categoria->id) }}',
                          titulo: '{{ addslashes($certificado->titulo) }}',
                          data_constante: '{{ $certificado->data_constante ? \Carbon\Carbon::parse($certificado->data_constante)->format('d/m/Y') : 'Não informada' }}',
                          cargaHoraria: '{{ $certificado->carga_horaria }}',
                          formattedCargaHoraria: '{{ floor($certificado->carga_horaria / 60) }}:{{ str_pad($certificado->carga_horaria % 60, 2, '0', STR_PAD_LEFT) }}',
                          status: '{{ $certificado->status }}'
                      }
                  }">
                <!-- Colunas anteriores -->
                <td class="max-w-[140px] truncate border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  {{ $certificado->aluno->nome }}</td>
                <td class="whitespace-nowrap border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  {{ $certificado->aluno->format_cpf }}</td>
                <td class="border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  {{ $certificado->aluno->turma->codigo }}</td>
                <td class="max-w-[180px] truncate border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  {{ $certificado->titulo }}</td>
                <td class="max-w-[120px] truncate border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  {{ $certificado->categoria->nome }}</td>
                <td class="max-w-[120px] truncate border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  {{ $certificado->data_constante ?
                  \Carbon\Carbon::parse($certificado->data_constante)->format('d/m/Y') : 'Não informada' }}</td>
                <td class="whitespace-nowrap border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  @php
                    $horas = $certificado->carga_horaria
                        ? number_format($certificado->carga_horaria / 60, 1, ',', '')
                        : null;
                  @endphp
                  {{ $horas ? $horas . 'h' : '' }}
                </td>
                <td class="border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  <span
                    class="{{ $certificado->status == 'valido' ? 'bg-green-50 text-green-800' : ($certificado->status == 'pendente' ? 'bg-yellow-50 text-yellow-800' : 'bg-red-50 text-red-800') }} inline-flex rounded-full px-1.5 text-[10px] font-semibold leading-5 xl:px-2 xl:text-xs">
                    {{ $certificado->formatStatus() }}
                  </span>
                </td>
                <td class="border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  <a href="{{ url($certificado->src_url) }}"
                    class="text-xs text-green-600 hover:text-green-900 hover:underline xl:text-sm" target="_blank"
                    @click.stop>
                    Visualizar
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td class="border-b border-gray-200 px-4 py-2 text-center" colspan="9">Nenhum certificado encontrado.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-8">
        {{ $certificados->links() }}
      </div>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75" x-show="showModal">
      <form method="POST" :action="`{{ route('professor.certificados.patch', '') }}/${modalData.id}`"
        class="relative w-full max-w-3xl rounded-lg bg-white p-8">
        @csrf
        @method('PATCH')

        <!-- Botão de fechar -->
        <button type="button" @click="showModal = false"
          class="absolute right-4 top-4 text-gray-500 hover:text-gray-800">
          X
        </button>

        <!-- Conteúdo do modal -->
        <div class="space-y-6">
          <!-- Título e Aluno -->
          <div>
            <h3 class="mb-2 text-2xl font-semibold">
              Certificado de <span x-text="modalData.aluno"></span>
            </h3>
            <p class="text-lg">Turma: <span x-text="modalData.turma"></span></p>
          </div>

          <!-- Arquivo -->
          <div class="flex items-center">
            <label class="block text-sm font-medium text-gray-700">Arquivo:</label>
            <a :href="modalData.cert_src" target="_blank"
              class="ml-4 text-green-500 hover:text-green-700 hover:underline">Visualizar Arquivo</a>
          </div>

          <!-- Input para título -->
          <div class="flex items-center" x-data="{ isTituloEditable: false }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Título</label>
              <input type="text" id="titulo" name="titulo"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                x-model="modalData.titulo" :disabled="!isTituloEditable">
              <input type="hidden" name="titulo" x-model="modalData.titulo">
            </div>
            <button type="button" @click="isTituloEditable = !isTituloEditable"
              class="ml-4 text-green-500 hover:text-green-700">
              <span x-text="isTituloEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- Alterar categoria -->
          <div class="flex items-center" x-data="{ isCategoriaEditable: false }">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">Categoria</label>
              <select id="categoria"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm disabled:cursor-not-allowed disabled:bg-gray-200"
                x-model="modalData.categoria_id" :disabled="!isCategoriaEditable">
                @foreach ($categorias as $categoria)
                  <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
              </select>
              <input type="hidden" name="categoria_id" x-model="modalData.categoria_id">
            </div>
            <button type="button" @click="isCategoriaEditable = !isCategoriaEditable"
              class="ml-4 text-green-500 hover:text-green-700">
              <span x-text="isCategoriaEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- Data Constante -->
          <div class="flex items-center" x-data="{ isDataEditable: false }">
            <div class="w-full">
              <label for="data-constante" class="block text-sm font-medium text-gray-700">
                Data Constante (dd/mm/aaaa)
              </label>
              <input type="text" id="data-constante"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-green-500 focus:ring-green-500 disabled:cursor-not-allowed disabled:bg-gray-200 sm:text-sm"
                x-model="modalData.data_constante" :disabled="!isDataEditable" pattern="^\d{2}/\d{2}/\d{4}$"
                placeholder="DD/MM/AAAA">
              <input type="hidden" name="data_constante" x-model="modalData.data_constante">
              <p x-show="!/^\d{2}\/\d{2}\/\d{4}$/.test(modalData.data_constante)" class="mt-1 text-xs text-red-500">
                Formato inválido. Use DD/MM/AAAA
              </p>
            </div>
            <button type="button" @click="isDataEditable = !isDataEditable"
              class="ml-4 text-green-500 hover:text-green-700">
              <span x-text="isDataEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- Carga Horária -->
          <div class="flex items-center" x-data="{ isCargaHorariaEditable: false }">
            <div class="w-full">
              <label for="carga-horaria" class="block text-sm font-medium text-gray-700">
                Quantidade de Carga Horária
              </label>
              <input type="text" id="carga-horaria" pattern="^\d{1,3}:[0-5]\d$"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-green-500 focus:ring-green-500 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:text-gray-500 sm:text-sm"
                x-model="modalData.formattedCargaHoraria" :disabled="!isCargaHorariaEditable"
                x-effect="if(modalData.formattedCargaHoraria && isCargaHorariaEditable) {
                                const [hours, minutes] = modalData.formattedCargaHoraria.split(':').map(Number);
                                modalData.cargaHoraria = (hours * 60) + minutes;
                            }"
                placeholder="HH:mm (ex: 02:30)">
              <input type="hidden" name="carga_horaria" x-model="modalData.formattedCargaHoraria">
              <p x-show="!/^\d{1,3}:[0-5]\d$/.test(modalData.formattedCargaHoraria)" class="mt-1 text-xs text-red-500">
                Formato inválido. Use HH:mm (ex: 02:30)
              </p>
            </div>
            <button type="button" @click="isCargaHorariaEditable = !isCargaHorariaEditable"
              class="ml-4 text-green-500 hover:text-green-700">
              <span x-text="isCargaHorariaEditable ? 'Bloquear' : 'Alterar'"></span>
            </button>
          </div>

          <!-- Select para marcar status -->
          <div class="flex items-center">
            <div class="w-full">
              <label for="status" class="block text-sm font-medium text-gray-700">
                Marcar como
              </label>
              <select id="status" name="status" x-model="modalData.status"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                <option value="valido">Válido</option>
                <option value="invalido">Inválido</option>
                <option value="pendente">Pendente</option>
              </select>
            </div>
          </div>

          <!-- Botões de ação -->
          <div class="mt-6 flex gap-4">
            <!-- Botão para Submeter -->
            <button type="submit" class="w-full rounded-md bg-green-500 px-6 py-3 text-white hover:bg-green-600">
              Atualizar
            </button>
          </div>
        </div>
      </form>
    </div>

  </div>
@endsection
