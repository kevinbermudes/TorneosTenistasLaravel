<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Tenista */
class TenistaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'ranking' => $this->ranking,
            'pais' => $this->pais,
            'FechaNacimiento' => $this->FechaNacimiento,
            'edad' => $this->edad,
            'Altura' => $this->Altura,
            'peso' => $this->peso,
            'Mano' => $this->Mano,
            'reves' => $this->reves,
            'entrenador' => $this->entrenador,
            'totalDineroGanado' => $this->totalDineroGanado,
            'numeroVictorias' => $this->numeroVictorias,
            'numeroDerrortas' => $this->numeroDerrortas,
            'imagen' => $this->imagen,
            'puntos' => $this->puntos,
        ];
    }
}
