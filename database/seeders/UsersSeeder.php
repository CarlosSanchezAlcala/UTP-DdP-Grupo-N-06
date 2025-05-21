<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::create([
            'name_user' => 'Carlos Edidson',
            'ape_pat_user' => 'Sanchez',
            'ape_mat_user' => 'Alcala',
            'dni_user' => '73829932',
            'nick_user' => 'Admin',
            'password' => bcrypt('Admin'),
            'level_user' => 'A',
            'id_offi' => 1,
            'status_user' => 'A'
        ]);
    }
}
