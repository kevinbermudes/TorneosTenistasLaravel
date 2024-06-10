<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenistaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'apellido' => ['required'],
            'ranking' => ['required', 'integer'],
            'pais' => ['required'],
            'FechaNacimiento' => ['required', 'date'],
            'edad' => ['required', 'integer'],
            'Altura' => ['required', 'numeric'],
            'peso' => ['required', 'numeric'],
            'Mano' => ['required'],
            'reves' => ['required'],
            'entrenador' => ['required'],
            'totalDineroGanado' => ['required'],
            'numeroVictorias' => ['required', 'integer'],
            'numeroDerrortas' => ['required', 'integer'],
            'imagen' => ['required'],
            'puntos' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
