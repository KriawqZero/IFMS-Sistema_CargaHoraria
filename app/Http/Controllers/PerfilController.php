<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilController extends Controller {
    function getUsuarioAtivo() {
        if(auth('professor')->check())
            return auth('professor')->user();

        return auth('aluno')->user();
    }

    public function perfil() {
        $usuario = $this->getUsuarioAtivo();
        return view('perfil.editarPerfil', [
            'titulo' => 'Perfil',
            'nome' => $usuario->nome,
            'foto' => $usuario->foto_src,
        ]);
    }

    public function perfilUpdate(Request $request) {
        $usuario = $this->getUsuarioAtivo();

        $input = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (!$request->hasFile('foto'))
            return redirect()->back()->with('error', 'Erro ao atualizar perfil!');

        $path = $input['foto']->store('perfil/' . $usuario->id, 'public');

        /** @disregard P1013 Undefined Method */
        $usuario->update(['foto_src' => $path]);
        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');

    }
}
