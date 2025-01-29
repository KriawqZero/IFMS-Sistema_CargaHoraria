<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Certificado;

class ProfessorCertificadoController extends Controller {
    public function index(Request $request) {
        /** @var \App\Models\Professor $professor */
        $professor = auth('professor')->user(); // Obtenha o professor autenticado

        // Obtenha as turmas do professor
        $turmas = $professor->turmas()->get();

        // Parâmetros de filtro e pesquisa
        $pesquisa = $request->input('pesquisa', null);
        $turmaId = $request->input('turma', 'todas');
        $perPage = $request->input('per_page', 10);
        $status = $request->input('status', 'pendentes');
        $certificadoId = $request->input('id', null);

        if($certificadoId && $professor->notifications()->where('data->certificado_id', $certificadoId)->exists()) {
            $professor->notifications()->where('data->certificado_id', $certificadoId)->get()->markAsRead();
        }

        $certificados = Certificado::query()
            ->when($certificadoId, function ($query) use ($certificadoId) {
                $query->where('id', $certificadoId); // Filtra por ID do certificado, se fornecido
            })
            ->whereHas('aluno', function ($query) use ($turmas, $status, $pesquisa, $turmaId) {
                $query->whereIn('turma_id', $turmas->pluck('id')) // Filtra pelas turmas do professor
                ->when($pesquisa, function ($query, $pesquisa) {
                    $query->where('nome', 'like', '%' . $pesquisa . '%'); // Adiciona a pesquisa por nome do aluno, se fornecida
                })
                ->when($turmaId && $turmaId !== 'todas', function ($query) use ($turmaId) {
                    $query->where('turma_id', $turmaId); // Filtra por turma, se fornecida
                })->when($status === 'pendentes', function ($query) {
                    $query->where('status', 'pendente'); // Filtra por certificados pendentes
                })->when($status === 'validos', function ($query) {
                    $query->where('status', 'valido'); // Filtra por certificados validados
                })->when($status === 'invalidos', function ($query) {
                    $query->where('status', 'invalido'); // Filtra por certificados invalidados
                })->when($status === 'todos', function ($query) {
                    $query->whereIn('status', ['pendente', 'valido', 'invalido']); // Filtra por todos os certificados
                });
            })
            ->with(['aluno.turma']) // Carrega as relações aluno e turma
            ->latest() // Ordena por data de criação
            ->paginate($perPage)
            ->appends($request->all()); // Mantém os parâmetros na URL das páginas

        return view('professor.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $certificados,
            'turmas' => $turmas,
            'pesquisa' => $pesquisa,
            'turma' => $turmaId,
            'per_page' => $perPage,
            'categorias' => Categoria::all(),
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


        // Verifica se há dados para atualizar antes de chamar o método update
        if (!empty(array_filter(array_diff_key($atualizacao, ['status' => true])))) {
            $certificado->update($atualizacao);

            return redirect()
                ->route('professor.certificados.index')
                ->with('success', 'Certificado atualizado com sucesso!');
        }

        // Retorna uma mensagem caso nenhum dado tenha sido enviado
        return redirect()
            ->route('professor.certificados.index')
            ->with('info', 'Nenhum dado enviado para atualizar o certificado.');
    }
}
