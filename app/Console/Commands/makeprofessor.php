<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use App\Models\Professor;

class makeprofessor extends Command {
    protected $signature = 'ifms:makeprofessor';

    protected $description = 'Cria um novo professor no sistema';

    public function handle() {
        $nome = $this->ask('Qual será o nome do professor?');
        $sobrenome = $this->ask('Qual será o sobrenome do professor?');

        $login = strtolower($nome . '.' . $sobrenome);

        $senha = $this->ask('Qual será a senha do professor?');

        $professor = Professor::create([
            'nome' => ucfirst($nome),
            'sobrenome' => ucfirst($sobrenome),
            'senha' => Hash::make($senha),
        ]);

        $this->info("Professor criado com sucesso!");
        $this->info("Login: {$login}");
        $this->info("Senha: {$senha}");
        $this->info("NÃO SE ESQUEÇA DO LOGIN!!");
    }
}
