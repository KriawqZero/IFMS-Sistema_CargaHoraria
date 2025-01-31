<?php
namespace App\Http\Services\Aluno;

use App\Models\{Aluno, Certificado};

class CertificadoDeleteService {
    public function excluirCertificado(Aluno $aluno, int $certificadoId): array {
        $certificado = Certificado::findOrFail($certificadoId);

        $this->validarPermissaoExclusao($aluno, $certificado);
        $this->executarExclusao($certificado);

        return [
            'tipo' => 'success',
            'mensagem' => 'Certificado excluído com sucesso!'
        ];
    }

    private function validarPermissaoExclusao(Aluno $aluno, Certificado $certificado): void {
        if ($certificado->aluno_id !== $aluno->id) {
            abort(403, 'Acesso não autorizado');
        }

        if ($certificado->validado) {
            abort(403, 'Certificados validados não podem ser excluídos');
        }
    }

    private function executarExclusao(Certificado $certificado): void {
        // Implementar lógica de exclusão de arquivo se necessário
        $certificado->delete();
    }
}
