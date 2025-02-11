<?php

namespace App\Http\Services\Aluno;

use App\Models\Aluno;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
        $certificados = $aluno->certificados->where('status', 'valido');
        $primeiroCertificado = $certificados->sortBy('data_constante')->first();
        $ultimoCertificado = $certificados->sortByDesc('data_constante')->first();

        return [
            'aluno' => $aluno,
            'certificados' => $certificados,
            'total_horas' => $aluno->cargaHorariaTotal(),
            'data_inicio' => $primeiroCertificado ? $primeiroCertificado->data_constante : 'N/A',
            'data_termino' => $ultimoCertificado ? $ultimoCertificado->data_constante : 'N/A',
            'nome_arquivo' => "{$aluno->nomeCompleto}_certificados.xlsx"
        ];
    }

    private function criarPlanilha(array $dados): Spreadsheet {
        $planilha = new Spreadsheet();
        $folha = $planilha->getActiveSheet();

        // Configurações iniciais
        $folha->setTitle('Certificados');
        $folha->getDefaultColumnDimension()->setWidth(20);

        // Cabeçalho
        $folha->setCellValue('A1', $dados['aluno']->nomeCompleto);
        $folha->mergeCells('A1:D1');

        // Certificados
        $folha->setCellValue('A2', 'Atividade');
        $folha->setCellValue('B2', 'Carga Horária');
        $folha->setCellValue('C2', 'Categoria');
        $folha->setCellValue('D2', 'Data');

        $linha = 3;
        foreach ($dados['certificados'] as $certificado) {
            $folha->setCellValue('A'.$linha, $certificado->titulo);
            $folha->setCellValue('B'.$linha, $this->formatarCargaHoraria($certificado->carga_horaria));
            $folha->setCellValue('C'.$linha, $certificado->categoria->nome);
            $folha->setCellValue('D'.$linha, $certificado->data_constante);
            $linha++;
        }

        // Totais
        $folha->setCellValue('A'.$linha, 'Total de Horas Aproveitadas');
        $folha->setCellValue('B'.$linha, $this->formatarCargaHoraria($dados['total_horas'] * 60));
        $folha->mergeCells('B'.$linha.':D'.$linha);

        $folha->setCellValue('A'.($linha + 1), 'Data de Início');
        $folha->setCellValue('B'.($linha + 1), $dados['data_inicio']);
        $folha->mergeCells('B'.($linha + 1).':D'.($linha + 1));

        $folha->setCellValue('A'.($linha + 2), 'Data de Término');
        $folha->setCellValue('B'.($linha + 2), $dados['data_termino']);
        $folha->mergeCells('B'.($linha + 2).':D'.($linha + 2));

        // Estilos
        $this->aplicarEstilos($folha, $linha + 2);

        return $planilha;
    }

    private function formatarCargaHoraria($minutos): string {
        $horas = intdiv($minutos, 60);
        $minutosRestantes = $minutos % 60;
        return sprintf('%02d:%02d:00', $horas, $minutosRestantes);
    }

    private function aplicarEstilos($folha, $ultimaLinha) {
        // Estilo do cabeçalho
        $folha->getStyle('A1:D1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']]
        ]);

        // Estilo dos títulos das colunas
        $folha->getStyle('A2:D2')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2EFDA']]
        ]);

        // Estilo dos dados
        $folha->getStyle('A4:D'.$ultimaLinha)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]
        ]);

        // Estilo dos totais
        $folha->getStyle('A'.$ultimaLinha.':D'.$ultimaLinha)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFF2CC']]
        ]);
    }
}
