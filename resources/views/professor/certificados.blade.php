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
              <th class="w-[10%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Carga Horária</th>
              <th class="w-[10%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Status</th>
              <th class="w-[8%] border-b border-gray-300 px-1.5 py-2 xl:px-3">Arquivo</th>
              <th class="w-[5%] border-b border-gray-300 px-1.5 py-2 xl:px-3"></th>
            </tr>
          </thead>
          <tbody class="text-xs sm:text-sm xl:text-base">
            @forelse($certificados->items() as $certificado)
              <tr>
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
                    class="text-xs text-green-600 hover:text-green-900 hover:underline xl:text-sm"
                    target="_blank">Visualizar</a>
                </td>
                <td class="border-b border-gray-200 px-1.5 py-2 xl:px-3">
                  <button
                    @click="showModal = true; modalData = {
                                    id: {{ $certificado->id }},
                                    aluno: '{{ $certificado->aluno->nome }}',
                                    cert_src: '{{ url($certificado->src_url) }}',
                                    turma: '{{ $certificado->aluno->turma->codigo }}',
                                    categoria: '{{ $certificado->categoria->nome }}',
                                    titulo: '{{ $certificado->titulo }}',
                                    cargaHoraria: '{{ $certificado->carga_horaria }}',
                                    formattedCargaHoraria: '{{ floor($certificado->carga_horaria / 60) }}:{{ str_pad($certificado->carga_horaria % 60, 2, '0', STR_PAD_LEFT) }}'
                                  };"
                    class="text-green-600 hover:text-green-900" title="Validar Certificado">
                    <svg class="h-6 w-6" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10.0025 1.26315C9.97489 1.25099 9.94466 1.24597 9.9146 1.24855C9.88455 1.25113 9.85562 1.26122 9.83048 1.27789C9.80534 1.29457 9.78479 1.3173 9.77073 1.34399C9.75667 1.37068 9.74954 1.40048 9.75 1.43065V2.6844C9.75 2.85016 9.68415 3.00913 9.56694 3.12634C9.44973 3.24355 9.29076 3.3094 9.125 3.3094H1.25V6.9344H9.125C9.29076 6.9344 9.44973 7.00024 9.56694 7.11746C9.68415 7.23467 9.75 7.39364 9.75 7.5594V8.81315C9.75 8.94815 9.8875 9.03315 10.0025 8.98065L14.9825 5.3144L15.035 5.2794C15.0622 5.26306 15.0847 5.23998 15.1003 5.21238C15.1159 5.18478 15.1241 5.15361 15.1241 5.1219C15.1241 5.09019 15.1159 5.05902 15.1003 5.03142C15.0847 5.00382 15.0622 4.98073 15.035 4.9644L14.9825 4.9294L10.0025 1.26315ZM8.5 1.43065C8.49988 1.17323 8.56925 0.92056 8.70079 0.69929C8.83232 0.478019 9.02115 0.296357 9.24734 0.17347C9.47352 0.0505835 9.72869 -0.00897007 9.9859 0.00109343C10.2431 0.0111569 10.4929 0.0904642 10.7088 0.230647L15.7013 3.90565C15.9076 4.03448 16.0779 4.21373 16.1959 4.4265C16.3139 4.63928 16.3758 4.87859 16.3758 5.1219C16.3758 5.36521 16.3139 5.60451 16.1959 5.81729C16.0779 6.03007 15.9076 6.20931 15.7013 6.33815L10.7088 10.0131C10.4929 10.1533 10.2431 10.2326 9.9859 10.2427C9.72869 10.2528 9.47352 10.1932 9.24734 10.0703C9.02115 9.94744 8.83232 9.76578 8.70079 9.54451C8.56925 9.32323 8.49988 9.07056 8.5 8.81315V8.1844H0.625C0.45924 8.1844 0.300268 8.11855 0.183058 8.00134C0.065848 7.88413 0 7.72516 0 7.5594V2.6844C0 2.51864 0.065848 2.35967 0.183058 2.24246C0.300268 2.12525 0.45924 2.0594 0.625 2.0594H8.5V1.43065Z" />
                    </svg>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td class="border-b border-gray-200 px-4 py-2 text-center" colspan="9">Nenhum certificado
                  encontrado.
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
              class="hover:underline ml-4 text-green-500 hover:text-green-700">Visualizar Arquivo</a>
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
              <select id="categoria" name="categoria_id"
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
              <select id="status" name="status"
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
