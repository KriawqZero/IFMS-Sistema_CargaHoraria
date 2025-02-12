<?php

namespace App\Models;

use App\Enums\CargoEnum;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Professor extends Model implements AuthenticatableContract {
    use HasFactory, Authenticatable, Notifiable;

    protected $table = 'professores';

    protected $fillable = [
        'nome',
        'senha',
        'primeiro_acesso',
        'foto_src',
        'cargo',
    ];

    protected $hidden = [
        'senha',
    ];

    public function turmas() {
        return $this->hasMany(Turma::class);
    }

    public function getNomeCompletoAttribute() {
        $nomeCompleto = explode(' ', $this->nome);
        return $nomeCompleto[0] . ' ' . $nomeCompleto[count($nomeCompleto) - 1];
    }

    public function cargoMenorQue(string $targetCarg): bool {
        $atualCargo = CargoEnum::fromString($this->cargo);
        $targetCargo = CargoEnum::fromString($targetCarg);

        if (!$atualCargo || !$targetCargo) {
            return false; // Se o cargo for inválido, retorna falso
        }

        return $atualCargo->level() < $targetCargo->level();
    }

    public function getCargoEnumAttribute() {
        return CargoEnum::format($this->cargo);
    }

    public function certificadosPendentes() {
        return $this->turmas()->with(['alunos' => function ($query) {
            $query->withCount(['certificados as pendentes' => function ($q) {
                $q->where('status', 'pendente');
            }]);
        }])->get()->flatMap(function ($turma) {
            return $turma->alunos->pluck('pendentes');
        })->sum();
    }

    /*public function notificacoes() {*/
    /*    return $this->morphMany(Notificacao::class, 'receptor_categoria', 'receptor_categoria', 'receptor_id');*/
    /*}*/
}
