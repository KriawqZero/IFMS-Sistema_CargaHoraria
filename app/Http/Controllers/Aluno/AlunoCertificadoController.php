<?php

namespace App\Http\Controllers\Aluno;

use App\Models\Certificado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificadoRequest;
use App\Models\Categoria;
use App\Notifications\AlunoEnviouCertificado;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AlunoCertificadoController extends Controller {
    public function exportarCertificados() {
        /** @var \App\Models\Aluno $usuarioLogado */
        $usuarioLogado = auth('aluno')->user();

        // Obtém os certificados válidos
        $certificados = $usuarioLogado->certificados()
            ->where('status', 'valido')
            ->get(['categoria', 'titulo', 'carga_horaria']);

        // Calcula o total de carga horária
        $totalCargaHoraria = $certificados->sum('carga_horaria');

        // Cria a planilha
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Define o cabeçalho
        $sheet->setCellValue('A1', 'Aluno');
        $sheet->setCellValue('B1', 'Categoria');
        $sheet->setCellValue('C1', 'Título');
        $sheet->setCellValue('D1', 'Carga Horária');

        // Adiciona os dados
        $linhaAtual = 2;
        foreach ($certificados as $certificado) {
            $sheet->setCellValue("A{$linhaAtual}", $usuarioLogado->nome . ' ' . $usuarioLogado->sobrenome);
            $sheet->setCellValue("B{$linhaAtual}", $certificado->categoria->nome);
            $sheet->setCellValue("C{$linhaAtual}", $certificado->titulo);
            $sheet->setCellValue("D{$linhaAtual}", $certificado->carga_horaria / 60);
            $linhaAtual++;
        }

        // Adiciona o total
        $sheet->setCellValue("C{$linhaAtual}", 'Total:');
        $sheet->setCellValue("D{$linhaAtual}", $totalCargaHoraria / 60);

        // Adiciona a verificação do limite
        $linhaAtual++;
        $limiteHoras = 125;
        $mensagem = $totalCargaHoraria >= $limiteHoras ? 'Bateu o limite de 125 horas!' : 'Não atingiu o limite de 125 horas.';
        $sheet->setCellValue("C{$linhaAtual}", 'Limite:');
        $sheet->setCellValue("D{$linhaAtual}", $mensagem);

        // Formatações
        $sheet->getStyle("A1:D1")->getFont()->setBold(true); // Cabeçalhos em negrito
        $sheet->getStyle("C{$linhaAtual}:D{$linhaAtual}")->getFont()->setBold(true); // Limite destacado
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        // Define o nome do arquivo
        $nomeArquivo = $usuarioLogado->nome . '.certificados_validos.xlsx';

        // Retorna o arquivo como download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $nomeArquivo . '"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // Exibir a lista de certificados
    public function index(Request $request) {
        $alunoId = auth('aluno')->id(); // Obtém o ID do aluno autenticado

        // Recupera os parâmetros da requisição
        $pesquisa = $request->input('pesquisa');
        $perPage = $request->input('per_page'); // Valor padrão: 10 por página

        // Valida o valor de perPage para garantir que é um número permitido
        if(!in_array($perPage, [5, 10, 25, 50])){
            $perPage = 10; // Valor padrão caso o valor fornecido não seja permitido
        }

        // Consulta os certificados com filtragem opcional e paginação
        $certificados = Certificado::where('aluno_id', $alunoId)
            ->when($pesquisa, function($query, $search) {
                return $query->where('titulo', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate($perPage)
            ->appends(['pesquisa' => $pesquisa, 'per_page' => $perPage]); // Mantém os parâmetros na URL das páginas

        return view('aluno.certificados', [
            'titulo' => 'Certificados',
            'alunoId' => $alunoId,
            'certificados' => $certificados,
            'perPage' => $perPage, // Passa o valor de perPage para a view
        ]);
    }

    // Exibir o formulário de envio de certificado
    public function create() {
        return view('aluno.enviar_certificado', [
            'titulo' => 'Enviar Certificado',
            'categorias' => Categoria::all(),
        ]);
    }

    // Armazenar o certificado
    public function store(StoreCertificadoRequest $request) {
        $input = $request->validated();

        /** @var \App\Models\Aluno $aluno */
        $aluno = auth('aluno')->user();

        // Salvar arquivo
        $filePath = $input['arquivo']->store('certificados/' . auth('aluno')->id(), 'public');

        // Converter Hh:mm para minutos
        $partes = explode(':', $input['carga_horaria']);
        $minutos_ch = ($partes[0] * 60) + $partes[1];

        // Criar certificado
        $certificado = Certificado::create([
            'aluno_id' => $aluno->id,
            'titulo' => $input['titulo'],
            'observacao' => $input['observacao'],
            'carga_horaria' => $minutos_ch,
            'data_constante' => $input['data_do_certificado'],
            'src' => $filePath,
            'categoria_id' => $input['categoria_id'],
        ]);

        // Verificar limites da categoria
        $categoria = Categoria::find($input['categoria_id']);
        $horasValidas = $aluno->certificados()
            ->where('categoria_id', $input['categoria_id'])
            ->where('status', 'valido')
            ->sum('carga_horaria') / 60;

        $totalPotencial = $horasValidas + ($minutos_ch / 60);

        // Notificação para o professor
        if ($aluno->turma?->professor) {
            $aluno->turma->professor->notify(new AlunoEnviouCertificado($aluno, $certificado));
        }


        if ($totalPotencial > $categoria->limite_horas) {
            $excedente = $totalPotencial - $categoria->limite_horas;
            return redirect()->route('aluno.certificados.create')
                ->with('info',
                    "Certificado enviado mas atenção! O limite de {$categoria->limite_horas}h para {$categoria->nome}
                    será excedido em {$excedente}h caso este certificado seja aprovado.");
        }

        return redirect()->route('aluno.certificados.create')
            ->with('success', 'Certificado enviado com sucesso!');
    }

    // Excluir um certificado
    public function destroy($id) {
        $certificado = Certificado::findOrFail($id);

        // Verificar se o certificado pertence ao aluno autenticado
        if ($certificado->aluno_id !== auth('aluno')->id()) {
            return redirect()->route('aluno.certificados.index')->with('error', 'Você não tem permissão para excluir este certificado.');
        }

        if ($certificado->validado) {
            return redirect()->route('aluno.certificados.index')->with('error', 'Certificado validado não pode ser excluído.');
        }

        // Remover o arquivo do storage
        /*Storage::disk('public')->delete($certificado->src);*/

        // Marcar o certificado como deletado
        $certificado->delete();

        return redirect()
            ->route('aluno.certificados.index')
            ->with('success', 'Certificado excluído com sucesso!');
    }
}

