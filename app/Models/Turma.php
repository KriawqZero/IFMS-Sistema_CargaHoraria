<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model {
    use HasFactory;

    protected $table = 'turmas';

    protected $fillable = [
        'codigo',
        'curso',
        'professor_id'
    ];

    public function professor() {
        return $this->belongsTo(Professor::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }

    public function listarTodosCertificados() {
        return $this->alunos->map(function($aluno) {
            return $aluno->certificados;
        })->latest();
    }
}
