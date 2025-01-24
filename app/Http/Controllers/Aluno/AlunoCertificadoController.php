<?php

namespace App\Http\Controllers\Aluno;

use App\Models\Certificado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificadoRequest;
use App\Models\Notificacao;
use App\Notifications\AlunoEnviouCertificado;

class AlunoCertificadoController extends Controller {
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
                return $query->where('observacao', 'like', '%' . $search . '%');
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
        ]);
    }

    // Armazenar o certificado
    public function store(StoreCertificadoRequest $request) {
        $input = $request->validated();

        /** @var \App\Models\Aluno $aluno */
        $aluno = auth('aluno')->user();

        // Salvar o arquivo no storage
        $filePath = $input['arquivo']->store('certificados/' . auth('aluno')->id() ,'public');

        // Criar o certificado
        $certificado = Certificado::create([
            'aluno_id' => auth('aluno')->id(),
            'tipo' => $input['tipo'],
            'titulo' => $input['titulo'],
            'observacao' => $input['observacao'],
            'carga_horaria' => $input['carga_horaria'] * 60,
            'data_constante' => $input['data_do_certificado'],
            'src' => $filePath,
        ]);

        // Notificar o professsor
        if (!$aluno->turma || !$aluno->turma->professor)
            return redirect()->route('aluno.certificados.create')
                ->withErrors('Não foi possível enviar o certificado. O aluno não está matriculado em uma turma.');

        $professor = $aluno->turma->professor;
        $professor->notify(
            new AlunoEnviouCertificado(
                $aluno,
                $certificado,
            ));

        return redirect()->route('aluno.certificados.create')->with('success', 'Certificado enviado com sucesso!');
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

