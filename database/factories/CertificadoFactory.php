<?php
namespace Database\Factories;

use App\Models\Certificado;
use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificadoFactory extends Factory {
    protected $model = Certificado::class;

    function gerarMultiploAleatorio($multiplo, $max) {
        // Garantir que o máximo seja um múltiplo do número desejado
        $maxMultiplo = intdiv($max, $multiplo) * $multiplo;

        // Gerar um número aleatório dentro do intervalo ajustado
        $random = random_int(1, $maxMultiplo / $multiplo);

        // Retornar o número aleatório vezes o múltiplo
        return $random * $multiplo;
    }

    public function definition() {
        $tipos = [
            'Unidades curriculares optativas/eletivas',
            'Projetos de ensino, pesquisa e extensão',
            'Prática profissional integradora',
            'Práticas desportivas',
            'Práticas artístico-culturais',
        ];

        $tipos_status = ['em_andamento', 'invalido', 'valido'];

        $status = $this->faker->randomElement($tipos_status);

        $carga_horaria = null;
        if($status == 'valido') {
            $carga_horaria = $this->gerarMultiploAleatorio(30, 6000);
        }

        return [
            'tipo' => $this->faker->randomElement($tipos),
            'src' => $this->faker->url(),
            'observacao' => $this->faker->sentence(),
            'carga_horaria' => $carga_horaria, // Carga horária como múltiplos de 30 minutos
            'status' => $status,
            'aluno_id' => Aluno::inRandomOrder()->first()->id, // Seleciona um aluno aleatório
        ];
    }
}

