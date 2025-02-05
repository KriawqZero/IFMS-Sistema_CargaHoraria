@extends('_layouts.master')

@section('body')
<div class="p-6">
  <div class="rounded-lg bg-white p-6 shadow-md">
    <!-- Cabeçalho com botão de edição -->
    <div class="mb-6 flex justify-between">
      <h1 class="text-2xl font-bold text-gray-800">Detalhes do Aluno</h1>
      <a href="{{ route('professor.alunos.edit', $aluno->id) }}" class="text-gray-600 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
      </a>
    </div>

    <!-- Seção de informações do aluno -->
    <div class="flex flex-col gap-6 md:flex-row">
      <!-- Foto do aluno -->
      <div class="md:w-1/4">
        <div class="relative h-48 w-48 overflow-hidden rounded-lg border-2 border-gray-200">
          @if($aluno->foto_src)
            <img src="{{ asset('storage/' . $aluno->foto_src) }}" alt="Foto do aluno" class="h-full w-full object-cover">
          @else
            <div class="flex h-full w-full items-center justify-center bg-gray-100 text-gray-400">
              <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
          @endif
        </div>
      </div>

      <!-- Dados do aluno -->
      <div class="flex-1 space-y-4">
        <div>
          <label class="text-sm font-medium text-gray-500">Nome Completo</label>
          <p class="mt-1 text-lg font-semibold text-gray-900">{{ $aluno->nomeCompleto }}</p>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-500">CPF</label>
          <p class="mt-1 font-mono text-gray-600">{{ $aluno->formatCpf }}</p>
        </div>

        @if($aluno->data_nascimento)
        <div>
          <label class="text-sm font-medium text-gray-500">Data de Nascimento</label>
          <p class="mt-1 text-gray-600">
            {{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</p>
          </p>
        </div>
        @endif

        <div>
          <label class="text-sm font-medium text-gray-500">Status</label>
          <p class="mt-1">
            <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium {{ $aluno->concluido ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
              {{ $aluno->concluido ? 'Concluído' : 'Em andamento' }}
            </span>
          </p>
        </div>
      </div>
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
              <td class="px-4 py-2 text-sm text-gray-600">{{ number_format($certificado->carga_horaria / 60, 1) }}h</td>
              <td class="px-4 py-2 text-sm text-gray-600">{{ $certificado->categoria->nome ?? 'N/A' }}</td>
              <td class="px-4 py-2">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $certificado->status === 'valido' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
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

    <!-- Botão de voltar -->
    <div class="mt-8">
      <a href="{{ url()->previous() }}" class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Voltar
      </a>
    </div>
  </div>
</div>
@endsection
