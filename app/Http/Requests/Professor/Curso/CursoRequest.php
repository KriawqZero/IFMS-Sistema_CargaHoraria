<?php

namespace App\Http\Requests\Professor\Curso;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'nome' => 'required|string',
            'sigla' => 'required|string',
        ];
    }
}
