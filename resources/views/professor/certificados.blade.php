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
                    <th class="border-b border-gray-300 px-4 py-2">Ações</th>
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
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->categoria}}</td>
                    <td class="border-b border-gray-200 px-4 py-2 space-y-2">
                        <!-- Ícone para abrir o modal -->
                        <button
                            @click="showModal = true; modalData = {
                                id: {{$certificado->id}},
                                aluno: '{{$certificado->aluno->nome}}',
                                turma: '{{$certificado->aluno->turma->codigo}}',
                                categoria: '{{$certificado->categoria}}',
                                titulo: '{{$certificado->titulo}}',
                                cargaHoraria: '{{$certificado->carga_horaria ?? ''}}'
                            };"
                            class="text-gray-600 hover:text-gray-900"
                        >
                        Avaliar
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
            action="{{ route('professor.certificados.patch') }}"
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
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
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
                            name="categoria"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            x-model="modalData.categoria"
                            disabled
                            :value="modalData.categoria"
                        >
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="Unidades curriculares optativa/eletivas" :selected="modalData.categoria === 'Unidades curriculares optativa/eletivas'">
                                Unidades curriculares optativa/eletivas
                            </option>
                            <option value="Projetos de ensino, pesquisa e extensão" :selected="modalData.categoria === 'Projetos de ensino, pesquisa e extensão'">
                                Projetos de ensino, pesquisa e extensão
                            </option>
                            <option value="Prática Profissional Integradora" :selected="modalData.categoria === 'Prática profissional integradora'">
                                Prática Profissional Integradora
                            </option>
                            <option value="Práticas Desportivas" :selected="modalData.categoria === 'Práticas desportivas'">
                                Práticas Desportivas
                            </option>
                            <option value="Práticas Artístico-Culturais" :selected="modalData.categoria === 'Práticas artístico-culturais'">
                                Práticas Artístico-Culturais
                            </option>
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
                            name="cargahoraria"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
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
                        class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 w-full"
                    >
                        Atualizar
                    </button>
                </div>
            </div>

            <!-- Campo oculto para ID do certificado -->
            <input type="hidden" name="id" :value="modalData.id" />
        </form>
    </div>


</div>


@endsection
