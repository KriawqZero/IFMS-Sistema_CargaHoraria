<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Http\Controllers\Controller;
use App\Http\Services\Professor\TurmaService;

class CsvController extends Controller {
    public function __construct(
        private TurmaService $turmaService
    ) { }

    public function create() {
        return view('professor.cadastrar_alunos', [
            'titulo' => "Cadastrar alunos",
            'turmas' => $this->turmaService->getAllTurmas(),
        ]);
    }

    public function store(Request $request) {
        // Validações
        $request->validate([
            'csv_text' => 'required|string',
            'id_turma' => 'required|exists:turmas,id',
        ]);

        // Recuperar dados do request
        $csvText = $request->input('csv_text');
        $turmaId = $request->input('id_turma');

        // Obter a turma
        $turma = $this->turmaService->getTurmaPorId($turmaId);

        if (!$turma) {
            return back()->withErrors("Turma não encontrada.");
        }

        // Processar o CSV
        $rows = explode("\n", $csvText);
        $errors = [];

        foreach ($rows as $index => $row) {
            $cpf = trim($row);

            // Validar CPF
            if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
                $errors[] = "Linha " . ($index + 1) . ": CPF inválido.";
                continue;
            }

            $cpf = preg_replace('/[^0-9]/', '', $cpf);

            // Criar ou atualizar aluno
            Aluno::updateOrCreate(
                ['cpf' => $cpf],
                [
                    'turma_id' => $turma->id,
                ]
            );
        }

        if ($errors) {
            return back()->withErrors($errors);
        }

        return back()->with('success', 'Alunos cadastrados com sucesso!');
    }
}
