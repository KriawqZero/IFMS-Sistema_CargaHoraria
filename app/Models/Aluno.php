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
        'data_nascimento',
        'foto_src',
        'concluido',
        'turma_id',
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

    public function getFormatCpfAttribute() {
        $cpf = $this->cpf;
        $cpfFormatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
        return $cpfFormatado;
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
        // Substituir o método hardcoded por consulta dinâmica
    public function categoriasComLimites() {
        return Categoria::all()->keyBy('id');
    }

    // Carga horária total considerando os limites
    public function cargaHorariaTotal() {
        $total = 0;

        foreach ($this->cargaHorariaDetalhadaPorCategoria() as $dados) {
            $total += $dados['aproveitado'];
        }

        return $total;
    }

    // Carga horária por categoria com detalhes
    public function cargaHorariaDetalhadaPorCategoria() {
        $categorias = $this->categoriasComLimites();
        $detalhes = [];

        foreach ($categorias as $categoria) {
            $horasBrutas = $this->certificados
                ->where('categoria_id', $categoria->id)
                ->where('status', 'valido')
                ->sum('carga_horaria') / 60;

            $detalhes[$categoria->nome] = [
                'total' => $horasBrutas,
                'limite' => $categoria->limite_horas,
                'aproveitado' => min($horasBrutas, $categoria->limite_horas)
            ];
        }

        return $detalhes;
    }

    // Verificação de aprovação
    public function estaAprovado() {
        if($this->turma && $this->turma->carga_horaria_minima) {
            return $this->cargaHorariaTotal() >= $this->turma->carga_horaria_minima;
        }

        return false;
        /*if($this->turma && $this->turma->carga_horaria_minima) {*/
        /*    $cg = $this->cargaHorariaTotal() >= $this->turma->carga_horaria_minima;*/
        /*    if($cg) {*/
        /*        $this->concluido = true;*/
        /*        $this->save();*/
        /*        return true;*/
        /*    }*/
        /*    return false;*/
        /*}*/
        /**/
        /*return false;*/
    }

    // Certificados pendentes
    public function certificadosPendentes() {
        return $this->certificados()->where('status', 'pendente')->get()->all();
    }

    public function maxCargaHoraria() {
        if($this->turma && $this->turma->carga_horaria_minima) {
            return $this->turma->carga_horaria_minima;
        }

        return 999;
    }

    public function paginarCertificados($maxItens = 10) {
        return $this->certificados()->paginate($maxItens);
    }
    // ####### FIM MÉTODOS #######
}

