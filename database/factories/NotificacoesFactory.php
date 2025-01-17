<?php

namespace Database\Factories;

use App\Models\Notificacao;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Certificado;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificacoesFactory extends Factory {
    protected $model = Notificacao::class;

    public function definition() {
        // Seleciona aleatoriamente entre Aluno ou Professor como receptor
        $receptorType = $this->faker->randomElement([Aluno::class, Professor::class]);

        // Busca um registro existente no banco para o receptor_id
        $receptor = $receptorType::query()->inRandomOrder()->first();

        if (!$receptor) {
            throw new \Exception("Nenhum registro encontrado na tabela relacionada a {$receptorType}. Crie registros primeiro.");
        }

        // Busca um certificado existente ou define como nulo
        $certificadoId = Certificado::query()->inRandomOrder()->value('id');

        // Define a mensagem com base no tipo de receptor
        if ($receptorType === Aluno::class) {
            $mensagem = sprintf(
                "O professor %s validou/indeferiu seu certificado.",
                Professor::query()->inRandomOrder()->value('nome') ?? 'Desconhecido'
            );
        } else {
            $mensagem = sprintf(
                "O aluno %s enviou um novo certificado.",
                Aluno::query()->inRandomOrder()->value('nome') ?? 'Desconhecido'
            );
        }

        return [
            'receptor_tipo' => $receptorType,
            'receptor_id' => $receptor->id,
            'mensagem' => $mensagem,
            'certificado_id' => $certificadoId, // Pode ser nulo, conforme sua migration
            'lida' => false, // 50% de chance de ser lida
        ];
    }
}

