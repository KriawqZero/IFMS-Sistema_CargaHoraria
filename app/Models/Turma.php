<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model {
    use HasFactory;

    protected $table = 'turmas';

    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo',
        'professor_id'
    ];

    public function professor() {
        return $this->belongsTo(Professor::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class, 'codigo_turma', 'codigo');
    }
}
