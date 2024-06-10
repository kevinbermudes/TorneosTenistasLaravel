<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Torneo */
class TorneoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'modalidad' => $this->modalidad,
            'superficie' => $this->superficie,
            'vacantes' => $this->vacantes,
            'premios' => $this->premios,
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'imagen' => $this->imagen,
        ];
    }
}
