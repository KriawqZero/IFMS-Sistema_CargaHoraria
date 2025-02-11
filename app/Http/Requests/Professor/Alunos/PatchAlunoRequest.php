<?php

namespace App\Http\Requests\Professor\Alunos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatchAlunoRequest extends FormRequest {
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
            'nome' => 'nullable|string|max:255',
            'cpf' => 'nullable|numeric|digits:11', Rule::unique('alunos')->ignore($this->aluno),
            'data_nascimento' => 'nullable|date',
            'id_turma' => 'nullable|exists:turmas,id',
        ];
    }
}
