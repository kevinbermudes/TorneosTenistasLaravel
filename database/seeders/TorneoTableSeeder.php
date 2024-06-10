<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TorneoTableSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('torneos')->delete();
        DB::table('torneos')->insert([
            [

                'id' => '2c30f5b4-79d5-4dcd-88c2-baeedab870f1',
                'nombre' => 'Open Australia',
                'modalidad' => 'individual',
                'superficie' => 'dura',
                'vacantes' => 128,
                'categoria' => 'atp 250',
                'premios' => 1000000,
                'fechaInicio' => now()->addWeeks(2),
                'fechaFin' => now()->addWeeks(3),
                'imagen' => 'https://is1-ssl.mzstatic.com/image/thumb/Purple221/v4/4b/1e/ce/4b1ece63-6b72-f374-8455-91cd44fc99d1/AppIcon-1x_U007emarketing-0-6-0-85-220-0.png/512x512bb.jpg',
                'isDelete' => 'false',

            ],
            [
                'id' => '1f65e5c2-3c0e-4d94-b1f3-dc340b88f344',
                'nombre' => 'Roland Garros',
                'modalidad' => 'individual',
                'superficie' => 'arcilla',
                'vacantes' => 128,
                'categoria' => 'atp 500',
                'premios' => 2000000,
                'fechaInicio' => now()->addWeeks(10),
                'fechaFin' => now()->addWeeks(11),
                'imagen' => 'https://w7.pngwing.com/pngs/20/289/png-transparent-roland-garros-logo-tennis-tournaments.png',
                'isDelete' => 'false'

            ],
            [
                'id' => '52ac8c85-e6db-4d5b-a61c-1db6b26d3d6a',
                'nombre' => 'Wimbledon',
                'modalidad' => 'individual',
                'superficie' => 'hierba',
                'vacantes' => 128,
                'categoria' => 'atp 1000',
                'premios' => 3000000,
                'fechaInicio' => now()->addWeeks(18),
                'fechaFin' => now()->addWeeks(19),
                'imagen' => 'https://static.vecteezy.com/system/resources/previews/022/932/875/original/wimbledon-the-championships-white-symbol-logo-tournament-open-tennis-design-abstract-illustration-with-green-background-free-vector.jpg',
                'isDelete' => 'false'

            ],
            [
                'id' => '857e7ba5-8b3c-4269-95ac-d195d2be4c8e',
                'nombre' => 'US Open',
                'modalidad' => 'individual',
                'superficie' => 'dura',
                'vacantes' => 128,
                'categoria' => 'atp 250',
                'premios' => 1000000,
                'fechaInicio' => now()->addWeeks(26),
                'fechaFin' => now()->addWeeks(27),
                'imagen' => 'https://brandemia.org/sites/default/files/inline/images/us_open_logo.jpg',
                'isDelete' => 'false'
            ],


        ]);
    }
}
