<?php
namespace App\Http\Services\Aluno;

use App\Models\Aluno;
use Illuminate\Support\Facades\Http;

class AuthService {
    public function authenticate(array $credentials): Aluno {
        [$cpf, $senha] = [$this->normalizeCpf($credentials['cpf']), $credentials['senha']];
        $response = $this->callApi($cpf, $senha);
dd($response);
        return $this->updateOrCreateAluno($response);
    }

    private function normalizeCpf(string $cpf): string {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    private function updateOrCreateAluno(array $data): Aluno {
        $cpf = $data['CPF'] ?? $data['cpf'];
        // Tratamento do nome para capitalização e remoção do sufixo do curso
        $nome = $data['nome'] ?? 'Nome não informado';

        // Verifica se o nome não está vazio
        if ($nome !== 'Nome não informado') {
            // Converte para minúsculo e depois capitaliza cada palavra
            $nome = mb_convert_case(mb_strtolower($nome), MB_CASE_TITLE, 'UTF-8');

            // Remove o último "nome" (curso do aluno) que sempre está no final
            $partes = explode(' ', trim($nome));
            if (count($partes) > 1) {
                // Remove o último elemento (curso)
                array_pop($partes);
                $nome = implode(' ', $partes);
            }

            // Remove espaços extras
            $nome = trim($nome);
        }

        // Atualiza o nome nos dados
        $data['nome'] = $nome;
        return Aluno::updateOrCreate(
            ['cpf' => $cpf],
            [
                'nome' => $data['nome'] ?? 'Nome não informado',
                'email' => $data['email'] ?? null,
                'data_nascimento' => $data['data_nascimento'] ?? null,
            ]
        );
    }

    private function callApi(string $user, string $senha){
        $url = config('services.api.url');

        $campos = [
            'usuario' => $user,
            'senha' => $senha
        ];

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ' . config('services.api.token'),
            'Accept' => 'application/json',
        ])->post($url, $campos);

        if (!$response->successful()) {
            throw new \Exception('Falha na comunicação com o serviço de autenticação');
        }

        if ((isset($response->json()['status']) && $response->json()['status'] == false)
        || (isset($response->json()['status']) && $response->json()['status'] == 'false')) {
            throw new \Exception('CPF ou Senha incorretos.');
        }

        return $response->json();
    }
}
