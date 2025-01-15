<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Aluno;
use App\Http\Controllers\Controller;

class CsvController extends Controller {
    public function create() {
        return view('admin.cadastrar_alunos', [
            'titulo' => "Cadastrar alunos",
        ]);
    }


    public function store(Request $request) {
        // Validações
        $request->validate([
            'csv_text' => 'required|string',
            'turma' => 'required|string|max:255',
        ]);

        // Recuperar dados do request
        $csvText = $request->input('csv_text');
        $codigoTurma =  $request->input('turma');

        // Criar ou obter a turma
        $turma = Turma::where('codigo', $codigoTurma)->first();

        if(!$turma) return back()->withErrors("Turma não existe");

        // Processar o CSV
        $rows = explode("\n", $csvText);
        $errors = [];

        foreach ($rows as $index => $row) {
            $columns = str_getcsv($row, ',');

            if (count($columns) !== 2) {
                $errors[] = "Linha " . ($index + 1) . ": formato inválido.";
                continue;
            }

            $cpf = trim($columns[0]);
            $dataNascimento = trim($columns[1]);

            // Validar CPF e data
            if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
                $errors[] = "Linha " . ($index + 1) . ": CPF inválido.";
                continue;
            }

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataNascimento)) {
                $errors[] = "Linha " . ($index + 1) . ": Data de nascimento inválida.";
                continue;
            }

            // Criar ou atualizar aluno
            Aluno::updateOrCreate(
                ['cpf' => $cpf],
                [
                    'data_nascimento' => $dataNascimento,
                    'codigo_turma' => $turma->codigo
                ]
            );
        }

        if ($errors) {
            return back()->withErrors($errors);
        }

        return back()->with('success', 'CSV processado com sucesso!');
    }
}

