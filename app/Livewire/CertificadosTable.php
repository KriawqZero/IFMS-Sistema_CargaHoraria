<?php

namespace App\Livewire;

use App\Models\Certificado;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CertificadosTable extends Component {
    use WithPagination;

    public $perPage = 10; // Itens por página
    public $page = 1;

    protected $queryString = ['page', 'perPage'];

    // Reagir às mudanças na propriedade `perPage`
    function updatedPerPage($value) {
        // Reinicia a paginação ao mudar a quantidade por página
        $this->resetPage();
    }

    public function render() {

        return view('livewire.certificados-table', [
            'certificados' => auth('aluno')->user()
            ->certificados()
            ->latest()
            ->paginate($this->perPage),
        ]);
    }
}

