<?php
namespace App\Http\Services\Aluno;

use App\Models\{Aluno, Certificado, Categoria};

class CertificadoStorageService {
    public function armazenarCertificado(Aluno $aluno, array $dados): array {
        $certificado = $this->criarCertificado($aluno, $dados);
        $this->notificarProfessor($aluno, $certificado);

        return $this->verificarLimitesCategoria($aluno, $certificado);
    }

    private function criarCertificado(Aluno $aluno, array $dados): Certificado {
        return Certificado::create([
            'aluno_id' => $aluno->id,
            'titulo' => $dados['titulo'],
            'observacao' => $dados['observacao'],
            'carga_horaria' => $this->converterParaMinutos($dados['carga_horaria']),
            'data_constante' => $dados['data_do_certificado'],
            'src' => $dados['arquivo']->store("certificados/{$aluno->id}", 'public'),
            'categoria_id' => $dados['categoria_id'],
        ]);
    }

    private function converterParaMinutos(string $horas): int {
        [$h, $m] = explode(':', $horas);
        return ($h * 60) + $m;
    }

    private function notificarProfessor(Aluno $aluno, Certificado $certificado): void {
        if ($aluno->turma?->professor) {
            $aluno->turma->professor->notify(
                new \App\Notifications\AlunoEnviouCertificado($aluno, $certificado)
            );
        }
    }

    private function verificarLimitesCategoria(Aluno $aluno, Certificado $certificado): array {
        $categoria = Categoria::find($certificado->categoria_id);

        // Mantendo a lógica original de cálculo
        $horasValidas = $aluno->certificados()
            ->where('categoria_id', $certificado->categoria_id)
            ->where('status', 'valido')
            ->sum('carga_horaria') / 60;

        $totalPotencial = $horasValidas + ($certificado->carga_horaria / 60);

        if ($totalPotencial > $categoria->limite_horas) {
            $excedente = $totalPotencial - $categoria->limite_horas;
            return [
                'tipo' => 'info',
                'mensagem' => "Certificado enviado mas atenção! O limite de {$categoria->limite_horas}h para {$categoria->nome} será excedido em {$excedente}h caso este certificado seja aprovado."
            ];
        }

        return [
            'tipo' => 'success',
            'mensagem' => 'Certificado enviado com sucesso!'
        ];
    }
}
