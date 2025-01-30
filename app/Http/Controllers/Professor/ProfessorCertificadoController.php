<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Certificado;
use App\Notifications\ProfessorValidouCertificado;

class ProfessorCertificadoController extends Controller {
    public function index(Request $request) {
        /** @var \App\Models\Professor $professor */
        $professor = auth('professor')->user();
        $turmas = $professor->turmas;

        // Parâmetros de filtro
        $pesquisa = $request->input('pesquisa');
        $turmaId = $request->input('turma', 'todas');
        $status = $request->input('status', 'pendentes');
        $perPage = $request->input('per_page', 10);
        $certificadoId = $request->input('id');

        // Marcar notificação como lida
        if ($certificadoId) {
            $professor->notifications()
                ->where('data->certificado_id', $certificadoId)
                ->get()
                ->markAsRead();
        }

        $certificados = Certificado::query()
            ->when($certificadoId, fn($q) => $q->where('id', $certificadoId))
            ->whereHas('aluno', function ($query) use ($turmas, $status, $pesquisa, $turmaId) {
                $query->whereIn('turma_id', $turmas->pluck('id'))
                    ->when($turmaId !== 'todas', fn($q) => $q->where('turma_id', $turmaId))
                    ->when($status !== 'todos', function ($q) use ($status) {
                        $statusMap = [
                            'pendentes' => 'pendente',
                            'validos' => 'valido',
                            'invalidos' => 'invalido'
                        ];
                        $q->where('status', $statusMap[$status]);
                    })
                    ->when($pesquisa, function ($q) use ($pesquisa) {
                        $q->where(function ($query) use ($pesquisa) {
                            $query->where('nome', 'like', "%$pesquisa%")
                                ->when(is_numeric(str_replace(['.', '-'], '', $pesquisa)), function ($q) use ($pesquisa) {
                                    $q->orWhere('cpf', 'like', '%' . preg_replace('/[^0-9]/', '', $pesquisa) . '%');
                                });
                        });
                    });
            })
            ->with(['aluno.turma'])
            ->latest()
            ->paginate($perPage)
            ->appends($request->query());

        return view('professor.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $certificados,
            'turmas' => $turmas,
            'categorias' => Categoria::all(),
            'pesquisa' => $pesquisa,
            'turma' => $turmaId,
            'per_page' => $perPage,
        ]);
    }

    public function patch(Request $request, $id) {
        // Obtenha o certificado pelo ID
        $certificado = Certificado::findOrFail($id);

        // Validação dos dados recebidos
        $atualizacao = $request->validate([
            'titulo' => 'nullable|string|max:255', // Limite de caracteres para evitar inputs inválidos
            'categoria' => 'nullable|string|max:255',
            'carga_horaria' => 'required|regex:/^\d{1,3}:[0-5]\d$/',
            'status' => 'nullable|in:valido,invalido,pendente',
        ]);

        // Converter Hh:mm para minutos
        $partes = explode(':', $atualizacao['carga_horaria']);
        $minutos_ch = ($partes[0] * 60) + $partes[1];
        $atualizacao['carga_horaria'] = $minutos_ch;

        try {
            // Verifica se há dados para atualizar antes de chamar o método update
            if (!empty(array_filter(array_diff_key($atualizacao, ['status' => true])))) {
                $certificado->update($atualizacao);

                // Retorna uma mensagem de sucesso após a atualização
                if($request->has('status') && $request->input('status') === 'valido')
                    $certificado->aluno->notify(new ProfessorValidouCertificado(auth('professor')->user(), $certificado));

                return redirect()
                    ->route('professor.certificados.index')
                    ->with('success', 'Certificado atualizado com sucesso!');
            }

            // Retorna uma mensagem caso nenhum dado tenha sido enviado
            return redirect()
                ->route('professor.certificados.index')
                ->with('info', 'Nenhum dado enviado para atualizar o certificado.');
        } catch (\Exception $e) {
            // Retorna uma mensagem de erro caso ocorra uma exceção
            return redirect()
                ->route('professor.certificados.index')
                ->withErrors('Erro ao atualizar o certificado, por favor tente novamente.');
        }
    }
}
