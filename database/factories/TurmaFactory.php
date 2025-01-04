<?php
namespace Database\Factories;

use App\Models\Turma;
use App\Models\Professor;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TurmaFactory extends Factory
{
    protected $model = Turma::class;

    public function definition()
    {
        $turnos = ['10', '20', '30']; // manhã, tarde, noite
        $cursos = ['2', '7']; // informática e metalurgia
        $sala = str_pad($this->faker->numberBetween(1, 99), 2, '0', STR_PAD_LEFT); // Sala de 1 até 99

        $turno = $this->faker->randomElement($turnos);
        $curso = $this->faker->randomElement($cursos);

        return [
            'codigo' => $turno . $curso . $sala, // Gera o código da turma
            'professor_id' => Professor::inRandomOrder()->first()->id, // Seleciona um professor aleatório
        ];
    }
}

