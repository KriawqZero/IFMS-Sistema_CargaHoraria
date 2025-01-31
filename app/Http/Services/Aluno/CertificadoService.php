<?php
namespace App\Http\Services\Aluno;

use App\Models\Aluno;
use Illuminate\Pagination\LengthAwarePaginator;

class CertificadoService {
    public function getCertificadosAluno(Aluno $aluno, int $perPage = 5): LengthAwarePaginator {
        return $aluno->certificados()
            ->latest()
            ->paginate($perPage);
    }
}
