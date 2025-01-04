<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Certificado;
use App\Models\Professor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar 10 professores
        Professor::factory(10)->create();

        // Criar 10 turmas
        Turma::factory(10)->create();

        // Criar 20 alunos
        Aluno::factory(20)->create();

        // Criar 15 certificados
        Certificado::factory(15)->create();
    }
}
