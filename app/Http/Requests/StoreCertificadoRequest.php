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

    protected function prepareForValidation() {
        if ($this->has('carga_horaria')) {
            $this->merge([
                'carga_horaria' => str_replace(',', '.', $this->input('carga_horaria')),
            ]);
        }
    }

    /**
     * Obtenha as regras de validação aplicáveis à solicitação.
     */
    public function rules(): array {
        return [
            'categoria' => 'required|string|max:255',
            'titulo' => 'nullable|string|max:100',
            'carga_horaria' => 'required|numeric',
            'data_do_certificado' => 'required|date',
            'observacao' => 'nullable|string|max:500',
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ];
    }

    /**
     * Mensagens de erro customizadas.
     */
    public function messages(): array {
        return [
            'categoria.required' => 'O campo categoria é obrigatório.',
            'categoria.string' => 'O campo categoria deve ser uma string.',
            'categoria.max' => 'O campo categoria deve ter no máximo 255 caracteres.',
            'titulo.max' => 'O campo título deve ter no máximo 100 caracteres.',
            'carga_horaria.required' => 'A carga horária é obrigatória.',
            'carga_horaria.numeric' => 'A carga horária deve ser um número válido.',
            'data_do_certificado.required' => 'A data do certificado é obrigatória.',
            'data_do_certificado.date' => 'O campo data do certificado deve ser uma data válida.',
            'arquivo.required' => 'O arquivo é obrigatório.',
            'arquivo.file' => 'O arquivo deve ser um arquivo válido.',
            'arquivo.mimes' => 'O arquivo deve ser do categoria: pdf, jpg, jpeg ou png.',
            'arquivo.max' => 'O arquivo deve ter no máximo 4 MB.',
        ];
    }
}
