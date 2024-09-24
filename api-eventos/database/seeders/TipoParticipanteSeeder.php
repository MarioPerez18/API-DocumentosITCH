<?php

namespace Database\Seeders;

use App\Models\ParticipantType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParticipantType::create([
            'participantType' => 'coordinador'
        ]);
        
        /*ParticipantType::create([
            'participantType' => 'ponente'
        ]);*/
    }
}


