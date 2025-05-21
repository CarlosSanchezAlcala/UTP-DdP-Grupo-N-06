<?php

namespace Database\Seeders;

use App\Models\Offices;
use Illuminate\Database\Seeder;

class OfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offices::create([
            'name_offi' => 'Oficina de Informatica y Estadisticas',
            'desc_offi' => 'Oficina encargada de manejar y mantener todos los sistemas del municipio.',
        ]);
    }
}
