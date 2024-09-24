<?php

namespace App\Http\Controllers;

use App\Models\EventParticipantType;
use Illuminate\Http\Request;

class EventParticipantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        EventParticipantType::create([
            'participant_type_id' => $request->participant_type_id,
            'document_type_id' => $request->document_type_id
        ]);

        return response()->json([
            "registrado" => "Plantilla asociada correctamente",
            "icono" => "success"
        ], 200);
    }

    public function asignar_tipos_participantes_a_eventos(Request $request){
        foreach($request->participantTypes as $tipo_participante){
            EventParticipantType::where('participant_type_id', $tipo_participante)->update(['event_id' => $request->id_evento]);
        }

        return response()->json([
            "asociado" => "Participante(s) asociado(s) correctamente",
            "icono" => "success"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventParticipantType $eventParticipantType)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventParticipantType $eventParticipantType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventParticipantType $eventParticipantType)
    {
        //
    }
}
