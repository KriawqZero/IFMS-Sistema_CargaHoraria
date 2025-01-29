@props(['aluno'])
<div>
    <!-- Modal -->
    <div x-cloak x-show="showProgressModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-[30px] shadow-lg w-full max-w-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-green-500 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">
                    Progresso das Horas Complementares
                </h3>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                @foreach($aluno->cargaHorariaDetalhadaPorCategoria() as $categoria => $dados)
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-green-700 mb-2">{{ $categoria }}</h4>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600">Total:</p>
                                <p class="font-medium">{{ $dados['total'] }}h</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Aproveitado:</p>
                                <p class="font-medium {{ $dados['aproveitado'] >= $dados['limite'] ? 'text-red-500' : 'text-green-600' }}">
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

                <div class="flex justify-center items-center mt-6 pt-4 border-t border-green-100">
                    @if($aluno->estaAprovado())
                        <p class="text-center text-green-600 font-bold text-lg">
                              <svg xmlns="http://www.w3.org/2000/svg"
                                   width="24"
                                   height="24"
                                   fill="currentColor"
                                   class="bi bi-check-circle-fill mx-auto"
                                   viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                              </svg>
                            <span>
                                APROVADO: {{ $aluno->cargaHorariaTotal() }}h
                            </span>
                        </p>
                    @else
                        <p class="text-center text-red-500 font-bold text-lg">
                          <svg xmlns="http://www.w3.org/2000/svg"
                               width="24"
                               height="24"
                               fill="currentColor"
                               class="bi bi-check-circle-fill mx-auto"
                               viewBox="0 0 16 16">
                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                            </svg>
                            <span>
                                PENDENTE: {{ $aluno->cargaHorariaTotal() }}h / {{ $aluno->turma->carga_horaria_minima }}h
                            </span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-green-50 px-6 py-4 flex justify-end">
                <button
                    @click="showProgressModal = false"
                    class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors duration-200"
                >
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>
