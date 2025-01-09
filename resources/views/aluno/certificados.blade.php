@extends('_layouts.master')

@section('body')
    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 pb-12 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <div class="flex justify-end">
                <form action={{ route('aluno.certificados.create')}}>
                    <button
                        type="submit"
                        class="shadow-xl mb-5 px-6 py-3 bg-green-600 rounded-3xl text-white font-medium tracking-wide hover:bg-green-700 ml-3 mr-8 ">
                        Enviar Certificado</button>
                </form>
            </div>

            <div class="align-middle shadow-2xl inline-block min-w-full overflow-hidden rounded-3xl border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Tipo</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Data Enviada</th>
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
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ $certificado->observacao ?? 'Sem observações' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    @if ($certificado->status == 'validado')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-bold text-green-600">Validado</span>
                                    @elseif($certificado->status == 'em_andamento')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-bold text-gray-600 disabled">Em
                                            andamento</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-bold text-red-600">
                                            Inválido</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        @php
                                            if($certificado->carga_horaria)
                                                $horas = number_format($certificado->carga_horaria / 60, 1, ',', '');
                                            else $horas = null;
                                        @endphp
                                        {{ $horas ? $horas . ' horas' : '' }}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
