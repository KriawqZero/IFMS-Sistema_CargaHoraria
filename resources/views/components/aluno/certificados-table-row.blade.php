@props(['certificado', 'colunas'])

<tr>
  @if (in_array('categoria', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <div class="flex items-center">
        <div class="ml-4">
          <div class="text-sm font-medium leading-5 text-gray-900">
            {{ $certificado->categoria->nome }}
          </div>
        </div>
      </div>
    </td>
  @endif
  @if (in_array('titulo', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <div class="text-sm leading-5 text-gray-900">
        {{ $certificado->titulo }}
      </div>
    </td>
  @endif
  @if (in_array('data_enviada', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <div class="text-sm leading-5 text-gray-900">
        {{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y \à\s H:i') }}
      </div>
    </td>
  @endif
  @if (in_array('comprovante', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <a href="{{ $certificado->src_url }}" target="_blank"
        class="text-sm font-medium leading-5 text-indigo-600 hover:text-indigo-900">Ver comprovante</a>
    </td>
  @endif
  @if (in_array('observacao', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <div class="text-sm leading-5 text-gray-900">
        {{ $certificado->observacao }}
      </div>
    </td>
  @endif
  @if (in_array('data_constante', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <div class="text-sm leading-5 text-gray-900">
        {{ $certificado->data_constante ? \Carbon\Carbon::parse($certificado->data_constante)->format('d/m/Y') : '' }}
      </div>
    </td>
  @endif
  @if (in_array('status', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <span
        class="{{ $certificado->status == 'valido' ? 'bg-green-50 text-green-800' : ($certificado->status == 'pendente' ? 'bg-yellow-50 text-yellow-800' : 'bg-red-50 text-red-800') }} inline-flex rounded-full px-2 text-xs font-semibold leading-5">
        {{ $certificado->formatStatus() }}
      </span>
    </td>
  @endif
  @if (in_array('carga_horaria', $colunas))
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4">
      <div class="text-sm leading-5 text-gray-900">
        @php
          if ($certificado->carga_horaria && $certificado->status != 'invalido') {
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
    <td class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 text-right text-sm font-medium leading-5">
      @if ($certificado->status == 'pendente')
        <x-aluno::certificados-delete-button :certificadoId="$certificado->id" />
      @endif
    </td>
  @endif
</tr>
