<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TorneoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'modalidad' => ['required'],
            'superficie' => ['required'],
            'vacantes' => ['required', 'integer'],
            'premios' => ['required', 'integer'],
            'fechaInicio' => ['required', 'date'],
            'fechaFin' => ['required', 'date'],
            'imagen' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
