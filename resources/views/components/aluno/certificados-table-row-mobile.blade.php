@props(['certificado', 'colunas'])

<tr>
  <td colspan="7" class="px-6 py-8">
    <div x-data="{ open: false }" class="border-b border-gray-200">
      <button @click="open = !open" class="w-full text-left text-lg font-medium text-gray-900">
        Certificado {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y') }}
        <span x-show="!open" class="ml-2">▼</span>
        <span x-show="open" class="ml-2">▲</span>
        @if (in_array('status', $colunas))
            <span
              class="px-2 inline-flex text-right text-xs leading-5 font-semibold rounded-full {{ $certificado->status == 'valido' ? 'bg-green-50 text-green-800' : ($certificado->status == 'pendente' ? 'bg-yellow-50 text-yellow-800' : 'bg-red-50 text-red-800') }}">
              {{ $certificado->formatStatus() }}
            </span>
        @endif
      </button>
      <div x-show="open" class="mt-2 text-base text-gray-900">
        @if (in_array('categoria', $colunas))
          <p><strong>categoria:</strong> {{ $certificado->categoria }}</p>
        @endif
        @if (in_array('titulo', $colunas))
          <p><strong>Título:</strong> {{ $certificado->titulo }}</p>
        @endif
        @if (in_array('data_enviada', $colunas))
          <p><strong>Data Enviada:</strong>
            {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y \à\s H:i:s') }}</p>
        @endif
        @if (in_array('comprovante', $colunas))
          <p><strong>Comprovante:</strong> <a href="{{ $certificado->src_url }}" target="_blank"
              class="text-indigo-600 hover:text-indigo-900">Ver Comprovante</a></p>
        @endif
        @if (in_array('observacao', $colunas))
          <p><strong>Observação:</strong> {{ $certificado->observacao ?? 'Sem observações' }}</p>
        @endif
        @if (in_array('data_constante', $colunas))
          <p><strong>Data Constante:</strong>
            {{ $certificado->data_constante ? \Carbon\Carbon::parse($certificado->data_constante)->format('d/m/Y') : '' }}
          </p>
        @endif
        @if (in_array('carga_horaria', $colunas))
          @php
            if ($certificado->carga_horaria) {
                $horas = number_format($certificado->carga_horaria / 60, 1, ',', '');
            } else {
                $horas = null;
            }
          @endphp
          @if ($horas)
            <p><strong>Carga Horária:</strong> {{ $horas . ' horas' }}</p>
          @endif
        @endif
        @if (in_array('acoes', $colunas) && $certificado->status == 'pendente')
          <div class="py-2">
            <x-aluno::certificados-delete-button :certificadoId="$certificado->id" />
          </div>
        @endif
      </div>
    </div>
  </td>
</tr>
