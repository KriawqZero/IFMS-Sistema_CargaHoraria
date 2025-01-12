<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    public function showLoginForm() {
        return view('admin.login', [
            'titulo' => "Login como Admin",
        ]);
    }

    public function dashboard() {
        $admin = auth('admin')->user();

        return view('admin.index', [
            'titulo' => 'Painel Admin',
            'admin' => $admin,
        ]);
    }

    public function processLogin(Request $request) {
        // Valide os dados de entrada
        $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        // Recupere o usuário pelo login (ou email)
        $admin = Admin::where('login', $request->login)->first();

        // Verifique se o usuário existe
        if (!$admin) {
            return back()->withErrors(['login' => 'Usuário não encontrado.'])->withInput();
        }

        // Compare a senha fornecida com o hash armazenado no banco de dados
        if (Hash::check($request->senha, $admin->senha)) {
            // Se a senha for válida, faça o login manualmente
            auth('admin')->login($admin);

            // Regenerando a sessão (opcional, para segurança adicional)
            $request->session()->regenerate();

            // Redireciona para a página desejada após o login
            return redirect()->route('admin.dashboard');
        }

        // Se a senha não for válida
        return back()->withErrors(['senha' => 'A senha fornecida está incorreta.'])->withInput();
    }
}
