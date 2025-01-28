<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'certificados';
    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'src',
        'observacao',
        'carga_horaria',
        'status',
        'data_constante',
        'categoria_id',
        'aluno_id',
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    // #### ACESSORS ####
    public function getSrcUrlAttribute() {
        return $this->src ? asset('storage/' . $this->src) : null;
    }
    // ### FIM ACESSORS ###

    public function formatStatus(): String {
        $status = $this->status;
        if($status == 'pendente')
            return 'Pendente';

        else if($status == 'valido')
            return 'Válido';

        return 'Inválido';
    }
}
