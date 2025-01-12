@extends('_layouts.master')

@section('body')
    <div class="mt-4">
        <!-- Card do Professor -->
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 sm:mt-1">
                <div class="flex items-center px-5 py-6 shadow-xl rounded-3xl bg-white">
                    <div class="p-3 rounded-full bg-red-600 bg-opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewbox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ ucfirst(strtok($professor->nome, ' ')) }}</h4>
                        <div class="text-gray-500">Professor(a)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards das Turmas -->
        <div class="mt-8">
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-3xl font-bold text-gray-800 mb-6 text-center">Turmas Designadas</h3>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Turma 1 -->
                    <div
                        class="flex items-center bg-blue-100 shadow-md p-5 rounded-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center justify-center bg-green-200 rounded-full w-14 h-14 mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-700" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path d="M4 4h8v1H4V4zm0 3h8v1H4V7zm0 3h8v1H4v-1zm0 3h8v1H4v-1z" />
                            </svg>
                        </div>
                        <span class="text-gray-900 text-xl font-semibold">Turma 20210</span>
                    </div>
                    <!-- Turma 2 -->
                    <div
                        class="flex items-center bg-blue-100 shadow-md p-5 rounded-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center justify-center bg-green-200 rounded-full w-14 h-14 mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-700" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path d="M4 4h8v1H4V4zm0 3h8v1H4V7zm0 3h8v1H4v-1zm0 3h8v1H4v-1z" />
                            </svg>
                        </div>
                        <span class="text-gray-900 text-xl font-semibold">Turma 1079</span>
                    </div>
                </div>
            </div>

            <!-- Table Certificados -->
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 mt-8">
                <table class="min-w-full">

                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider ">
                                Certificados Enviados</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Data</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Aluno</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Visualizado</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">Semana Arte e Cultura 2022
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">18/06/2022</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Avaliado</span>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                Tiririca</td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <div class="inline-flex items-center">
                                    <label class="flex items-center cursor-pointer relative" for="check-1">
                                        <input type="checkbox" checked
                                            class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 checked:bg-slate-800 checked:border-slate-800"
                                            id="check-1" />
                                        <span
                                            class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="cursor-pointer ml-2 text-slate-600 text-sm" for="check-1">
                                        Visualizar
                                    </label>
                                </div>

                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                
                            </td>

                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">Semana Arte e Cultura 2022
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">18/06/2022</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Avaliado</span>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                Danyela</td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <div class="inline-flex items-center">
                                    <label class="flex items-center cursor-pointer relative" for="check-2">
                                        <input type="checkbox" checked
                                            class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 checked:bg-slate-800 checked:border-slate-800"
                                            id="check-2" />
                                        <span
                                            class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="cursor-pointer ml-2 text-slate-600 text-sm" for="check-2">
                                        Visualizar
                                    </label>
                                </div>

                            </td>


                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">Fecipan</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">04/09/2024</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Avaliado</span>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                Davi</td>

                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <div class="inline-flex items-center">
                                    <label class="flex items-center cursor-pointer relative" for="check-3">
                                        <input type="checkbox" checked
                                            class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow
                                             hover:shadow-md border border-slate-300 checked:bg-slate-800 checked:border-slate-800"
                                            id="check-3" />
                                        <span
                                            class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="cursor-pointer ml-2 text-slate-600 text-sm" for="check-3">
                                        Visualizar
                                    </label>
                                </div>

                            </td>


                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
