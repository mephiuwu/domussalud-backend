<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
            'street_name' => 'Av. 4 norte 455',
            'latitude' => -36.85758291887411, 
            'longitude' => -73.13850406058539, 
        ];

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'ramirosaezsa@gmail.com',
            'password' => 'lupus123xD', // Hasheando la contraseña
            'phone' => '935926523',
            'rut' => '19.990.315-2',
            'gender' => 'male',
            'address' => json_encode($address),
            'marital_status' => 'Soltero',
            'account_verified' => true,
            'birthdate' => 904104000,
            'is_active' => true,
            'role' => 'superadmin', // Debe coincidir con las opciones en la migración
        ]);
    }
}
