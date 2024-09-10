<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Institucion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$institucion = new Institution();

        $institucion->shortName = 'ITCH';
        $institucion->longName = 'Instituto Tecnológico De Chetumal';
        $institucion->institution_type_id = 1;
        $institucion->is_deleted = false;
        $institucion->longNameuri = "instituto tecnologico de chetumal";
        $institucion->save();*/

        Institution::create([
            'shortName' => 'ITCH',
            'longName' => 'Instituto Tecnológico De Chetumal',
            'longNameuri' => 'instituto tecnologico de chetumal',
            'institution_type_id' => 1
        ]);
    }
}
