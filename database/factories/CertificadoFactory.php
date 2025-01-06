<?php
namespace Database\Factories;

use App\Models\Certificado;
use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificadoFactory extends Factory {
    protected $model = Certificado::class;

    public function definition() {
        $tipos = [
            'Unidades curriculares optativas/eletivas',
            'Projetos de ensino, pesquisa e extensão',
            'Prática profissional integradora',
            'Práticas desportivas',
            'Práticas artístico-culturais',
        ];

        $status = ['em_andamento', 'nao_validado', 'validado'];

        return [
            'tipo' => $this->faker->randomElement($tipos),
            'src' => $this->faker->url(),
            'observacao' => $this->faker->sentence(),
            'carga_horaria' => $this->faker->randomElement([60, 120, 180, 240]), // Carga horária como múltiplos de 30 minutos
            'status' => $this->faker->randomElement($status),
            'aluno_id' => Aluno::inRandomOrder()->first()->id, // Seleciona um aluno aleatório
        ];
    }
}

