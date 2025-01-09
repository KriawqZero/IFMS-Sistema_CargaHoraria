<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model implements AuthenticatableContract {
    use HasFactory, Authenticatable;

    protected $table = 'professores';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'cpf',
    ];

    public function turmas() {
        return $this->hasMany(Turma::class);
    }
}
