<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'certificados';

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
