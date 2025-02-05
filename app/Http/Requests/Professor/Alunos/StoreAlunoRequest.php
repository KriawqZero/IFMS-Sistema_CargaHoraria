<?php

namespace App\Http\Requests\Professor\Alunos;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlunoRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function prepareForValidation(): void {
        $this->merge([
            'cpf' => preg_replace('/[^0-9]/', '', $this->cpf),
        ]);
    }

    public function rules(): array {
        return [
            'nome' => 'required|string|max:255',
            'cpf' => 'required|numeric|digits:11|unique:alunos,cpf',
            'data_nascimento' => 'nullable|date',
            'id_turma' => 'nullable|exists:turmas,id',
        ];
    }
}
