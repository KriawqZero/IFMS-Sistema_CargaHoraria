<?php

namespace App\Http\Requests\Professor\Professores;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CriarProfessorRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'nome' => 'required|string|max:255',
            'cargo' => 'required|in:professor,coordenador,admin',
            'turmas' => 'nullable|array|max:3',
            'turmas.*' => [
                'required',
                'integer',
                Rule::exists('turmas', 'id')->whereNull('professor_id'),
            ],
        ];
    }
}
