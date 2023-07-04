<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('roles')->insert([
            'rol' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'rol' => 'User',
        ]);

        DB::table('categoria')->insert([
            'etiqueta' => 'Aceites Esenciales',
        ]);
        DB::table('categoria')->insert([
            'etiqueta' => 'Velas Aromaticas',
        ]);
        DB::table('categoria')->insert([
            'etiqueta' => 'Difusores',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            // 'apellido_paterno'=>'user',
            // 'apellido_materno'=>'user',
            // 'edad'=>30,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'rol_id' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            // 'apellido_paterno'=>'user',
            // 'apellido_materno'=>'user',
            // 'edad'=>25,
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'rol_id' => 2,
        ]);
    }
}
