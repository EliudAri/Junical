<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Eliud',
            'email' => 'eliudarias945@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $inventarios = [
            [
                'tipo_equipo' => 'Escritorio',
                'pertenece' => 'Milenio',
                'serial_cpu' => 'ML-867243',
                'serial_monitor' => 'ML-1313',
                'serial_mac' => 'SCG1083619L',
                'serial_fisico_monitor' => 'FM-123456',
                'capacidad_disco' => '500 GB',
                'tipo_disco' => 'HDD',
                'capacidad_ram' => '8 GB',
                'tipo_procesador' => 'INTEL CORE I5-1035V1',
                'marca_monitor' => 'DELL',
                'area' => 'CARTERA',
                'jefe_area' => 'DANIELA SUASNA',
                'torre' => '1',
                'ip_equipo' => '192.168.1.1',
                'sistema_operativo' => 'Windows 10',
                'version_office' => '2019',
                'tipo_antivirus' => 'Eset Nod32',
                'perifericos' => true,
                'marca_teclado' => 'Marca Teclado A',
                'marca_mouse' => 'Marca Mouse A',
            ],
            [
                'tipo_equipo' => 'Portátil',
                'pertenece' => 'Milenio',
                'serial_cpu' => 'ML-1234',
                'serial_monitor' => 'ML-5252',
                'serial_mac' => 'SCG1083L',
                'serial_fisico_monitor' => 'FM-654321',
                'capacidad_disco' => '1 TB',
                'tipo_disco' => 'HDD',
                'capacidad_ram' => '16 GB',
                'tipo_procesador' => 'INTEL CORE I5-1035V1',
                'marca_monitor' => 'DELL',
                'area' => 'CARTERA',
                'jefe_area' => 'DANIELA SUASNA',
                'torre' => '1',
                'ip_equipo' => '192.168.1.2',
                'sistema_operativo' => 'Windows 10',
                'version_office' => '2019',
                'tipo_antivirus' => 'Eset Nod32',
                'perifericos' => true,
                'marca_teclado' => 'Marca Teclado B',
                'marca_mouse' => 'Marca Mouse B',
            ],
            // Agrega más registros según sea necesario
        ];

        DB::table('inventarios')->insert($inventarios);
    }
}
