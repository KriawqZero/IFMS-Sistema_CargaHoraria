<?php
namespace App\Http\Services\Aluno;

use App\Models\Aluno;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthService {
    public function authenticate(array $credentials, ?string $token): Aluno {
        $this->validateCredentials($credentials);
        $this->validateToken($token);

        $response = json_decode($this->callApi($this->normalizeCpf($credentials['cpf']), $credentials["senha"]));
        //dd(json_decode($response));

        /*$response = $this->makeApiCall(
            $this->normalizeCpf($credentials['cpf']),
            $credentials['senha'],
            $token
        );*/
        $response = (array) $response;
        if($response["status"] == true)
            return $this->updateOrCreateAluno($response);

        else
            throw new \Exception("Usuario ou senha incorretos");
    }

    private function validateCredentials(array $credentials): void {
        $validator = validator($credentials, [
            'cpf' => 'required|string|min:11',
            'senha' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    private function validateToken(?string $token): void {
        if (!$token) {
            throw new \Exception('Permissão negada. Token ausente.');
        }
    }

    private function normalizeCpf(string $cpf): string {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    private function makeApiCall(string $cpf, string $senha, string $token): array {
        $response = Http::withToken($token)
            ->get(config('services.api.url') . '/Aluno/login', [
                'cpf' => $cpf,
                'senha' => $senha
            ]);

        if (!$response->successful()) {
            throw new \Exception('Falha na comunicação com o serviço de autenticação');
        }

        if (!$response->json('valido')) {
            throw new \Exception('CPF ou senha incorretos.');
        }

        return $response->json();
    }

    private function updateOrCreateAluno(array $data): Aluno {
        return Aluno::updateOrCreate(
            ['cpf' => $data['CPF']],
            [
                'nome' => $data['nome'] ?? 'Nome não informado',
                'email' => $data['email'] ?? null,
                'data_nascimento' => $data['data_nascimento'] ?? null,
            ]
        );
    }

    private function callApi(string $user, string $senha){
        $url = 'http://server.nudevcb.ifms.edu.br/api/logando';

        $campos = [
        'usuario' => $user,
        'senha' => $senha
        ];
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ',
            'Accept' => 'application/json',
        ])->post($url, $campos);

        return $response;
    }
}
