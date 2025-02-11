<?php

namespace App\Http\Controllers\Aluno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificadoRequest;
use App\Http\Services\Aluno\{ CertificadoExportService, CertificadoQueryService, CertificadoStorageService, CertificadoDeleteService };

class AlunoCertificadoController extends Controller {
    public function __construct(
        private CertificadoQueryService $queryService,
        private CertificadoStorageService $storageService,
        private CertificadoDeleteService $deleteService
    ) { }

    public function index(Request $request) {
        $resultado = $this->queryService->listarCertificados(
            auth('aluno')->id(),
            $request->only(['pesquisa', 'per_page', 'id'])
        );

        return view('aluno.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $resultado['certificados'],
            'perPage' => $resultado['per_page']
        ]);
    }

    public function create() {
        return view('aluno.enviar_certificado', [
            'titulo' => 'Enviar Certificado',
            'categorias' => $this->queryService->buscarCategorias()
        ]);
    }

    public function store(StoreCertificadoRequest $request) {
        $resultado = $this->storageService->armazenarCertificado(
            auth('aluno')->user(),
            $request->validated()
        );

        return redirect()->back()
            ->with($resultado['tipo'], $resultado['mensagem']);
    }

    public function destroy($id) {
        $resultado = $this->deleteService->excluirCertificado(
            auth('aluno')->user(),
            $id
        );

        return redirect()->route('aluno.certificados.index')
            ->with($resultado['tipo'], $resultado['mensagem']);
    }
}
