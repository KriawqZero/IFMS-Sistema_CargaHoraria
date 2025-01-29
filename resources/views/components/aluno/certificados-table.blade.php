@props([
    'certificados',
    'colunas' => ['categoria', 'titulo', 'data_enviada', 'comprovante', 'observacao', 'data_constante', 'status', 'carga_horaria', 'acoes'],
])

<div  {{ $attributes->merge(['class' => "align-middle inline-block min-w-full overflow-hidden rounded-3xl border-b border-gray-200"]) }}>
    <table class="min-w-full">
        <thead class="hidden md:table-header-group">
            <tr>
                @if (in_array('categoria', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">categoria</th>
                @endif
                @if (in_array('titulo', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Título</th>
                @endif
                @if (in_array('data_enviada', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Data Enviada</th>
                @endif
                @if (in_array('comprovante', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Comprovante</th>
                @endif
                @if (in_array('observacao', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Observação</th>
                @endif
                @if (in_array('data_constante', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Data Constante</th>
                @endif
                @if (in_array('status', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                @endif
                @if (in_array('carga_horaria', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Carga Horária</th>
                @endif
                @if (in_array('acoes', $colunas))
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white hidden md:table-row-group">
            @forelse ($certificados as $certificado)
                <x-aluno::certificados-table-row :certificado="$certificado" :colunas="$colunas" />
            @empty
                <tr>
                    <td colspan="{{ count($colunas) }}" class="text-center py-4 text-gray-500">
                        Nenhum certificado encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tbody class="bg-white md:hidden">
            @forelse ($certificados as $certificado)
                <x-aluno::certificados-table-row-mobile :certificado="$certificado" :colunas="$colunas" />
            @empty
                <tr>
                    <td class="text-center py-4 text-gray-500">
                        Nenhum certificado encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

