<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    //
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
