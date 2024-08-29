<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventParticipants = EventUser::select(
            'event_user.id',
            'users.names AS Nombres',
            'users.paternalSurname AS ApellidoPaterno',
            'users.maternalSurname AS ApellidoMaterno',
            'users.email AS Correo',
            'events.nameEvent AS Evento',
            'events.description AS Descripcion',
            'participant_types.participantType AS TipoParticipante',
            'events.endDate AS FechaTermino',
            'user_id AS id_participante'
            
        )
            ->join('users', 'event_user.user_id', '=', 'users.id')
            ->join('events', 'event_user.event_id', '=', 'events.id')
            ->join('participant_types', 'event_user.participant_type_id', '=', 'participant_types.id')
            ->orderBy('event_user.id')
            ->get();

        return response()->json($eventParticipants, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        EventUser::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'participant_type_id' => $request->participant_type_id
        ]);

        return response()->json([
            "registrado" => "Te has registrado exitosamente",
            "icono" => "success"
        ], 200);
        
    }

    public function asignar_coordinador_a_evento(Request $request){
        $user_id = $request->user_id;
        EventUser::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'participant_type_id' => $request->participant_type_id
        ]);

        User::where('id', $user_id)->update(['role' => "coordi"]);

        return response()->json([
            "registrado" => "Se ha asignado a un coordinador",
            "icono" => "success"
        ], 200);
    }

   

    /**
     * Display the specified resource.
     */
    public function show(EventUser $eventParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventUser $eventParticipant)
    {        
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventUser $eventParticipant)
    {
        //
    }
}
