<div class="space-y-6">
    <!-- Filtros e Controle de Página -->
    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <!-- Formulário para selecionar itens por página -->
        <div class="flex items-center space-x-2">
            <label for="perPage" class="text-sm font-medium text-gray-700">Exibir por página:</label>
            <select wire:model.change="perPage" id="perPage"
                class="block w-24 px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <!--<!-- Campo de busca -->
        <!--<div class="w-full md:w-auto flex items-center space-x-2">-->
        <!--    <label for="search" class="sr-only">Buscar:</label>-->
        <!--    <input-->
        <!--        wire:model.live.debounce.500ms="search"-->
        <!--        id="search"-->
        <!--        type="text"-->
        <!--        placeholder="Buscar certificados..."-->
        <!--        class="block w-full md:w-64 px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"-->
        <!--    />-->
        <!--</div>-->
    </div>

    <!-- Tabela de Certificados -->
    <x-aluno::certificados-table :certificados="$certificados->items()" />

    {{ $certificados->links('pagination::tailwind') }}

</div>

