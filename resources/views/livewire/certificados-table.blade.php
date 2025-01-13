<div>
    <!-- Formulário para selecionar itens por página -->
    <label for="perPage">Exibir por página:</label>
    <select wire:model="perPage" id="perPage" class="form-select">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

    <x-aluno::certificados-table :certificados="$certificados" />

    <!-- Paginação -->
    {{ $certificados->links() }}
</div>
