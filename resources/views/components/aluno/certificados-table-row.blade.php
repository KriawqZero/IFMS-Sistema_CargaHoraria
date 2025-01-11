@props(['certificado', 'colunas'])

<tr>
  @if (in_array('tipo', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <div class="flex items-center">
        <div class="ml-4">
          <div class="text-sm leading-5 font-medium text-gray-900">
            {{ $certificado->tipo }}
          </div>
        </div>
      </div>
    </td>
  @endif
  @if (in_array('data_enviada', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <div class="text-sm leading-5 text-gray-900">
        {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y \à\s H:i:s') }}
      </div>
    </td>
  @endif
  @if (in_array('comprovante', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <a href="{{ $certificado->src_url }}" target="_blank"
        class="text-indigo-600 hover:text-indigo-900 text-sm leading-5 font-medium">Ver comprovante</a>
    </td>
  @endif
  @if (in_array('observacao', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <div class="text-sm leading-5 text-gray-900">
        {{ $certificado->observacao ?? 'Sem observações' }}
      </div>
    </td>
  @endif
  @if (in_array('status', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $certificado->status == 'validado' ? 'bg-green-50 text-green-800' : ($certificado->status == 'em_andamento' ? 'bg-yellow-50 text-yellow-800' : 'bg-red-50 text-red-800') }}">
        {{ $certificado->formatStatus() }}
      </span>
    </td>
  @endif
  @if (in_array('carga_horaria', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <div class="text-sm leading-5 text-gray-900">
        @php
          if ($certificado->carga_horaria) {
              $horas = number_format($certificado->carga_horaria / 60, 1, ',', '');
          } else {
              $horas = null;
          }
        @endphp
        {{ $horas ? $horas . ' horas' : '' }}
      </div>
    </td>
  @endif
  @if (in_array('acoes', $colunas))
    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
      @if ($certificado->status == 'em_andamento')
        <x-aluno::certificados-delete-button :certificadoId="$certificado->id" />
      @endif
    </td>
  @endif
</tr>
