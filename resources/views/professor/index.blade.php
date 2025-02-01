@extends('_layouts.master')

@section('body')
    <div class="mt-4">
        <!-- Card do Professor -->
        <div class="-mx-6 flex flex-wrap">
            <div class="w-full px-6 sm:mt-1 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center rounded-3xl bg-white px-5 py-6 shadow-xl">
                    <div class="rounded-full bg-red-600 bg-opacity-75 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="white" viewbox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <div class="text-gray-500">Olá, Professor(a)</div>
                        <h4 class="text-2xl font-semibold text-gray-700">{{ ucfirst($professor->nome) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards das Turmas -->
        <div class="mt-8">
            <div class="rounded-2xl bg-white p-8 shadow-lg">
                <h3 class="mb-6 text-center text-3xl font-bold text-gray-800">Turmas Designadas</h3>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($turmas as $turma)
                        <!-- Turma 2 -->
                        <a href="{{ route('professor.alunos.index', ['turma' => $turma->codigo]) }}"
                            style="background-color: #CCE6D8;"
                            class="flex transform items-center rounded-xl p-5 shadow-md transition-transform hover:scale-105">
                            <div class="mr-5 flex h-14 w-14 items-center justify-center rounded-full bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-700" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path d="M4 4h8v1H4V4zm0 3h8v1H4V7zm0 3h8v1H4v-1zm0 3h8v1H4v-1z" />
                                </svg>
                            </div>
                            <span class="text-xl font-semibold text-gray-900">Turma {{ $turma->codigo }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Table Certificados -->
            <div
                class="mt-8 inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow sm:rounded-lg">
                <table class="min-w-full">

                    <thead>
                        <tr>
                            <th
                                class="border-b border-gray-200 bg-gray-100 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                Certificados Enviados</th>
                            <th
                                class="border-b border-gray-200 bg-gray-100 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                Data</th>
                            <th
                                class="border-b border-gray-200 bg-gray-100 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                Status</th>
                            <th
                                class="border-b border-gray-200 bg-gray-100 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                Aluno</th>
                            <th
                                class="border-b border-gray-200 bg-gray-100 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                Visualizado</th>
                            <th class="border-b border-gray-200 bg-gray-100 px-6 py-3"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr>
                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">Semana Arte e Cultura 2022
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <div class="text-sm leading-5 text-gray-900">18/06/2022</div>
                            </td>

                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Avaliado</span>
                            </td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-sm leading-5 text-gray-500">
                                Tiririca</td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">
                                <div class="inline-flex items-center">
                                    <label class="relative flex cursor-pointer items-center" for="check-1">
                                        <input type="checkbox" checked
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all checked:border-slate-800 checked:bg-slate-800 hover:shadow-md"
                                            id="check-1" />
                                        <span
                                            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform text-white opacity-0 peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="ml-2 cursor-pointer text-sm text-slate-600" for="check-1">
                                        Visualizar
                                    </label>
                                </div>

                            </td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">

                            </td>

                        </tr>
                        <tr>
                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">Semana Arte e Cultura 2022
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <div class="text-sm leading-5 text-gray-900">18/06/2022</div>
                            </td>

                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Avaliado</span>
                            </td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-sm leading-5 text-gray-500">
                                Danyela</td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">
                                <div class="inline-flex items-center">
                                    <label class="relative flex cursor-pointer items-center" for="check-2">
                                        <input type="checkbox" checked
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all checked:border-slate-800 checked:bg-slate-800 hover:shadow-md"
                                            id="check-2" />
                                        <span
                                            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform text-white opacity-0 peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="ml-2 cursor-pointer text-sm text-slate-600" for="check-2">
                                        Visualizar
                                    </label>
                                </div>

                            </td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">

                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">Fecipan</div>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <div class="text-sm leading-5 text-gray-900">04/09/2024</div>
                            </td>

                            <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Avaliado</span>
                            </td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-sm leading-5 text-gray-500">
                                Davi</td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">
                                <div class="inline-flex items-center">
                                    <label class="relative flex cursor-pointer items-center" for="check-3">
                                        <input type="checkbox" checked
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all checked:border-slate-800 checked:bg-slate-800 hover:shadow-md"
                                            id="check-3" />
                                        <span
                                            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform text-white opacity-0 peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                stroke-width="1">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="ml-2 cursor-pointer text-sm text-slate-600" for="check-3">
                                        Visualizar
                                    </label>
                                </div>

                            </td>

                            <td
                                class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
