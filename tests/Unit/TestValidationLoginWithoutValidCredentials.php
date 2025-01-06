<?php

namespace Tests\Feature;

use App\Models\Aluno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AlunoFeatureTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    public function test_login_validation_fails_with_missing_fields() {
        // Este é um teste unitário, pois está validando um comportamento específico da lógica de validação de login sem envolver outros sistemas.
        $response = $this->post(route('aluno.login.post'), [
            'cpf' => '',
            'senha' => '',
        ]);

        $response->assertSessionHasErrors(['cpf', 'senha']);
    }

    /** @test */
    public function test_aluno_login_with_valid_credentials() {
        // Este é um teste de feature, pois verifica o fluxo completo de login de um aluno com credenciais válidas, incluindo a integração com a API externa.
        Http::fake([
            env('API_URL') . 'Aluno/login' => Http::response([
                'valido' => true,
                'nome' => 'João Silva',
                'email' => 'joao@example.com',
                'data_nascimento' => '2000-01-01',
            ], 200),
        ]);

        $response = $this->post(route('aluno.login.post'), [
            'cpf' => '12345678900',
            'senha' => 'password',
        ]);

        $response->assertRedirect(route('aluno.dashboard'));
        $this->assertAuthenticated();
    }

    /** @test */
    public function test_aluno_login_with_invalid_credentials() {
        // Este é um teste de feature, pois simula o fluxo de login com credenciais inválidas, incluindo a comunicação com a API.
        Http::fake([
            env('API_URL') . 'Aluno/login' => Http::response([
                'valido' => false,
            ], 200),
        ]);

        $response = $this->post(route('aluno.login.post'), [
            'cpf' => '12345678900',
            'senha' => 'wrong_password',
        ]);

        $response->assertSessionHasErrors(['message']);
        $this->assertGuest();
    }

    /** @test */
    public function test_aluno_logout() {
        // Este é um teste de feature, pois valida o comportamento do logout completo, incluindo a redireção e a autenticação.
        $this->actingAs(Aluno::factory()->create());

        $response = $this->get(route('aluno.logout'));

        $response->assertRedirect(route('aluno.login'));
        $this->assertGuest();
    }

    /** @test */
    public function test_aluno_is_created_in_database() {
        // Este é um teste de feature, pois verifica o fluxo de criação de um novo aluno no banco de dados a partir de dados recebidos pela API.
        Http::fake([
            env('API_URL') . 'Aluno/login' => Http::response([
                'valido' => true,
                'nome' => 'Maria Souza',
                'email' => 'maria@example.com',
                'data_nascimento' => '1998-10-10',
            ], 200),
        ]);

        $this->post(route('aluno.login.post'), [
            'cpf' => '98765432100',
            'senha' => 'password',
        ]);

        $this->assertDatabaseHas('alunos', [
            'cpf' => '98765432100',
            'nome' => 'Maria Souza',
        ]);
    }

    /** @test */
    public function test_dashboard_requires_authentication() {
        // Este é um teste de feature, pois verifica a proteção de uma rota contra acessos não autenticados.
        $response = $this->get(route('aluno.dashboard'));

        $response->assertRedirect(route('aluno.login'));
    }

    /** @test */
    public function test_protected_route_requires_jwt() {
        // Este é um teste de feature, pois valida a necessidade de um JWT válido para acessar uma rota protegida.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer invalid_token',
        ])->get(route('aluno.dashboard'));

        $response->assertStatus(403); // Proibido
    }
}

