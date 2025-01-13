<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Admin;

class makeadmin extends Command {
    protected $signature = 'ifms:makeadmin';

    public function handle() {
        $nome = $this->ask('Qual será o nome do Super Admin?');

        $login = 'super.admin.ifms.' . Str::random(5);

        $senha = $this->ask('Qual será a senha?');

        $admin = Admin::create([
            'nome' => $nome,
            'login' => $login,
            'senha' => bcrypt($senha),
            'is_superadmin' => true,
        ]);

        $this->info("Superadministrador criado com sucesso!");
        $this->info("Login: {$admin->login}");
        $this->info("Senha: {$senha}");
        $this->info("NÃO SE ESQUEÇA DO LOGIN!!");
    }
}
