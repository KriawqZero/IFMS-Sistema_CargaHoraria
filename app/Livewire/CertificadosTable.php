<?php

namespace App\Livewire;

use App\Models\Certificado;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CertificadosTable extends Component {
    use WithPagination;

    public $perPage = 5; // Itens por página
    public $page = 1;

    // Reagir às mudanças na propriedade `perPage`
    function updatedPerPage($value) {
        // Reinicia a paginação ao mudar a quantidade por página
        $this->resetPage();
    }

    public function render() {
        /** @var \App\Models\Aluno $aluno */
        $aluno = auth('aluno')->user();
        return view('livewire.certificados-table', [
            'certificados' => Certificado::where('aluno_id', $aluno->id)
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}

