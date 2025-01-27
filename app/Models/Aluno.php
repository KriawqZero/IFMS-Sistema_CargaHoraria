<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Aluno extends Model implements AuthenticatableContract {
    use HasFactory, Authenticatable, Notifiable;

    // ####### PROPRIEDADES #######
    protected $table = 'alunos';

    protected $fillable = [
        'cpf',
        'nome',
        'cpf',
        'data_nascimento',
        'foto_src',
        'id_turma',
    ];
    // ####### FIM PROPRIEDADES #######



    // ####### RELACIONAMENTOS #######
    public function turma() {
        return $this->belongsTo(Turma::class);
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

    public function getProfessorIdAttribute() {
      if($this->turma && $this->turma->professor) {
        return $this->turma->professor->id;
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
        if($this->turma && $this->turma->curso) {
            return $this->turma->curso->nome;
        }

        return null;
    }

    public function getCertificadosAttribute() {
        return $this->certificados()->latest()->get();
    }
    // ####### FIM ACESSORS #######



    // ####### MÉTODOS #######
    public function limitesCargaHorariaPorcategoria() {
        return [
            'Unidades curriculares optativas/eletivas' => 120,
            'Projetos de ensino, pesquisa e extensão' => 80,
            'Prática profissional integrada' => 80,
            'Práticas desportivas' => 80,
            'Práticas artístico-culturais' => 80,
        ];
    }

    public function cargaHorariaTotal() {
        return $this->certificados->where('status', 'valido')->sum('carga_horaria') / 60;
    }

    public function cargaHorariaPorcategoria() {
        return $this->certificados->groupBy('categoria')->map(function ($certificados) {
            return $certificados->where('status', 'valido')->sum('carga_horaria') / 60;
        });
    }

    public function maxCargaHoraria() {
        return $this->turma->carga_horaria_maxima;
    }

    public function paginarCertificados($maxItens = 10) {
        return $this->certificados()->paginate($maxItens);
    }
    // ####### FIM MÉTODOS #######
}

