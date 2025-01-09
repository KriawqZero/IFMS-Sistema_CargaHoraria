<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificadoController extends Controller
{
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
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Salvar o arquivo no storage
        $filePath = $request->file('arquivo')->store('certificados', 'public');

        // Criar o certificado
        Certificado::create([
            'aluno_id' => auth('aluno')->id(), // Supondo que o aluno está autenticado
            'tipo' => $request->input('tipo'),
            'observacao' => $request->input('observacao'),
            'src' => $filePath,
        ]);

        return redirect()->route('certificados.index')->with('success', 'Certificado enviado com sucesso!');
    }

    // Excluir um certificado
    public function destroy($id) {
        $certificado = Certificado::findOrFail($id);

        // Verificar se o certificado pertence ao aluno autenticado
        if ($certificado->aluno_id !== auth('aluno')->id()) {
            return redirect()->route('certificados.index')->with('error', 'Você não tem permissão para excluir este certificado.');
        }

        // Remover o arquivo do storage
        Storage::disk('public')->delete($certificado->src);

        // Marcar o certificado como deletado
        $certificado->delete();

        return redirect()->route('certificados.index')->with('success', 'Certificado excluído com sucesso!');
    }
}

