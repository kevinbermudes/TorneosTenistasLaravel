<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TorneoTenistaSeeder extends Seeder
{
    public function run()
    {

        DB::table('torneo_tenista')->upsert([
            [
                'torneo_id' => 1,
                'tenista_id' => 1,
                'semilla' => 1,
                'estado' => 'activo',

            ],
            [
                'torneo_id' => 2,
                'tenista_id' => 1,
                'semilla' => 1,
                'estado' => 'activo',

            ],

            [
                'torneo_id' => 3,
                'tenista_id' => 1,
                'semilla' => 1,
                'estado' => 'activo',

            ],

            [
                'torneo_id' => 1,
                'tenista_id' => 2,
                'semilla' => 2,
                'estado' => 'activo'
            ]
        ], ['torneo_id', 'tenista_id'], ['semilla', 'estado']);
    }
}
