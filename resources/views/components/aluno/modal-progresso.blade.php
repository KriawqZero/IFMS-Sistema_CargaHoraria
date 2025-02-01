@props(['aluno'])
<div>
    <!-- Modal -->
    <div x-cloak x-show="showProgressModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="w-full max-w-xl overflow-hidden rounded-[30px] bg-white shadow-lg">
            <!-- Header -->
            <div class="bg-green-500 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">
                    Progresso das Horas Complementares
                </h3>
            </div>

            <!-- Body -->
            <div class="max-h-[70vh] space-y-4 overflow-y-auto p-6">
                @foreach ($aluno->cargaHorariaDetalhadaPorCategoria() as $categoria => $dados)
                    <div class="rounded-lg bg-green-50 p-4">
                        <h4 class="mb-2 font-semibold text-green-700">{{ $categoria }}</h4>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600">Total:</p>
                                <p class="font-medium">{{ $dados['total'] }}h</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Aproveitado:</p>
                                <p
                                    class="{{ $dados['aproveitado'] > $dados['limite'] ? 'text-red-500' : 'text-green-600' }} font-medium">
                                    {{ $dados['aproveitado'] }}h
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600">Limite:</p>
                                <p class="font-medium">{{ $dados['limite'] }}h</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-6 flex items-center justify-center border-t border-green-100 pt-4">
                    @if ($aluno->estaAprovado())
                        <p class="text-center text-lg font-bold text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-check-circle-fill mx-auto" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <span>
                                APROVADO: {{ $aluno->cargaHorariaTotal() }}h
                            </span>
                        </p>
                    @else
                        <p class="text-center text-lg font-bold text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-check-circle-fill mx-auto" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                            </svg>
                            <span>
                                PENDENTE: {{ $aluno->cargaHorariaTotal() }}h /
                                {{ $aluno->turma->carga_horaria_minima }}h
                            </span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end bg-green-50 px-6 py-4">
                <button @click="showProgressModal = false"
                    class="rounded-full bg-green-500 px-4 py-2 text-white transition-colors duration-200 hover:bg-green-600">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>
