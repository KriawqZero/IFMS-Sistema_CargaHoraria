<?php

namespace App\View\Components\Aluno;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ModalProgresso extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.aluno.modal-progresso');
    }
}
