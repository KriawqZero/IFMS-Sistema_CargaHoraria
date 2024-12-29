<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'nome',
        'turma',
        'cpf'
    ];

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }

}
