@extends('_layouts.master')

@section('body')
<div class="p-6" x-data="{ showConcluirModal: false }">
    <div class="rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $aluno->nomeCompleto }}</h1>
                <p class="text-gray-600">{{ $aluno->turma ? $aluno->turma->curso->nome . ' - ' . $aluno->turma->codigo : 'Sem Turma'  }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="showConcluirModal = true" 
                        class="flex items-center rounded-lg px-4 py-2 font-medium transition-colors
                            {{ $aluno->concluido ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">
                    <span class="mr-2">🎓</span>
                    {{ $aluno->concluido ? 'Aluno Concluído' : 'Marcar como Concluído' }}
                </button>
                <div class="flex space-x-2">
                    <a href="{{ route('professor.alunos.edit', $aluno->id) }}" 
                       class="rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-gray-200">
                       Editar
                    </a>
                </div>
            </div>
        </div>

        <!-- Concluir Modal -->
        <div x-show="showConcluirModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="rounded-lg bg-white p-6 shadow-xl">
                <h3 class="mb-4 text-lg font-semibold">Confirmar Alteração de Status</h3>
                <p class="mb-4 text-gray-600">Tem certeza que deseja alterar o status de conclusão deste aluno?</p>
                <div class="flex justify-end gap-3">
                    <button @click="showConcluirModal = false" class="text-gray-600 hover:text-gray-800">
                        Cancelar
                    </button>
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                            Confirmar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col gap-6 md:flex-row">
            <!-- Photo Section -->
            <div class="md:w-1/4">
                <div class="relative h-48 w-48 overflow-hidden rounded-xl border-4 border-white">
                      <img src="{{ asset('storage/' . $aluno->foto_src) }}" class="h-full w-full object-cover">
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid flex-1 grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">CPF</label>
                        <p class="text-lg font-mono text-gray-900">{{ $aluno->formatCpf }}</p>
                    </div>
                    
                    @if($aluno->data_nascimento)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nascimento</label>
                        <p class="text-gray-600">
                            {{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}
                            ({{ \Carbon\Carbon::parse($aluno->data_nascimento)->age }} anos)
                        </p>
                    </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <!-- Hours Card -->
                    <div class="rounded-xl bg-gradient-to-br from-blue-600 to-purple-600 p-4 text-white">
                        <div class="text-sm">Horas Aproveitadas</div>
                        <div class="text-3xl font-bold">
                            {{ number_format($aluno->cargaHorariaTotal(), 1) }}h
                        </div>
                        <div class="text-sm opacity-90">de {{ $aluno->maxCargaHoraria() }}h necessárias</div>
                    </div>

                    <!-- Certificates Status -->
                    <div class="grid grid-cols-4 gap-2">
                        <div class="rounded-lg bg-green-100 p-2 text-center">
                            <div class="text-xl font-bold text-green-800">
                                {{ $aluno->certificados->where('status', 'valido')->count() }}
                            </div>
                            <div class="text-xs text-green-600">Válidos</div>
                        </div>
                        <div class="rounded-lg bg-red-100 p-2 text-center">
                            <div class="text-xl font-bold text-red-800">
                                {{ $aluno->certificados->where('status', 'invalido')->count() }}
                            </div>
                            <div class="text-xs text-red-600">Inválidos</div>
                        </div>
                        <div class="rounded-lg bg-yellow-100 p-2 text-center">
                            <div class="text-xl font-bold text-yellow-800">
                                {{ $aluno->certificados->where('status', 'pendente')->count() }}
                            </div>
                            <div class="text-xs text-yellow-600">Pendentes</div>
                        </div>
                        <div class="rounded-lg bg-blue-100 p-2 text-center">
                            <div class="text-xl font-bold text-blue-800">
                                {{ $aluno->certificados->count() }}
                            </div>
                            <div class="text-xs text-blue-600">Total</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ route('professor.alunos.relatorio.exportar', $aluno->id) }}"
               class="flex items-center rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                Relatório Simplificado
            </a>
            <button class="flex items-center rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-purple-700">
                Relatório Completo (Em breve)
            </button>
        </div>

        
      <!-- Tabela de certificados -->
      <div class="mt-8">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">Certificados Registrados</h2>

        <div class="rounded-lg border border-gray-200">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Data</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Título</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Horas</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Categoria</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @forelse($aluno->certificados as $certificado)
                <tr class="cursor-pointer hover:bg-gray-100"
                  @click="window.open('{{ route('professor.certificados.index', ['id' => $certificado->id]) }}')">
                  <td class="px-4 py-2 text-sm text-gray-600">{{ $certificado->created_at->format('d/m/Y') }}</td>
                  <td class="px-4 py-2 text-sm text-gray-600">{{ $certificado->titulo }}</td>
                  <td class="px-4 py-2 text-sm text-gray-600">{{ number_format($certificado->carga_horaria / 60, 1) }}h
                  </td>
                  <td class="px-4 py-2 text-sm text-gray-600">{{ $certificado->categoria->nome ?? 'N/A' }}</td>
                  <td class="px-4 py-2">
                    <span
                      class="{{ $certificado->status === 'valido' ? 'bg-green-100 text-green-800' : ($certificado->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                      {{ ucfirst($certificado->status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                    Nenhum certificado registrado
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ url()->previous() }}" 
               class="flex items-center text-gray-600 hover:text-gray-800">
                ← Voltar para a lista de alunos
            </a>
        </div>
    </div>
</div>
@endsection
