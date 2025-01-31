<?php
namespace App\Http\Services\Aluno;

use App\Models\Aluno;
use PhpOffice\PhpSpreadsheet\{Spreadsheet, Writer\Xlsx};

class CertificadoExportService {
    public function gerarPlanilha(Aluno $aluno) {
        $dados = $this->coletarDados($aluno);
        $planilha = $this->criarPlanilha($dados);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$dados['nome_arquivo'].'"');

        (new Xlsx($planilha))->save('php://output');
        exit;
    }

    private function coletarDados(Aluno $aluno): array {
        return [
            'aluno' => $aluno,
            'certificados' => $aluno->certificados()->validos()->get(),
            'total_horas' => $aluno->certificados()->validos()->sum('carga_horaria') / 60,
            'nome_arquivo' => "{$aluno->nome}.certificados_validos.xlsx"
        ];
    }

    private function criarPlanilha(array $dados): Spreadsheet {
        $planilha = new Spreadsheet();
        $folha = $planilha->getActiveSheet();

        // Implementar lógica de formatação...

        return $planilha;
    }
}
