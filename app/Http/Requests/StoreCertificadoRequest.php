<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificadoRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Obtenha as regras de validação aplicáveis à solicitação.
     */
    public function rules(): array {
        return [
            'titulo' => 'nullable|string|max:100',
            'carga_horaria' => 'required|regex:/^\d{1,3}:[0-5]\d$/',
            'data_do_certificado' => 'required|date',
            'observacao' => 'nullable|string|max:500',
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }

    /**
     * Mensagens de erro customizadas.
     */
    public function messages(): array {
        return [
            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
            'titulo.max' => 'O campo título deve ter no máximo 100 caracteres.',
            'carga_horaria.required' => 'A carga horária é obrigatória.',
            'carga_horaria.regex' => 'O formato deve ser Hh:mm (Ex: 12:30)',
            'data_do_certificado.required' => 'A data do certificado é obrigatória.',
            'data_do_certificado.date' => 'O campo data do certificado deve ser uma data válida.',
            'arquivo.required' => 'O arquivo é obrigatório.',
            'arquivo.file' => 'O arquivo deve ser um arquivo válido.',
            'arquivo.mimes' => 'O arquivo deve ser do categoria: pdf, jpg, jpeg ou png.',
            'arquivo.max' => 'O arquivo deve ter no máximo 2 MB.',
        ];
    }
}
