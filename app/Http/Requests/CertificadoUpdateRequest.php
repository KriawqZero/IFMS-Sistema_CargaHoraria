<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificadoUpdateRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'titulo' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'carga_horaria' => 'sometimes|regex:/^\d{1,3}:[0-5]\d$/',
            'status' => 'nullable|in:valido,invalido,pendente',
        ];
    }

    public function messages(): array {
        return [
            'carga_horaria.regex' => 'Formato de hora inválido. Use HH:MM (ex: 120:30 para 120 horas e 30 minutos)',
        ];
    }
}
