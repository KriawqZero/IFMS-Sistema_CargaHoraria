@props([
    'certificados',
    'colunas' => [
        'categoria',
        'titulo',
        'data_enviada',
        'comprovante',
        'observacao',
        'data_constante',
        'status',
        'carga_horaria',
        'acoes',
    ],
])

<div
    {{ $attributes->merge(['class' => 'align-middle inline-block min-w-full overflow-hidden rounded-3xl border-b border-gray-200']) }}>
    <table class="min-w-full">
        <thead class="hidden md:table-header-group">
            <tr>
                @if (in_array('categoria', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        categoria</th>
                @endif
                @if (in_array('titulo', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Título</th>
                @endif
                @if (in_array('data_enviada', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Data Enviada</th>
                @endif
                @if (in_array('comprovante', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Comprovante</th>
                @endif
                @if (in_array('observacao', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Observação</th>
                @endif
                @if (in_array('data_constante', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Data Constante</th>
                @endif
                @if (in_array('status', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Status</th>
                @endif
                @if (in_array('carga_horaria', $colunas))
                    <th
                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                        Carga Horária</th>
                @endif
                @if (in_array('acoes', $colunas))
                    <th class="border-b border-gray-200 bg-gray-50 px-6 py-3"></th>
                @endif
            </tr>
        </thead>
        <tbody class="hidden bg-white md:table-row-group">
            @forelse ($certificados as $certificado)
                <x-aluno::certificados-table-row :certificado="$certificado" :colunas="$colunas" />
            @empty
                <tr>
                    <td colspan="{{ count($colunas) }}" class="py-4 text-center text-gray-500">
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
                    <td class="py-4 text-center text-gray-500">
                        Nenhum certificado encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
