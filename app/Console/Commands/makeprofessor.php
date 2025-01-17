<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use App\Models\Professor;

class makeprofessor extends Command {
    protected $signature = 'ifms:makeprofessor';

    protected $description = 'Cria um novo professor no sistema';

    public function handle() {
        $nomeCompleto = $this->ask('Qual será o nome completo do professor?');

        // Verifica se o nome completo contém pelo menos duas palavras
        $nomePartes = explode(' ', $nomeCompleto);
        if (count($nomePartes) < 2) {
            $this->error('O nome completo deve incluir pelo menos um nome e um sobrenome.');
            return;
        }

        // Extrai o primeiro e o último nome
        $primeiroNome = strtolower($nomePartes[0]);
        $ultimoNome = strtolower(end($nomePartes));

        // Gera o login no formato primeiro.ultimo
        $login = "{$primeiroNome}.{$ultimoNome}";

        $senha = $this->secret('Qual será a senha do professor?');

        // Cria o professor no banco de dados
        Professor::create([
            'nome' => $nomeCompleto,
            'senha' => Hash::make($senha),
        ]);

        $this->info("Professor criado com sucesso!");
        $this->info("Login: {$login}");
        $this->info("Senha: {$senha}");
        $this->info("NÃO SE ESQUEÇA DO LOGIN!!");
    }
}
