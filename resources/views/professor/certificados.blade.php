@extends('_layouts.master')

@section('body')
<div x-data="{ showModal: false, modalData: {} }" class="container mx-auto">
    <div class="p-4 mb-5 rounded-lg text-center bg-green-600 shadow-md">
        <h1 class="text-xl font-semibold text-white">{{ $titulo }}</h1>
    </div>

    <!-- Filtro por Turmas -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Filtrar Certificados</h2>
        <!-- Filtro de Turma e Pesquisa -->
        <div class="flex items-center gap-4 mb-6">
            <form action="{{ route('professor.certificados.index') }}" method="GET" class="flex gap-4 w-full">
                <input
                    type="text"
                    name="pesquisa"
                    placeholder="Pesquisar aluno..."
                    value="{{ request('pesquisa') }}"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                />

                <select
                    name="turma"
                    class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                >
                    <option value="todas">Todas as turmas</option>
                    @foreach ($turmas as $turma)
                        <option value="{{ $turma->id }}" {{ request('turma') == $turma->id ? 'selected' : '' }}>
                            {{ $turma->codigo }}
                        </option>
                    @endforeach
                </select>

                <select
                    name="status"
                    class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    >
                    <option value="pendentes"> Apenas Pendentes</option>
                    <option value="validos" {{ request('status') == 'validos' ? 'selected' : '' }}> Apenas Válidos</option>
                    <option value="invalidos" {{ request('status') == 'invalidos' ? 'selected' : '' }}> Apenas Inválidos</option>
                    <option value="todos" {{ request('status') == 'todos' ? 'selected' : '' }}>Todos</option>
                </select>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none"
                >
                    Filtrar
                </button>
            </form>
        </div>
    </div>

    <!-- Certificados Enviados -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Certificados Enviados</h2>

        <!-- Tabela de Certificados -->
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b border-gray-300 px-4 py-2">Aluno</th>
                    <th class="border-b border-gray-300 px-4 py-2">Turma</th>
                    <th class="border-b border-gray-300 px-4 py-2">Titulo</th>
                    <th class="border-b border-gray-300 px-4 py-2">Carga Horaria</th>
                    <th class="border-b border-gray-300 px-4 py-2">Status</th>
                    <th class="border-b border-gray-300 px-4 py-2">Arquivo</th>
                    <th class="border-b border-gray-300 px-4 py-2">Categoria</th>
                    <th class="border-b border-gray-300 px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Dados simulados -->
                @forelse($certificados->items() as $certificado)
                <tr>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->aluno->nome}}</td>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->aluno->turma->codigo}}</td>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->titulo}}</td>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->carga_horaria ?? ''}}</td>
                    <td class="border-b border-gray-200 px-4 py-2">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $certificado->status == 'valido' ? 'bg-green-50 text-green-800' : ($certificado->status == 'pendente' ? 'bg-yellow-50 text-yellow-800' : 'bg-red-50 text-red-800') }}">
                        {{ $certificado->formatStatus() }}
                      </span>
                    </td>
                    <td class="border-b border-gray-200 px-4 py-2"><a href="{{url($certificado->src_url)}}" class="text-green-600 hover:underline" target="_blank">Visualizar</a></td>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->categoria->nome}}</td>
                    <td class="border-b border-gray-200 px-4 py-2 space-y-2">
                        <!-- Ícone para abrir o modal -->
                        <button
                            @click="showModal = true; modalData = {
                                id: {{$certificado->id}},
                                aluno: '{{$certificado->aluno->nome}}',
                                turma: '{{$certificado->aluno->turma->codigo}}',
                                categoria: '{{$certificado->categoria->nome}}',
                                titulo: '{{$certificado->titulo}}',
                                cargaHoraria: '{{$certificado->carga_horaria ?? ''}}'
                            };"
                            class="text-gray-600 hover:text-gray-900"
                            title="Validar Certificado"
                        >
                            <svg class="w-6 h-6 text-gray-600" viewBox="0 0 16 16" fill="#9CA3AF" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0025 1.26315C9.97489 1.25099 9.94466 1.24597 9.9146 1.24855C9.88455 1.25113 9.85562 1.26122 9.83048 1.27789C9.80534 1.29457 9.78479 1.3173 9.77073 1.34399C9.75667 1.37068 9.74954 1.40048 9.75 1.43065V2.6844C9.75 2.85016 9.68415 3.00913 9.56694 3.12634C9.44973 3.24355 9.29076 3.3094 9.125 3.3094H1.25V6.9344H9.125C9.29076 6.9344 9.44973 7.00024 9.56694 7.11746C9.68415 7.23467 9.75 7.39364 9.75 7.5594V8.81315C9.75 8.94815 9.8875 9.03315 10.0025 8.98065L14.9825 5.3144L15.035 5.2794C15.0622 5.26306 15.0847 5.23998 15.1003 5.21238C15.1159 5.18478 15.1241 5.15361 15.1241 5.1219C15.1241 5.09019 15.1159 5.05902 15.1003 5.03142C15.0847 5.00382 15.0622 4.98073 15.035 4.9644L14.9825 4.9294L10.0025 1.26315ZM8.5 1.43065C8.49988 1.17323 8.56925 0.92056 8.70079 0.69929C8.83232 0.478019 9.02115 0.296357 9.24734 0.17347C9.47352 0.0505835 9.72869 -0.00897007 9.9859 0.00109343C10.2431 0.0111569 10.4929 0.0904642 10.7088 0.230647L15.7013 3.90565C15.9076 4.03448 16.0779 4.21373 16.1959 4.4265C16.3139 4.63928 16.3758 4.87859 16.3758 5.1219C16.3758 5.36521 16.3139 5.60451 16.1959 5.81729C16.0779 6.03007 15.9076 6.20931 15.7013 6.33815L10.7088 10.0131C10.4929 10.1533 10.2431 10.2326 9.9859 10.2427C9.72869 10.2528 9.47352 10.1932 9.24734 10.0703C9.02115 9.94744 8.83232 9.76578 8.70079 9.54451C8.56925 9.32323 8.49988 9.07056 8.5 8.81315V8.1844H0.625C0.45924 8.1844 0.300268 8.11855 0.183058 8.00134C0.065848 7.88413 0 7.72516 0 7.5594V2.6844C0 2.51864 0.065848 2.35967 0.183058 2.24246C0.300268 2.12525 0.45924 2.0594 0.625 2.0594H8.5V1.43065Z" fill="#59BE64"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="border-b border-gray-200 px-4 py-2 text-center" colspan="5">Nenhum certificado encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-8">
        {{ $certificados->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50"
        x-show="showModal"
    >
        <form
            method="POST"
            :action="`{{ route('professor.certificados.patch', '') }}/${modalData.id}`"
            class="bg-white p-8 rounded-lg w-full max-w-3xl relative"
        >
            @csrf
            @method('PATCH')

            <!-- Botão de fechar -->
            <button
                type="button"
                @click="showModal = false"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-800"
            >
                X
            </button>

            <!-- Conteúdo do modal -->
            <div class="space-y-6">
                <!-- Título e Aluno -->
                <div>
                    <h3 class="text-2xl font-semibold mb-2">
                        Certificado de <span x-text="modalData.aluno"></span>
                    </h3>
                    <p class="text-lg">Turma: <span x-text="modalData.turma"></span></p>
                </div>

                <!-- Input para título -->
                <div class="flex items-center">
                    <div class="w-full">
                        <label
                            for="titulo"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Título
                        </label>
                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            class="disabled:bg-gray-200 disabled:cursor-not-allowed disabled:text-gray-500 mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            x-model="modalData.titulo"
                            :value="modalData.titulo"
                            disabled
                        />
                    </div>
                    <button
                        type="button"
                        @click="document.getElementById('titulo').disabled = !document.getElementById('titulo').disabled"
                        class="ml-4 text-blue-500 hover:text-blue-700"
                    >
                        Alterar
                    </button>
                </div>

                <!-- Alterar categoria -->
                <div class="flex items-center">
                    <div class="w-full">
                        <label
                            for="categoria"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Categoria
                        </label>
                        <select
                            id="categoria"
                            name="categoria_id"
                            class="disabled:bg-gray-200 disabled:cursor-not-allowed disabled:text-gray-500 mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            x-model="modalData.categoria"
                            disabled
                            :value="modalData.categoria"
                        >
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id}}" :selected="modalData.categoria === '{{ $categoria->nome }}'">
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <button
                        type="button"
                        @click="document.getElementById('categoria').disabled = !document.getElementById('categoria').disabled"
                        class="ml-4 text-blue-500 hover:text-blue-700"
                    >
                        Alterar
                    </button>
                </div>

                <!-- Carga Horária -->
                <div class="flex items-center">
                    <div class="w-full">
                        <label
                            for="carga-horaria"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Quantidade de Carga Horária
                        </label>
                        <input
                            type="number"
                            id="carga-horaria"
                            name="carga_horaria"
                            class="disabled:bg-gray-200 disabled:cursor-not-allowed disabled:text-gray-500 mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            x-model="modalData.cargaHoraria"
                            :value="modalData.cargaHoraria"
                            min="0"
                            disabled
                        />
                    </div>
                    <button
                        type="button"
                        @click="document.getElementById('carga-horaria').disabled = !document.getElementById('carga-horaria').disabled"
                        class="ml-4 text-blue-500 hover:text-blue-700"
                    >
                        Alterar
                    </button>
                </div>

                <!-- Select para marcar status -->
                <div class="flex items-center">
                    <div class="w-full">
                        <label
                            for="status"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Marcar como
                        </label>
                        <select
                            id="status"
                            name="status"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        >
                            <option value="valido">Válido</option>
                            <option value="invalido">Inválido</option>
                            <option value="pendente">Pendente</option>
                        </select>
                    </div>
                </div>

                <!-- Botões de ação -->
                <div class="flex gap-4 mt-6">
                    <!-- Botão para Submeter -->
                    <button
                        type="submit"
                        class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 w-full"
                    >
                        Atualizar
                    </button>
                </div>
            </div>
        </form>
    </div>


</div>


@endsection
