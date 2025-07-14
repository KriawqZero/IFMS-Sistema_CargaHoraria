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
            'nome' => 'Lucas Roberto',
            'senha' => Hash::make('123456'),
            'cargo' => 'professor',
        ]);

        Professor::create([
            'nome' => 'Afranio Araújo',
            'senha' => Hash::make('123456'),
            'cargo' => 'coordenador',
        ]);

        Curso::factory(2)->create();

        Turma::factory(3)->create();
        
        // Alunos fictícios para apresentação do TCC
        Aluno::create([
            'cpf' => '00000000000',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 1,
        ]);

        Aluno::create([
            'nome' => 'Maria Oliveira',
            'cpf' => '11111111111',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 1,
        ]);
        
        Aluno::create([
            'nome' => 'Pedro Santos',
            'cpf' => '22222222222',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 2,
        ]);
        
        Aluno::create([
            'nome' => 'Ana Costa',
            'cpf' => '33333333333',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 3,
        ]);
        
        Aluno::create([
            'nome' => 'Lucas Pereira',
            'cpf' => '44444444444',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 4,
        ]);
        
        Aluno::create([
            'nome' => 'Carla Rodrigues',
            'cpf' => '55555555555',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 5,
        ]);
        
        Aluno::create([
            'nome' => 'Marcos Almeida',
            'cpf' => '66666666666',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 6,
        ]);
        
        Aluno::create([
            'nome' => 'Fernanda Lima',
            'cpf' => '77777777777',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 7,
        ]);
        
        Aluno::create([
            'nome' => 'Rafael Martins',
            'cpf' => '88888888888',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 8,
        ]);
        
        Aluno::create([
            'nome' => 'Juliana Rocha',
            'cpf' => '99999999999',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 9,
        ]);
        
        Aluno::create([
            'nome' => 'Cauã Maciel',
            'cpf' => '00000000000',
            'foto_src' => 'default-profile.svg',
            'turma_id' => 10,
        ]);


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

        Certificado::factory(60)->create();
    }
}
