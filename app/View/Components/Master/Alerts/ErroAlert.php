<?php

namespace App\View\Components\Master\Alerts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErroAlert extends Component {
    /**
     * Create a new component instance.
     */
    public function __construct() {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.master.alerts.erro-alert');
    }
}
