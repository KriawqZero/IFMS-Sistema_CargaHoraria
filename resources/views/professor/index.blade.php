@extends('_layouts.master')

@section('body')
    <div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/4 sm:mt-1">
            <div class="flex items-center px-5 py-6 shadow-xl rounded-3xl bg-white">
                <div class="p-3 rounded-full bg-red-600 bg-opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewbox="0 0 16 16">
                      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"/>
                    </svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ ucfirst(strtok($Professor->nome, ' ')) }}</h4>
                    <div class="text-gray-500">Professor(a)</div>
                </div>
            </div>
        </div>

        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/4 sm:mt-1">
            <div class="flex items-center px-5 py-6 shadow-xl rounded-3xl bg-white">
                <div class="p-3 rounded-full bg-fuchsia-600 bg-opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white"
                        viewbox="0 0 16 16">
                        <path
                            d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
                    </svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ count($certificados) }}</h4>
                    <div class="text-gray-500">Certificados Enviados</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 pb-12 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow-2xl overflow-hidden sm:rounded-3xl border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Tipo</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Data Enviada</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Comprovante</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
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
                                <a href="{{ $certificado->src }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm leading-5 font-medium">Ver
                                    comprovante</a>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                @if ($certificado->status == 'validado')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Validado</span>
                                @elseif($certificado->status == 'em_andamento')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Em
                                        andamento</span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inválido</span>
                                @endif
                            </td>

                            @if ($certificado->status == 'em_andamento')
                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="" class="bd-gray text-red-500 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 24 24">
                                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a>
                                </td>
                            @else
                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
