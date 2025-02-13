<?php
namespace App\Http\Services\Professor;

use App\Models\Aluno;
use App\Models\Professor;
use App\Notifications\AlunoCumpriuHoras;

class NotificacaoService {
    public function enviarEmailAlunoCumpriuHoras(Professor $professor, Aluno $aluno): void {
        $professor->notify(new AlunoCumpriuHoras($aluno));
    }
}
