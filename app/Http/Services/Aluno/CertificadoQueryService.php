<?php
namespace App\Http\Services\Aluno;

use App\Models\{Certificado, Categoria};

class CertificadoQueryService {
    public function listarCertificados(int $alunoId, array $filtros): array {
        $perPage = $this->validarItensPorPagina($filtros['per_page'] ?? 10);

        $query = Certificado::where('aluno_id', $alunoId)
            ->when(!empty($filtros['pesquisa']), function ($q) use ($filtros) {
                $q->where('titulo', 'like', '%' . $filtros['pesquisa'] . '%');
            })
            ->when(!empty($filtros['id']), function ($q) use ($filtros) {
                $q->where('id', $filtros['id']);
            })
            ->latest();

        return [
            'certificados' => $query->paginate($perPage),
            'per_page' => $perPage
        ];
    }

    public function buscarCategorias() {
        return Categoria::all();
    }

    private function validarItensPorPagina($valor): int {
        return in_array($valor, [5, 10, 25, 50]) ? (int)$valor : 10;
    }
}
