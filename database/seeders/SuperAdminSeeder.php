<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'ramirosaezsa@gmail.com',
            'password' => 'lupus123xD', // Hasheando la contraseña
            'rut' => '19.990.315-2',
            'account_verified' => true,
            'date_of_birth' => '1998-08-26', // Formato Y-m-d para date
            'is_active' => true,
            'user_type' => 'superadmin', // Debe coincidir con las opciones en la migración
        ]);
    }
}
