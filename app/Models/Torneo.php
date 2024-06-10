<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Torneo extends Model
{
    use HasFactory;

    public static string $IMAGE_DEFAULT = 'https://via.placeholder.com/150';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = [
        'nombre',
        'modalidad',
        'superficie',
        'vacantes',
        'categoria',
        'premios',
        'fechaInicio',
        'fechaFin',
        'imagen',
        'isDelete'
    ];

    protected $casts = [
        'fechaInicio' => 'date',
        'fechaFin' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });
    }

    public function tenistas()
    {
        return $this->belongsToMany(Tenista::class, 'torneo_tenista', 'torneo_id', 'tenista_id', 'idsecundario', 'id');
    }
}
