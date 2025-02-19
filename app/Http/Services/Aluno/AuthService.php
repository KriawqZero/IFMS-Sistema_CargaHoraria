<?php
namespace App\Http\Services\Aluno;

use App\Models\Aluno;
use Illuminate\Support\Facades\Http;

class AuthService {
    public function authenticate(array $credentials): Aluno {
        [$cpf, $senha] = [$this->normalizeCpf($credentials['cpf']), $credentials['senha']];
        $response = $this->callApi($cpf, $senha);

        return $this->updateOrCreateAluno($response);
    }

    private function normalizeCpf(string $cpf): string {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    private function updateOrCreateAluno(array $data): Aluno {
        $cpf = $data['CPF'] ?? $data['cpf'];
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

        if ($response->json('status') == false) {
            throw new \Exception('CPF ou Senha incorretos.');
        }

        return $response->json();
    }
}
