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
        $tipo_participante = new ParticipantType();
        $tipo_participante->participantType = 'Ponente';
        $tipo_participante->save();

        $tipo_participante_coordi = new ParticipantType();
        $tipo_participante_coordi->participantType = 'Coordinador';
        $tipo_participante_coordi->save();
    }
}
