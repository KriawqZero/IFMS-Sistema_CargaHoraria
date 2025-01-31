<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificadoUpdateRequest;
use App\Http\Services\Professor\CertificadoService;
use App\Http\Services\Professor\NotificacaoService;

class ProfessorCertificadoController extends Controller {
    public function __construct(
        private CertificadoService $certificadoService,
        private NotificacaoService $notificationService
    ) { }

    /**
     * Exibe a lista de certificados com filtros
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $professor = auth('professor')->user();
        $filters = $this->prepareFilters($request);

        // Marcar notificação como lida se houver ID
        if ($request->has('id')) {
            $this->notificationService->markCertificadoNotificationsAsRead(
                $professor,
                $request->input('id')
            );
        }

        return view('professor.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $this->certificadoService->getCertificadosFiltrados($professor, $filters),
            'turmas' => $professor->turmas,
            'categorias' => $this->certificadoService->getTodasCategorias(),
            'filters' => $filters
        ]);
    }

    /**
     * Atualiza um certificado
     *
     * @param CertificadoUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patch(CertificadoUpdateRequest $request, $id) {
        try {
            $certificado = $this->certificadoService->atualizarCertificado(
                $id,
                $request->validated(),
                auth('professor')->user()
            );

            return redirect()
                ->route('professor.certificados.index')
                ->with('success', $certificado->wasChanged()
                    ? 'Certificado atualizado com sucesso!'
                    : 'Nenhuma alteração realizada.');

        } catch (\Exception $e) {
            return redirect()
                ->route('professor.certificados.index')
                ->withErrors('Erro ao atualizar o certificado: ' . $e->getMessage());
        }
    }

    /**
     * Prepara os filtros para a consulta
     *
     * @param Request $request
     * @return array
     */
    private function prepareFilters(Request $request): array {
        return [
            'pesquisa' => $request->input('pesquisa'),
            'turma' => $request->input('turma', 'todas'),
            'status' => $request->input('status', 'pendente'),
            'per_page' => $request->input('per_page', 10),
            'certificado_id' => $request->input('id')
        ];
    }
}
