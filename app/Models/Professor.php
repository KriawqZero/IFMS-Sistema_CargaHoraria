<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model {
    use HasFactory;

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
