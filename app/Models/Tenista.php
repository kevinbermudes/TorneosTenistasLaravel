<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenista extends Model
{
    use SoftDeletes;
    use HasFactory;

    public static string $IMAGE_DEFAULT = 'https://via.placeholder.com/150';
    protected $table = 'tenistas';

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'ranking',
        'pais',
        'FechaNacimiento',
        'edad',
        'Altura',
        'peso',
        'Mano',
        'reves',
        'entrenador',
        'totalDineroGanado',
        'numeroVictorias',
        'numeroDerrortas',
        'imagen',
        'puntos',
    ];

    protected $casts = [
        'FechaNacimiento' => 'date',
    ];
    protected $dates = ['deleted_at'];


    protected $keyType = 'string';
    protected $appends = ['win_ratio'];

    public static function recalcularRankings()
    {
        $tenistas = self::orderByDesc('puntos')->get();
        foreach ($tenistas as $index => $tenista) {
            $tenista->ranking = $index + 1;
            $tenista->save();
        }
    }

    public function getEdad()
    {
        $fechaNacimiento = \Carbon\Carbon::createFromFormat('Y-m-d', $this->FechaNacimiento);
        return $fechaNacimiento->diffInYears(now());
    }


    public function torneos()
    {
        return $this->belongsToMany(Torneo::class, 'torneo_tenista', 'tenista_id', 'torneo_id', 'id', 'idsecundario');
    }


    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($search) . "%"])
            ->orWhereRaw('LOWER(apellido) LIKE ?', ["%" . strtolower($search) . "%"])
            ->orWhereRaw('LOWER(pais) LIKE ?', ["%" . strtolower($search) . "%"]);
    }

    public function getWinRatioAttribute()
    {
        $totalPartidos = $this->numeroVictorias + $this->numeroDerrortas;
        return $totalPartidos > 0 ? ($this->numeroVictorias / $totalPartidos) * 100 : 0;
    }

}
