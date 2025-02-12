<?php

namespace App\Http\Requests\Professor\Professores;

use Illuminate\Foundation\Http\FormRequest;

class EditarProfessorRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'nome' => 'nullable|string|max:255',
            'cargo' => 'nullable|in:professor,coordenador',
            'turmas' => 'nullable|array|max:3',
            'turmas.*' => [
                'required', 'integer'
            ],
        ];
    }
}
