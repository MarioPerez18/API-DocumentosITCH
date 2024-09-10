<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsesuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'paternalSurname' => 'Perez',
            'maternalSurname' => 'Ramirez',
            'names' => 'Luis Mario',
            'gender' => 'H',
            'phoneNumber' => '9831238163',
            'email' => 'vapire117@gmail.com',
            'password' => Hash::make('marioitch10'),
            'role' => 'Admin',
            'institution_id' => 1
        ]);
    }
}
