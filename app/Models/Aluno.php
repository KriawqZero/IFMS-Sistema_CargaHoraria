<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model implements AuthenticatableContract {
    use HasFactory, SoftDeletes, Authenticatable;

    protected $table = 'alunos';

    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento',
        'codigo_turma',
    ];

    public function turma() {
        return $this->belongsTo(Turma::class, 'codigo_turma', 'codigo');
    }

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }
}
