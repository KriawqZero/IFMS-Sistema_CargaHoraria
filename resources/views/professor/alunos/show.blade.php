@extends('_layouts.master')

@section('body')
  <div class="p-6">
    <div class="rounded-lg bg-white p-6 shadow-md">
      <!-- Cabeçalho com botão de edição -->
      <div class="mb-6 flex justify-between">
        <h1 class="justify-self-start text-2xl font-bold text-gray-800">Detalhes do Aluno</h1>
        <div class="flex space-x-4">
          <a href="{{ route('professor.alunos.edit', $aluno->id) }}"
            class="text-gray-600 hover:bg-blue-200 hover:text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
          </a>
          <form action="{{ route('professor.alunos.destroy', $aluno->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:bg-red-200 hover:text-red-800">
              <svg class="h-6 w-6" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M5.5 5.5C5.63261 5.5 5.75979 5.55268 5.85355 5.64645C5.94732 5.74021 6 5.86739 6 6V12C6 12.1326 5.94732 12.2598 5.85355 12.3536C5.75979 12.4473 5.63261 12.5 5.5 12.5C5.36739 12.5 5.24021 12.4473 5.14645 12.3536C5.05268 12.2598 5 12.1326 5 12V6C5 5.86739 5.05268 5.74021 5.14645 5.64645C5.24021 5.55268 5.36739 5.5 5.5 5.5ZM8 5.5C8.13261 5.5 8.25979 5.55268 8.35355 5.64645C8.44732 5.74021 8.5 5.86739 8.5 6V12C8.5 12.1326 8.44732 12.2598 8.35355 12.3536C8.25979 12.4473 8.13261 12.5 8 12.5C7.86739 12.5 7.74021 12.4473 7.64645 12.3536C7.55268 12.2598 7.5 12.1326 7.5 12V6C7.5 5.86739 7.55268 5.74021 7.64645 5.64645C7.74021 5.55268 7.86739 5.5 8 5.5ZM11 6C11 5.86739 10.9473 5.74021 10.8536 5.64645C10.7598 5.55268 10.6326 5.5 10.5 5.5C10.3674 5.5 10.2402 5.55268 10.1464 5.64645C10.0527 5.74021 10 5.86739 10 6V12C10 12.1326 10.0527 12.2598 10.1464 12.3536C10.2402 12.4473 10.3674 12.5 10.5 12.5C10.6326 12.5 10.7598 12.4473 10.8536 12.3536C10.9473 12.2598 11 12.1326 11 12V6Z"
                  fill="#FF0000" />
                <path
                  d="M14.5 3C14.5 3.26522 14.3946 3.51957 14.2071 3.70711C14.0196 3.89464 13.7652 4 13.5 4H13V13C13 13.5304 12.7893 14.0391 12.4142 14.4142C12.0391 14.7893 11.5304 15 11 15H5C4.46957 15 3.96086 14.7893 3.58579 14.4142C3.21071 14.0391 3 13.5304 3 13V4H2.5C2.23478 4 1.98043 3.89464 1.79289 3.70711C1.60536 3.51957 1.5 3.26522 1.5 3V2C1.5 1.73478 1.60536 1.48043 1.79289 1.29289C1.98043 1.10536 2.23478 1 2.5 1H6C6 0.734784 6.10536 0.48043 6.29289 0.292893C6.48043 0.105357 6.73478 0 7 0L9 0C9.26522 0 9.51957 0.105357 9.70711 0.292893C9.89464 0.48043 10 0.734784 10 1H13.5C13.7652 1 14.0196 1.10536 14.2071 1.29289C14.3946 1.48043 14.5 1.73478 14.5 2V3ZM4.118 4L4 4.059V13C4 13.2652 4.10536 13.5196 4.29289 13.7071C4.48043 13.8946 4.73478 14 5 14H11C11.2652 14 11.5196 13.8946 11.7071 13.7071C11.8946 13.5196 12 13.2652 12 13V4.059L11.882 4H4.118ZM2.5 3H13.5V2H2.5V3Z"
                  fill="#FF0000" />
              </svg>
            </button>
          </form>
        </div>
      </div>

      <!-- Seção de informações do aluno -->
      <div class="flex flex-col gap-6 md:flex-row">
        <!-- Foto do aluno -->
        <div class="md:w-1/4">
          <div class="relative h-48 w-48 overflow-hidden rounded-lg border-2 border-gray-200">
            @if ($aluno->foto_src)
              <img src="{{ asset('storage/' . $aluno->foto_src) }}" alt="Foto do aluno"
                class="h-full w-full object-cover">
            @else
              <div class="flex h-full w-full items-center justify-center bg-gray-100 text-gray-400">
                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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

          @if ($aluno->data_nascimento)
            <div>
              <label class="text-sm font-medium text-gray-500">Data de Nascimento</label>
              <p class="mt-1 text-gray-600">
                {{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}
              </p>
            </div>
          @endif

          <div>
            <label class="text-sm font-medium text-gray-500">Status</label>
            <p class="mt-1">
              <span
                class="{{ $aluno->concluido ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                {{ $aluno->concluido ? 'Concluído' : 'Em andamento' }}
              </span>
            </p>
            <p class="mt-1">
              <span
                class="{{ $aluno->estaAprovado() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                {{ $aluno->estaAprovado() ? 'Aprovado' : 'Andamento' }}
              </span>
            </p>
          </div>

          <button class="rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700">
            <a href="{{ route('professor.alunos.relatorio.exportar', ['id' => $aluno->id]) }}">Gerar Relatório Aluno</a>
          </button>

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

      <!-- Botão de voltar -->
      <div class="mt-8">
        <a href="{{ url()->previous() }}"
          class="inline-flex items-center rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Voltar
        </a>
      </div>
    </div>
  </div>
@endsection
