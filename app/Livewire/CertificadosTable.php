<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CertificadosTable extends Component {
    use WithPagination;

    public $certificados; // Propriedade para receber os certificados
    public $perPage = 10; // Número de itens por página (padrão)

    public function mount($certificados) {
        $this->certificados = $certificados;
    }

    public function render() {
        $certificadosPaginados = $this->certificados->paginate($this->perPage);

        return view('livewire.certificados-table', [
            'certificados' => $certificadosPaginados,
        ]);
    }
}
