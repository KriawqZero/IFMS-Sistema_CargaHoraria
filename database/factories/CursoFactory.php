<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cursos = [
            'Técnico em Informática',
            'Técnico em Metalurgia'
        ];

        $siglas = [
            'TecnoINF',
            'TecnoMET'
        ];

        return [
            'nome' => $this->faker->unique()->randomElement($cursos),
            'sigla' => $this->faker->unique()->randomElement($siglas),
        ];
    }
}
