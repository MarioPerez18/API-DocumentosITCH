<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'paternalSurname' => 'Pérez',
            'maternalSurname' => 'Ramírez',
            'names' => 'Luis Mario',
            'gender' => 'H',
            'phoneNumber' => '9831238163',
            'email' => 'vapire117@gmail.com',
            'password' => Hash::make('marioitch10'),
            'role' => 'admin',
            'institution_id' => 1
        ]);

        User::create([
            'paternalSurname' => 'Vargas',
            'maternalSurname' => 'Ku',
            'names' => 'Benjamín',
            'gender' => 'H',
            'phoneNumber' => '9837651023',
            'email' => 'benjamin.vk@chetumal.tecnm.mx',
            'password' => Hash::make('benjaminvargas'),
            'institution_id' => 1
        ]);

        User::create([
            'paternalSurname' => 'Pérez',
            'maternalSurname' => 'Ortíz',
            'names' => 'Luis Miguel',
            'gender' => 'H',
            'phoneNumber' => '9836541209',
            'email' => 'perez_luis99@gmail.com',
            'password' => Hash::make('luisortizitch10'),
            'institution_id' => 1
        ]);

        
        User::create([
            'paternalSurname' => 'López',
            'maternalSurname' => 'hernández',
            'names' => 'Eder',
            'gender' => 'H',
            'phoneNumber' => '9830982135',
            'email' => 'her_nandez10@gmail.com',
            'password' => Hash::make('hernandezitch10'),
            'institution_id' => 1
        ]);

        User::create([
            'paternalSurname' => 'León',
            'maternalSurname' => 'herrera',
            'names' => 'Raul Aurelio',
            'gender' => 'H',
            'phoneNumber' => '9830002134',
            'email' => 'leo_aurelio@gmail.com',
            'password' => Hash::make('aurelioitch10'),
            'institution_id' => 1
        ]);
    }
}
