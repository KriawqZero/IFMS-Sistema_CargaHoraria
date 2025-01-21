<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model {
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function turmas() {
        return $this->hasMany(Turma::class);
    }
}
