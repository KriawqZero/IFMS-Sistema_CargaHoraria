<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Curso;
use App\Models\Categoria;
use App\Models\Certificado;
use App\Models\Turma;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        Professor::create([
            'nome' => 'Marcilio Prof',
            'senha' => Hash::make('123456'),
            'cargo' => 'professor',
        ]);

        Professor::create([
            'nome' => 'Marcilio Coord',
            'senha' => Hash::make('123456'),
            'cargo' => 'coordenador',
        ]);

        /*Professor::create([*/
        /*    'nome' => 'Alfranio Pedroso Soares',*/
        /*    'senha' => Hash::make('alfranio.soares'),*/
        /*    'cargo' => 'coordenador',*/
        /*]);*/
        /**/
        /*Professor::create([*/
        /*    'nome' => 'Paulo Cesar do Carmo Ribeiro',*/
        /*    'senha' => Hash::make('paulo.ribeiro'),*/
        /*    'cargo' => 'professor',*/
        /*]);*/
        /**/

        Curso::factory(2)->create();

        Turma::factory(5)->create();

        Aluno::create([
            'cpf' => '00000000000',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 1,
        ]);

        Aluno::factory(5)->create();

        Categoria::create([
            'nome' => 'Unidades curriculares optativas/eletivas',
            'limite_horas' => 120,
        ]);

        Categoria::create([
            'nome' => 'Projetos de ensino, pesquisa e extensão',
            'limite_horas' => 80,
        ]);

        Categoria::create([
            'nome' => 'Prática profissional integradora',
            'limite_horas' => 80,
        ]);

        Categoria::create([
            'nome' => 'Práticas desportivas',
            'limite_horas' => 80,
        ]);

        Categoria::create([
            'nome' => 'Práticas artístico-culturais',
            'limite_horas' => 80,
        ]);

        Certificado::factory(20)->create();

    }
}
