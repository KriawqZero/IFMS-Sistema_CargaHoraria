<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    protected $table = 'categorias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'limite_horas'
    ];

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }
}
