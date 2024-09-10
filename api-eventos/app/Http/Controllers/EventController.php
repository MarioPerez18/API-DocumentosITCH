<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Listado de todos los registros de los eventos.
     * @OA\Get (
     *     path="/api/events",
     *     tags={"Eventos"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="startDate", type="datetime", example="2024-05-18 09:00:00"),
     *              @OA\Property(property="endDate", type="datetime", example="2024-05-19 17:00:00"),
     *              @OA\Property(property="nameEvent", type="string", example="Academia Journals"),
     *              @OA\Property(property="description", type="text", example="Espacio que da a conocer resultados de investigación"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index()
    {
       $eventos = Event::where('is_deleted', false)->get();
       return response()->json($eventos);
    }

    /**
     * Almacena un recurso creado.
     * @OA\Post(
     *     path="/api/events",
     *     tags={"Eventos"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"startDate", "endDate", "nameEvent", "description"},
     *             @OA\Property(property="startDate", type="datetime", example="2024-05-28 09:00:00"),
     *             @OA\Property(property="endDate", type="datetime", example="2024-05-29 19:00:00"),
     *             @OA\Property(property="nameEvent", type="string", example="Academia Journals"),
     *             @OA\Property(property="description", type="text", example="Espacio de trabajo que da a conocer los resultados de trabajos de investigación.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Evento registrado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la solicitud",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Faltan campos")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        //se eliminan los acentos de las cadenas
        $UriNameEvent = Str::ascii($request->nameEvent);
        Event::create([
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'nameEvent' => $request->nameEvent,
            'description' => $request->description,
            'nameEventUri' => Str::lower($UriNameEvent)
        ]);

        return response()->json([
            "respuesta" => "Evento registrado",
            "icono" => "success"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //se eliminan los acentos de las cadenas
        $UriNameEvent = Str::ascii($request->nameEvent);
        Event::where('id', $event->id)->update([
            "startDate" => $request->startDate,
            "endDate" => $request->endDate,
            "nameEvent" => $request->nameEvent,
            "nameEventUri" => Str::lower($UriNameEvent),
            "description" => $request->description
        ]);
        
        return response()->json([
            "respuesta" => "Evento actualizado",
            "icono" => "success"
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        Event::where('id', $event->id)->update(['is_deleted' => true]);

        return response()->json([
            "respuesta" => "Evento eliminado",
            "icono" => "success"
        ], 202);
    }
}
