<?php
namespace App\Http\Services\Professor;

use App\Models\Professor;
use Illuminate\Support\Facades\Hash;

class AuthService {
    /**
     * Autentica o professor
     *
     * @param  string  $login
     * @param  string  $senha
     * @return \App\Models\Professor
     * @throws \Exception
     */
    public function autenticar(string $login, string $senha): Professor {
        $loginParts = explode('.', strtolower($login));

        if (count($loginParts) !== 2) {
            throw new \Exception('Formato de login inválido. Use primeironome.ultimonome.');
        }

        $professor = Professor::whereRaw('LOWER(SUBSTRING_INDEX(nome, " ", 1)) = ?', [$loginParts[0]])
            ->whereRaw('LOWER(SUBSTRING_INDEX(nome, " ", -1)) = ?', [$loginParts[1]])
            ->first();

        if (!$professor || !Hash::check($senha, $professor->senha)) {
            throw new \Exception('Credenciais inválidas.');
        }

        return $professor;
    }

    /**
     * Troca a senha do professor
     *
     * @param  \App\Models\Professor  $professor
     * @param  string  $senha
     * @return \App\Models\Professor
     */
    public function trocarSenha(Professor $professor, string $senha): Professor {
        $professor->update([
            'senha' => Hash::make($senha),
            'primeiro_acesso' => false,
        ]);

        return $professor;
    }
}
