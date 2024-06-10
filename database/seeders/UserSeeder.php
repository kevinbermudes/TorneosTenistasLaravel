<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.es',
                'password' => bcrypt('1234'),
                'role' => 'admin',
                'phone_number' => '1234567890', // Añadir un valor de ejemplo para phone_number
            ],
            [
                'name' => 'user',
                'email' => 'user@user.es',
                'password' => bcrypt('1234'),
                'role' => 'user',
                'phone_number' => '0987654321', // Añadir un valor de ejemplo para phone_number
            ],
        ]);
    }
}
