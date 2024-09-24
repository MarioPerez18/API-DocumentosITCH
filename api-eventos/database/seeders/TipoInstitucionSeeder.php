<?php

namespace Database\Seeders;

use App\Models\InstitutionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoInstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$tipo_institucion = new InstitutionType();

        $tipo_institucion->type = 'Educativa';
        $tipo_institucion->save();*/

        InstitutionType::create([
            'type' => 'Educativa'
        ]);

        InstitutionType::create([
            'type' => 'Cultural'
        ]);


    }
}
