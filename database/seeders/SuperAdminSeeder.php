<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadminData = [
            'ci' => '12345678',
            'nombre' => 'Super',
            'apellido' => 'Admin',
            'correo' => 'superadmin@satp',
            'username' => 'superadmin',
            'password' => bcrypt('S0p0rt3-DS16C'),
            'telefono' => '000000000',
            'rol' => 'administrador',
        ];
        User::create($superadminData);
    }
}