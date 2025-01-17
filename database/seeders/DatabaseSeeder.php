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
        Professor::factory(3)->create();

        Turma::factory(5)->create();

        Aluno::factory(10)->create();

        Certificado::factory(50)->create();
    }
}
