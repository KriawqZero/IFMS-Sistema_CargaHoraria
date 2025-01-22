<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Certificado;
use App\Models\Professor;
use App\Models\Curso;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        Professor::create([
            'nome' => 'Marcilio Prof',
            'senha' => Hash::make('123456'),
            'cargo' => 'professor',
            'foto_src' => 'default-profile.svg',
        ]);

        Professor::create([
            'nome' => 'Marcilio Coord',
            'senha' => Hash::make('123456'),
            'cargo' => 'coordenador',
            'foto_src' => 'default-profile.svg',
        ]);

        Professor::create([
            'nome' => 'Marcilio Adm',
            'senha' => Hash::make('123456'),
            'cargo' => 'admin',
            'foto_src' => 'default-profile.svg',
        ]);

        /*Professor::factory(3)->create();*/

        Curso::factory(2)->create();
        Turma::factory(5)->create();

        Aluno::create([
            'cpf' => '000.000.000-00',
            'data_nascimento' => '2006-09-01',
            'turma_id' => Turma::inRandomOrder()->first()->id,
            'foto_src' => 'default-profile.svg',
        ]);

        Aluno::factory(10)->create();

        Certificado::factory(100)->create();
    }
}
