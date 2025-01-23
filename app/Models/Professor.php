<?php

namespace App\Models;

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

    /*public function notificacoes() {*/
    /*    return $this->morphMany(Notificacao::class, 'receptor_tipo', 'receptor_tipo', 'receptor_id');*/
    /*}*/
}
