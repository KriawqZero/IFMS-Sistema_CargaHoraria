<?php
namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessorFactory extends Factory {
    protected $model = Professor::class;

    public function definition() {
        return [
            'nome'  => $this->faker->firstName(),
            'senha' => $this->faker->password(),
            'cargo' => 'professor',
        ];
    }
}

