<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model {
    protected $fillable = [
        'aluno_id',
        'tipo',
        'src',
        'observacao',
        'carga_horaria',
        'status'
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}
