<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Aluno;
use App\Models\Turma;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
    */
    protected $model = Aluno::class;

    public function definition() {
        return [
            'cpf' => $this->faker->numerify('###########'),
            'nome' => $this->faker->firstName() . " " . $this->faker->lastName(),
            'data_nascimento' => $this->faker->date(),
            'turma_id' => Turma::inRandomOrder()->first()->id, // Gera um código de turma aleatório a partir das turmas existentes
        ];
    }
}
