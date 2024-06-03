<?php

namespace App\Http\Controllers;

use App\Models\EventParticipant;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventParticipants = EventParticipant::select(
            'event_participant.id',
            'users.names AS Nombres',
            'users.paternalSurname AS ApellidoPaterno',
            'users.maternalSurname AS ApellidoMaterno',
            'users.email AS Correo',
            'events.nameEvent AS Evento',
            'events.description AS Descripcion',
            'participant_types.participantType AS TipoParticipante',
            'events.endDate AS FechaTermino'
        )
            ->join('users', 'event_participant.users_id', '=', 'users.id')
            ->join('events', 'event_participant.events_id', '=', 'events.id')
            ->join('participant_types', 'event_participant.participant_types_id', '=', 'participant_types.id')
            ->orderBy('users.id')
            ->get();

        return response()->json($eventParticipants, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventParticipant $eventParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventParticipant $eventParticipant)
    {        
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventParticipant $eventParticipant)
    {
        //
    }
}
