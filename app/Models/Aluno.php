<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model implements AuthenticatableContract {
    use HasFactory, SoftDeletes, Authenticatable;

    // ####### PROPRIEDADES #######
    protected $table = 'alunos';

    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento',
        'codigo_turma',
    ];
    // ####### FIM PROPRIEDADES #######



    // ####### RELACIONAMENTOS #######
    public function turma() {
        return $this->belongsTo(Turma::class, 'codigo_turma', 'codigo');
    }

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }
    // ####### FIM RELACIONAMENTOS #######



    // ####### ACESSORS #######
    public function getProfessorAttribute() {
        if($this->turma && $this->turma->professor) {
            return $this->turma->professor->nome;
        }

        return null;
    }

    public function getNomeCompletoAttribute() {
        $nomeArray = explode(' ', $this->nome);
        $primeiroNome = $nomeArray[0];
        $ultimoNome = end($nomeArray);
        $nomeCompleto = ucfirst($primeiroNome) . ' ' . ucfirst($ultimoNome);
        return $nomeCompleto;
    }

    public function getCursoAttribute() {
        if(!$this->codigo_turma) return 'Ainda não designado';

        $codigo_curso = $this->codigo_turma[2];

        if($codigo_curso == 2) return 'Informática';
        else if($codigo_curso == 7) return 'Metalurgia';

        return null;
    }

    public function getCertificadosAttribute() {
        return $this->certificados()->latest()->get();
    }
    // ####### FIM ACESSORS #######



    // ####### MÉTODOS #######
    public function limitesCargaHoraria() {
        return [
            'Unidades curriculares optativas/eletivas' => 120,
            'Projetos de ensino, pesquisa e extensão' => 80,
            'Prática profissional integrada' => 80,
            'Práticas desportivas' => 80,
            'Práticas artístico-culturais' => 80,
        ];
    }

    public function cargaHorariaTotal() {
        return $this->certificados->sum('carga_horaria');
    }

    public function cargaHorariaPorTipo() {
        return $this->certificados->groupBy('tipo')->map(function ($certificados) {
            return $certificados->sum('carga_horaria');
        });
    }

    public function maxCargaHoraria() {
        return array_sum($this->limitesCargaHoraria());
    }
    // ####### FIM MÉTODOS #######
}

