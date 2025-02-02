<?php
namespace App\Http\Services\Professor;

use App\Models\Categoria;
use App\Models\Certificado;
use App\Models\Professor;
use App\Notifications\ProfessorValidouCertificado;
use Illuminate\Pagination\LengthAwarePaginator;

class CertificadoService {
    public function getCertificadosFiltrados(Professor $professor, array $filters): LengthAwarePaginator {
        return Certificado::query()
            ->with(['aluno.turma'])
            ->when($filters['certificado_id'], fn($q) => $q->where('id', $filters['certificado_id']))
            ->whereHas('aluno', function ($query) use ($professor, $filters) {
                $this->aplicarFiltrosDeAluno($query, $professor, $filters);
            })
            ->latest()
            ->paginate($filters['per_page'])
            ->appends($filters);
    }

    private function aplicarFiltrosDeAluno($query, Professor $professor, array $filters): void {
        $query->whereIn('turma_id', $professor->turmas->pluck('id'))
            ->when($filters['turma'] !== 'todas', fn($q) => $q->where('turma_id', $filters['turma']))
            ->when($filters['status'] !== 'todos', fn($q) => $q->where('status', $this->mapStatus($filters['status'])))
            ->when($filters['pesquisa'], fn($q) => $this->applySearchFilters($q, $filters['pesquisa']));
    }

    private function mapStatus(string $status): string {
        if ($status === 'todos') {
            return ['pendente', 'valido', 'invalido'];
        }

        return $status;
    }

    private function applySearchFilters($query, string $search): void {
        $query->where(function ($q) use ($search) {
            $q->where('nome', 'like', "%$search%")
                ->when(is_numeric($cleanCpf = preg_replace('/[^0-9]/', '', $search)), function ($q) use ($cleanCpf) {
                    $q->orWhere('cpf', 'like', "%$cleanCpf%");
                });
        });
    }

    public function getTodasCategorias(): \Illuminate\Database\Eloquent\Collection {
        return Categoria::all();
    }

    public function atualizarCertificado(int $id, array $data, Professor $professor): Certificado {
        $certificado = Certificado::findOrFail($id);

        if (isset($data['carga_horaria'])) {
            $data['carga_horaria'] = $this->converterHorasPraMinutos($data['carga_horaria']);
        }

        $certificado->update(array_filter($data));

        if (($data['status'] ?? null) === 'valido') {
            $certificado->aluno->notify(
                new ProfessorValidouCertificado($professor, $certificado)
            );
        }

        return $certificado;
    }

    private function converterHorasPraMinutos(string $time): int {
        [$hours, $minutes] = explode(':', $time);
        return ($hours * 60) + $minutes;
    }

    public function getUltimosCertificadosProfessor(Professor $professor, int $perPage = 5): LengthAwarePaginator {
        return Certificado::query()
            ->with(['aluno.turma'])
            ->whereHas('aluno', function ($query) use ($professor) {
                $query->whereIn('turma_id', $professor->turmas->pluck('id'));
            })
            ->latest()
            ->paginate($perPage);
    }
}

