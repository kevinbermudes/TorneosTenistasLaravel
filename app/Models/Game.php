<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'torneo_id',
        'tenista1_id',
        'tenista2_id',
        'ganador_id',
        'ronda'
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'torneo_id', 'idsecundario');
    }

    public function tenista1()
    {
        return $this->belongsTo(Tenista::class, 'tenista1_id');
    }

    public function tenista2()
    {
        return $this->belongsTo(Tenista::class, 'tenista2_id');
    }

    public function ganador()
    {
        return $this->belongsTo(Tenista::class, 'ganador_id');
    }
}
