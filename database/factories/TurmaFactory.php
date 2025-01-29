<?php
namespace Database\Factories;

use App\Models\Turma;
use App\Models\Professor;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class TurmaFactory extends Factory {
    protected $model = Turma::class;

    public function definition() {
        $turnos = ['10', '20', '30']; // manhã, tarde, noite
        $cursos = ['2', '7']; // informática e metalurgia
        $sala = str_pad($this->faker->numberBetween(1, 50), 2, '0', STR_PAD_LEFT); // Sala de 1 até 99

        $turno = $this->faker->randomElement($turnos);
        $curso = $this->faker->randomElement($cursos);

        $carga_horaria_minimas = [
            125, 50,
        ];

        $tecnico = Curso::inrandomOrder()->first()->id; // Seleciona um curso aleatório

        $professor_id = Professor::where('cargo', 'professor')->inRandomOrder()->first()->id; // Seleciona um professor aleatório
        return [
            'codigo' => $turno . $curso . $sala, // Gera o código da turma
            'curso_id' => $tecnico,
            'carga_horaria_minima' => $this->faker->randomElement($carga_horaria_minimas),
            'professor_id' => $professor_id, // Seleciona um professor aleatório
        ];
    }
}

