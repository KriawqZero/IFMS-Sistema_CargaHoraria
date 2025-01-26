@extends('_layouts.master')

@section('body')
<div class="container mx-auto">
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
                    <option value="todos">Todos</option>
                    <option value="validos" {{ request('status') == 'validos' ? 'selected' : '' }}> Apenas Válidos</option>
                    <option value="invalidos" {{ request('status') == 'invalidos' ? 'selected' : '' }}> Apenas Inválidos</option>
                    <option value="pendentes" {{ request('status') == 'pendentes' ? 'selected' : '' }}> Apenas Pendentes</option>
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
                    <th class="border-b border-gray-300 px-4 py-2">Arquivo</th>
                    <th class="border-b border-gray-300 px-4 py-2">Observações</th>
                    <th class="border-b border-gray-300 px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dados simulados -->
                @forelse($certificados->items() as $certificado)
                <tr>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->aluno->nome}}</td>
                    <td class="border-b border-gray-200 px-4 py-2">{{$certificado->aluno->turma->codigo}}</td>
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
                                cargaHoraria: '{{$certificado->carga_horaria ?? ''}}'
                            };
                            console.log(modalData); console.log(showModal)"
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
</div>

<div x-data="{ showModal: false, modalData: {} }">
    <!-- Modal -->
    <div
        class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center"
        x-show="showModal"
    >
        <div class="bg-white p-6 rounded-lg w-96 relative">
            <button @click="showModal = false" class="absolute top-2 right-2">X</button>

            <div class="space-y-4">
                <!-- Informações do Modal -->
                <div>
                    <h3 class="text-lg font-semibold mb-2">Certificado de: <span x-text="modalData.aluno"></span></h3>
                    <p class="text-sm">Turma: <span x-text="modalData.turma"></span></p>
                </div>

                <!-- Opções de Aprovação/Rejeição -->
                <div class="flex gap-2">
                    <button
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 w-full"
                        @click="aprovarCertificado(modalData.id)"
                    >
                        Aprovar
                    </button>
                    <button
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 w-full"
                        @click="rejeitarCertificado(modalData.id)"
                    >
                        Rejeitar
                    </button>
                </div>

                <!-- Alterar categoria -->
                <div>
                    <label for="categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                    <select
                        id="categoria"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        x-model="modalData.categoria"
                    >
                        <option value="participacao">Participação</option>
                        <option value="carga_horaria">Carga Horária</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>

                <!-- Carga Horária -->
                <div class="mt-4">
                    <label for="carga-horaria" class="block text-sm font-medium text-gray-700">Quantidade de Carga Horária</label>
                    <input
                        type="number"
                        id="carga-horaria"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        x-model="modalData.cargaHoraria"
                        placeholder="Horas"
                    />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
