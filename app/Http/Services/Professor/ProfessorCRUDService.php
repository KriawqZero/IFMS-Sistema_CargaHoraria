<?php
namespace App\Http\Services\Professor;

use App\Models\Professor;
use Illuminate\Support\Str;

class ProfessorCRUDService {
    /**
     * Lista todos os professores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProfessores() {
        return Professor::where('cargo', '==', 'professor')->latest()->get();
    }

    /**
     * Lista todos os professores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listarProfessores() {
        return Professor::latest()->get();
    }

    /**
     * Encontra um professor
     *
     * @param  int  $id
     * @return Professor
     */
    public function encontrarProfessor($id) {
        return Professor::findOrFail($id);
    }

    /**
     * Cria um professor
     *
     * @param  string  $nome
     * @param  string  $cargo
     * @return array
     */
    public function criarProfessor(string $nome, string $cargo) {
        // Gera a senha automática
        $senhaTexto = $this->gerarSenha($nome);

        $professor = Professor::create([
            'nome' => $nome,
            'senha' => bcrypt($senhaTexto),
            'cargo' => $cargo,
        ]);

        return [
            'professor_id' => $professor->id,
            'senhaTexto' => $senhaTexto
        ];
    }

    /**
     * Atualiza um professor
     *
     * @param  int  $id
     * @param  array  $dados
     * @return Professor
     */
    public function atualizarProfessor($id, array $dados) {
        $professor = Professor::findOrFail($id);

        $professor->update($dados);

        return $professor;
    }

    /**
     * Exclui um professor
     *
     * @param  int  $id
     * @return bool
     */
    public function excluirProfessor($id) {
        $professor = Professor::findOrFail($id);
        return $professor->delete();
    }

    /**
     * Reseta a senha de um professor
     *
     * @param  int  $id
     * @return array
     */
    public function resetarSenha($id) {
        $professor = Professor::findOrFail($id);

        // Gera a senha automática
        $senhaTexto = $this->gerarSenha($professor->nome);

        $this->atualizarProfessor($id, [
            'senha' => bcrypt($senhaTexto),
            'primeiro_acesso' => true
        ]);

        return [
            'senhaTexto' => $senhaTexto
        ];
    }

    private function gerarSenha(string $nome): string {
        $partesNome = explode(' ',  $nome);
        $primeiroNome = Str::lower(Str::ascii($partesNome[0])); // Remove acentos e coloca em minúsculo
        $ultimoNome = Str::lower(Str::ascii(end($partesNome))); // Pega o último nome
        return $primeiroNome . '.' . $ultimoNome;
    }
}
