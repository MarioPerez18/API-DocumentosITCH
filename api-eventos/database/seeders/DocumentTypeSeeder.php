<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create([
            'type' => 'ponente',
            'description' => 'Documento para participantes de tipo ponentes',
            'documentTemplate' => 'plantilla_documentos'. '/ponente' . '/ponente.png'
        ]);

        DocumentType::create([
            'type' => 'coordinador',
            'description' => 'Documento para participantes de tipo coordinador',
            'documentTemplate' => 'plantilla_documentos'. '/coordinador' . '/coordinador.png'
        ]);
    }
}


