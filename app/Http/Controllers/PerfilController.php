<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $defaultImage = 'default-profile.svg';

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'remover_foto' => 'sometimes|boolean'
        ]);

        // Lógica de remoção de foto
        if ($request->input('remover_foto')) {
            if ($usuario->foto_src && $usuario->foto_src !== $defaultImage) {
                Storage::disk('public')->delete($usuario->foto_src);
            }

            /** @disregard P1013 Undefined Method */
            $usuario->update(['foto_src' => $defaultImage]);
            return redirect()->back()->with('success', 'Foto removida com sucesso!');
        }

        // Lógica de upload de nova foto
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('perfil/' . $usuario->id, 'public');

            // Remove foto antiga se não for a padrão
            if ($usuario->foto_src && $usuario->foto_src !== $defaultImage) {
                Storage::disk('public')->delete($usuario->foto_src);
            }


            /** @disregard P1013 Undefined Method */
            $usuario->update(['foto_src' => $path]);
            return redirect()->back()->with('success', 'Foto atualizada com sucesso!');
        }

        // Caso não tenha alterado nada
        return redirect()->back()->with('info', 'Nenhuma alteração realizada');
    }
}
