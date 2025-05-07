<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Http\Controllers\Controller;
use App\Http\Services\Professor\TurmaService;
use DateTime;

class CsvController extends Controller {
    /**
     * Construtor do controlador
     * 
     * @param TurmaService $turmaService Serviço para gerenciamento de turmas
     */
    public function __construct(
        private TurmaService $turmaService
    ) { }

    /**
     * Exibe o formulário para upload de CSV
     * 
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('professor.cadastrar_alunos', [
            'titulo' => "Cadastrar alunos",
            'turmas' => $this->turmaService->getAllTurmas(),
        ]);
    }

    /**
     * Processa os dados do CSV e salva os alunos
     * 
     * @param Request $request Requisição HTTP
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        // Validações da requisição
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
        $successCount = 0;

        // Se houver cabeçalho, remova a primeira linha
        if (count($rows) > 0 && (
            stripos($rows[0], 'cpf') !== false || 
            stripos($rows[0], 'data') !== false ||
            stripos($rows[0], 'nascimento') !== false
        )) {
            array_shift($rows);
        }

        foreach ($rows as $index => $row) {
            // Pular linhas vazias
            $row = trim($row);
            if (empty($row)) continue;

            // Dividir a linha em colunas (CPF e Data de Nascimento)
            // Suporta tanto vírgula (padrão CSV) quanto ponto e vírgula (comum em Excel pt-BR)
            $columns = preg_split('/[,;]/', $row);
            
            // Processar o CPF
            $cpf = isset($columns[0]) ? trim($columns[0]) : '';
            
            // Verificar se a data de nascimento está presente
            if (!isset($columns[1]) || empty(trim($columns[1]))) {
                $errors[] = "Linha " . ($index + 1) . ": Data de nascimento é obrigatória.";
                continue;
            }

            // Processar a data de nascimento
            $dataNascimento = $this->processarDataNascimento(trim($columns[1]), $index, $errors);
            if (!$dataNascimento) {
                continue; // O erro já foi adicionado no método processarDataNascimento
            }

            // Validar CPF
            if (!$this->validarCPF($cpf)) {
                $errors[] = "Linha " . ($index + 1) . ": CPF inválido ou formato incorreto (deve ser XXX.XXX.XXX-XX).";
                continue;
            }

            // Remover caracteres não numéricos do CPF
            $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);

            // Dados para criar/atualizar o aluno
            $dadosAluno = [
                'turma_id' => $turma->id,
                'data_nascimento' => $dataNascimento,
            ];

            // Criar ou atualizar aluno
            try {
                Aluno::updateOrCreate(
                    ['cpf' => $cpfLimpo],
                    $dadosAluno
                );
                $successCount++;
            } catch (\Exception $e) {
                $errors[] = "Linha " . ($index + 1) . ": Erro ao salvar aluno - " . $e->getMessage();
            }
        }

        // Retornar com erros (se houver) ou mensagem de sucesso
        if (!empty($errors)) {
            $mensagemParcial = $successCount > 0 
                ? $successCount . " aluno(s) cadastrado(s) com sucesso. " 
                : "";
                
            return back()
                ->withErrors($errors)
                ->with('warning', $mensagemParcial . 'Alguns registros apresentaram problemas.');
        }

        return back()->with('success', $successCount . ' aluno(s) cadastrado(s) com sucesso!');
    }

    /**
     * Valida o formato do CPF
     * 
     * @param string $cpf CPF a ser validado
     * @return bool
     */
    private function validarCPF(string $cpf): bool
    {
        // Verifica se está no formato XXX.XXX.XXX-XX ou se é uma sequência de 11 dígitos
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf) || 
               preg_match('/^\d{11}$/', $cpf);
    }

    /**
     * Processa diferentes formatos de data e converte para o formato SQL (Y-m-d)
     * 
     * @param string $data Data a ser processada
     * @param int $index Índice da linha para mensagem de erro
     * @param array &$errors Array de erros por referência
     * @return string|null Data no formato SQL ou null se inválida
     */
    private function processarDataNascimento(string $data, int $index, array &$errors): ?string
    {
        // Formatos de data comuns no Excel
        $formatos = [
            'd/m/Y', // 31/12/2000
            'd-m-Y', // 31-12-2000
            'Y-m-d', // 2000-12-31 (formato SQL/ISO)
            'Y/m/d', // 2000/12/31
            'd.m.Y', // 31.12.2000
        ];

        // Tentar cada formato
        foreach ($formatos as $formato) {
            $data = trim($data);
            $date = DateTime::createFromFormat($formato, $data);
            
            // Verificar se a data é válida
            if ($date && $date->format($formato) == $data) {
                return $date->format('Y-m-d'); // Retorna no formato SQL
            }
        }
        
        // Se chegou aqui, a data é inválida
        $errors[] = "Linha " . ($index + 1) . ": Data de nascimento inválida ou formato não reconhecido.";
        return null;
    }
}
