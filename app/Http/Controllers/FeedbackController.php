<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FeedbackController extends Controller {
    public function index() {
        return view('reports.enviarFeedback', [
            'titulo' => 'Enviar Feedback'
        ]);
    }

    public function store(Request $request) {
        // Validação dos campos obrigatórios
        $request->validate([
            'tipo' => 'required|in:bug,sugestao',
            'descricao' => 'required|string',
            'anexos.*' => 'nullable|file|max:10240', // Máximo de 10MB por arquivo
        ]);

        try {
            // Preparar os dados para enviar à API
            $data = [
                'tipo' => $request->tipo,
                'descricao' => $request->descricao,
                'prioridade' => $request->tipo === 'bug' ? 'alta' : null,
            ];

            // Preparar os anexos para enviar à API
            $anexos = [];
            if ($request->hasFile('anexos')) {
                foreach ($request->file('anexos') as $anexo) {
                    $anexos[] = [
                        'name' => 'anexos', // Nome do campo esperado pelo Multer
                        'contents' => fopen($anexo->getRealPath(), 'r'),
                        'filename' => $anexo->getClientOriginalName(),
                    ];
                }
            }

            // Fazer a requisição para a API
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])
                ->asMultipart() // Define o tipo de requisição como multipart/form-data
                ->post(config('services.api_feedback.url') . '/feedback', array_merge($data, $anexos)); // Envia dados e anexos

            // Verificar se a requisição foi bem-sucedida
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Feedback enviado com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Erro ao enviar feedback. Tente novamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }
}
