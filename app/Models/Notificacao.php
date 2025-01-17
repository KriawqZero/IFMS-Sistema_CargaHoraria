<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacao extends Model {
    use HasFactory;

    protected $table = 'notificacoes';

    protected $fillable = [
        'receptor_tipo',
        'receptor_id',
        'mensagem',
        'certificado_id',
        'lida'
    ];

    public function receptor() {
        return $this->morphTo(null, 'receptor_tipo', 'receptor_id');
    }

    public function certificado() {
        return $this->belongsTo(Certificado::class);
    }
}
