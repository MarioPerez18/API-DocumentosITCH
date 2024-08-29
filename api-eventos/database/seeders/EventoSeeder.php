<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evento = new Event();

        $evento->startDate = '2024-05-28 09:00:00';
        $evento->endDate = '2024-05-29 17:00:00';
        $evento->nameEvent = 'Academia Journals';
        $evento->description = 'Espacio de trabajo que da a conocer los resultados de trabajos de investigación.';
        $evento->save();

        $evento2 = new Event();

        $evento2->startDate = '2024-03-16 09:00:00';
        $evento2->endDate = '2024-03-17 17:00:00';
        $evento2->nameEvent = 'Simposium V';
        $evento2->description = 'Espacio de trabajo donde cualquier autor puede dar a conocer su investigación.';
        $evento2->save();
    }
}
