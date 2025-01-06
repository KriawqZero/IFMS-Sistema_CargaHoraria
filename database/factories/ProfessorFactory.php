<?php
namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessorFactory extends Factory {
    protected $model = Professor::class;

    public function definition() {
        return [
            'nome' => $this->faker->firstName(),
            'sobrenome' => $this->faker->lastName(),
            'senha' => $this->faker->password(),
        ];
    }
}

