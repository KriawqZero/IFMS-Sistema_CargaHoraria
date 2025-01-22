<?php

use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Certificado;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\expect; // Correção: Importar 'expect' do namespace 'Pest' em vez de 'Pest\Laravel'

// Teste para autenticação de usuários
it('permite login de alunos com credenciais corretas', function () {
    $aluno = Aluno::factory()->create([
        'password' => bcrypt('senha123'),
    ]);

    $response = post('/login', [
        'cpf' => $aluno->cpf,
        'password' => 'senha123',
    ]);

    $response->assertRedirect('/home');
    expect(auth('aluno')->check())->toBeTrue();
});

it('não permite login com credenciais incorretas', function () {
    $aluno = Aluno::factory()->create([
        'password' => bcrypt('senha123'),
    ]);

    $response = post('/login', [
        'cpf' => $aluno->cpf,
        'password' => 'senhaerrada',
    ]);

    $response->assertSessionHasErrors('cpf');
    expect(auth('aluno')->check())->toBeFalse();
});

// Teste para envio de certificados
it('permite que alunos enviem certificados', function () {
    $aluno = Aluno::factory()->create();
    actingAs($aluno, 'aluno');

    $response = post('/certificados', [
        'tipo' => 'Curso',
        'arquivo' => \Illuminate\Http\UploadedFile::fake()->create('certificado.pdf'),
        'observacao' => 'Certificado de teste',
    ]);

    $response->assertRedirect('/certificados');
    expect(Certificado::where('aluno_id', $aluno->id)->exists())->toBeTrue();
});

// Teste para validação de certificados por professores
it('permite que professores validem certificados', function () {
    $professor = Professor::factory()->create();
    actingAs($professor, 'professor');

    $certificado = Certificado::factory()->create([
        'validado' => false,
    ]);

    $response = post("/certificados/{$certificado->id}/validar", [
        'carga_horaria' => 60,
        'validado' => true,
    ]);

    $response->assertRedirect('/certificados');
    $certificado->refresh();

    expect($certificado->validado)->toBeTrue();
    expect($certificado->carga_horaria)->toBe(60);
});

// Teste para exclusão de certificados por alunos e professores
it('permite que alunos excluam certificados em andamento', function () {
    $aluno = Aluno::factory()->create();
    $certificado = Certificado::factory()->create([
        'aluno_id' => $aluno->id,
        'validado' => false,
    ]);

    actingAs($aluno, 'aluno');

    $response = delete("/certificados/{$certificado->id}");

    $response->assertRedirect('/certificados');
    expect(Certificado::find($certificado->id))->toBeNull();
});

it('não permite que alunos excluam certificados já validados', function () {
    $aluno = Aluno::factory()->create();
    $certificado = Certificado::factory()->create([
        'aluno_id' => $aluno->id,
        'status' => 'valido',
    ]);

    actingAs($aluno, 'aluno');

    $response = delete("/certificados/{$certificado->id}");

    $response->assertStatus(403);
    expect(Certificado::find($certificado->id))->not->toBeNull();
});

/*it('permite que professores excluam qualquer certificado', function () {*/
/*    $professor = Professor::factory()->create();*/
/*    $certificado = Certificado::factory()->create();*/

/*    actingAs($professor, 'professor');*/

/*    $response = delete("/certificados/{$certificado->id}");*/

/*    $response->assertRedirect('/certificados');*/
/*    expect(Certificado::find($certificado->id))->toBeNull();*/
/*});*/

/**/
