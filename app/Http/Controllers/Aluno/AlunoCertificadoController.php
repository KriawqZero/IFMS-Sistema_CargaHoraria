<?php

namespace App\Http\Controllers\Aluno;

use App\Models\Certificado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlunoCertificadoController extends Controller {
    // Exibir a lista de certificados
    public function index() {
        $aluno = auth('aluno')->user(); // Obtenha o aluno autenticado

        return view('aluno.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $aluno->certificados,
        ]);
    }

    // Exibir o formulário de envio de certificado
    public function create() {
        return view('aluno.enviar_certificado', [
            'titulo' => 'Enviar Certificado',
        ]);
    }

    // Armazenar o certificado
    public function store(Request $request) {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'observacao' => 'nullable|string|max:500',
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        // Salvar o arquivo no storage
        $filePath = $request->file('arquivo')->store('certificados/' . auth('aluno')->id() ,'public');

        // Criar o certificado
        Certificado::create([
            'aluno_id' => auth('aluno')->id(),
            'tipo' => $request->input('tipo'),
            'observacao' => $request->input('observacao'),
            'src' => $filePath,
        ]);

        return redirect()->route('aluno.certificados.create')->with('success', 'Certificado enviado com sucesso!');
    }

    // Excluir um certificado
    public function destroy($id) {
        $certificado = Certificado::findOrFail($id);

        // Verificar se o certificado pertence ao aluno autenticado
        if ($certificado->aluno_id !== auth('aluno')->id()) {
            return redirect()->route('aluno.certificados.index')->with('error', 'Você não tem permissão para excluir este certificado.');
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

