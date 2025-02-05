<?php
namespace App\Http\Services\Professor;

use App\Models\Aluno;
use App\Models\Professor;

class AlunoService {
    /**
     * Obtém um aluno pelo ID
     *
     * @param  int  $id
     * @return \App\Models\Aluno
     */
    public function getAluno(int $id): Aluno {
        return Aluno::findOrFail($id);
    }

    /**
     * Cadastra um novo aluno
     *
     * @param  array  $input
     * @return \App\Models\Aluno
     */
    public function store(string $nome, string $cpf, string|null $date, int|null $id_turma): bool{
        try {
            Aluno::create([
                'nome' => $nome,
                'cpf' => $cpf,
                'data_nascimento' => $date,
                'turma_id' => $id_turma
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Obtém alunos filtrados
     *
     * @param  Professor  $professor
     * @param  array  $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAlunosFiltrados(Professor $professor, array $filters, int $perPage = 10) {
        // Se o cargo do professor não for 'professor', retorna todos os alunos
        if ($professor->cargo !== 'professor') {
            $query = Aluno::query();
        } else {
            // Caso contrário, filtra os alunos pelas turmas do professor
            $turmas = $professor->turmas;
            $query = Aluno::whereHas('turma', function($q) use ($turmas) {
                $q->whereIn('id', $turmas->pluck('id'));
            });
        }

        // Aplica os filtros adicionais
        $query->with('turma') // Carrega a relação "turma" para evitar queries adicionais
            ->when($filters['turma'] !== 'todas', function($q) use ($filters) {
                $q->whereHas('turma', function($q) use ($filters) {
                    $q->where('codigo', $filters['turma']);
                });
            })->when($filters['aluno_id'], function($q, $id) {
                $q->where('id', $id);
            })->when($filters['pesquisa'], function($q, $pesquisa) {
                $q->where(function($q) use ($pesquisa) {
                    $q->where('nome', 'like', "%$pesquisa%")
                        ->orWhere('cpf', 'like', "%$pesquisa%");
                });
            })->orderBy('nome');

        return $query->paginate($perPage)->appends($filters);
    }
}
