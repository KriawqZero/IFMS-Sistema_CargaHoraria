@extends('_layouts.master')

@section('body')
    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 pb-12 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <div class="flex justify-end">
                <a href="{{ route('aluno.certificados.create') }}"
                    class="shadow-xl mb-5 px-6 py-3 bg-green-600 rounded-3xl text-white font-medium tracking-wide hover:bg-green-700 ml-3 mr-8 ">
                    Enviar Certificado</a>
            </div>

            <div
                class="align-middle shadow-2xl inline-block min-w-full overflow-hidden rounded-3xl border-b border-gray-200">
                <table class="min-w-full">
                    <thead class="hidden md:table-header-group">
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Tipo</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Data Enviada </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Comprovante</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Observação</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Carga Horária</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white hidden md:table-row-group">
                        @foreach ($certificados as $certificado)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $certificado->tipo }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y \à\s H:i:s') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="{{ $certificado->src_url }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-900 text-sm leading-5 font-medium">Ver
                                        comprovante</a>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $certificado->observacao ?? 'Sem observações' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $certificado->status == 'validado'
                                            ? 'bg-green-50 text-green-800'
                                            : ($certificado->status == 'em_andamento'
                                                ? 'bg-yellow-50 text-yellow-800'
                                                : 'bg-red-50 text-red-800') }}">
                                        {{ $certificado->formatStatus() }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        @php
                                            if ($certificado->carga_horaria) {
                                                $horas = number_format($certificado->carga_horaria / 60, 1, ',', '');
                                            } else {
                                                $horas = null;
                                            }
                                        @endphp
                                        {{ $horas ? $horas . ' horas' : '' }}
                                    </div>
                                </td>

                                @if ($certificado->status == 'em_andamento')
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                        <div x-data="{ showModal: false, certificadoId: null }">
                                            <!-- Botão de exclusão aqui -->
                                            <a href="javascript:void(0)" class="bd-gray text-red-500 hover:text-red-800"
                                                @click.prevent="showModal = true; certificadoId = {{ $certificado->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="bi bi-trash w-6 h-6" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </a>

                                            <!-- Modal -->
                                            <div x-show="showModal"
                                                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
                                                <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                                                    <x-buttons::close-button data="showModal" />
                                                    <h2 class="text-lg font-semibold text-gray-700">Tem certeza que deseja
                                                        excluir este certificado?</h2>
                                                    <div class="mt-4 flex justify-end space-x-2">
                                                        <button @click="showModal = false"
                                                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                                            Cancelar
                                                        </button>
                                                        <form :action="`/aluno/certificados/delete/${certificadoId}`"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                                Excluir
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                    <tbody class="bg-white md:hidden">
                        @foreach ($certificados as $certificado)
                            <tr class="">
                                <td colspan="7" class="px-6 py-4">
                                    <div x-data="{ open: false }" class="border-b border-gray-200">
                                        <button @click="open = !open"
                                            class="w-full text-left text-sm font-medium text-gray-900">
                                            Certificado
                                            {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y') }} <span
                                                x-show="!open" class="ml-2">▼</span><span x-show="open"
                                                class="ml-2">▲</span>
                                        </button>
                                        <div x-show="open" class="mt-2 text-sm text-gray-900">
                                            <p><strong>Tipo:</strong> {{ $certificado->tipo }}</p>
                                            <p><strong>Data Enviada:</strong>
                                                {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y \à\s H:i:s') }}
                                            </p>
                                            <p><strong>Comprovante:</strong> <a href="{{ $certificado->src_url }}"
                                                    target="_blank" class="text-indigo-600 hover:text-indigo-900">Ver
                                                    Comprovante</a></p>
                                            <p><strong>Observação:</strong>
                                                {{ $certificado->observacao ?? 'Sem observações' }}</p>
                                            <p><strong>Status:</strong>
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $certificado->status == 'validado'
                                                        ? 'bg-green-50 text-green-800'
                                                        : ($certificado->status == 'em_andamento'
                                                            ? 'bg-yellow-50 text-yellow-800'
                                                            : 'bg-red-50 text-red-800') }}">
                                                    {{ $certificado->formatStatus() }}
                                                </span>
                                            </p>
                                            @php
                                                if ($certificado->carga_horaria) {
                                                    $horas = number_format(
                                                        $certificado->carga_horaria / 60,
                                                        1,
                                                        ',',
                                                        '',
                                                    );
                                                } else {
                                                    $horas = null;
                                                }
                                            @endphp
                                            @if ($horas)
                                                <p><strong>Carga Horária:</strong>
                                                    {{ $horas . ' horas' }}
                                                </p>
                                            @endif
                                            @if ($certificado->status == 'em_andamento')
                                                <div class="mt-4 flex justify-end space-x-2">
                                                    <a href="javascript:void(0)"
                                                        @click.prevent="showModalMobile = true; certificadoId = {{ $certificado->id }}"
                                                        class="text-red-500 hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-trash w-6 h-6" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div x-show="showModalMobile"
                                                        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
                                                        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                                                            <h2 class="text-lg font-semibold text-gray-700">Tem certeza que
                                                                deseja excluir este certificado?</h2>
                                                            <div class="mt-4 flex justify-end space-x-2">
                                                                <button @click="showModalMobile = false"
                                                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                                                    Cancelar
                                                                </button>
                                                                <form
                                                                    :action="`/aluno/certificados/delete/${certificadoId}`"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                                        Excluir
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
