<?php

namespace App\Http\Controllers;

use App\Models\ParticipantType;
use Illuminate\Http\Request;

class ParticipantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ParticipantType::select("id","ParticipantType")->where("ParticipantType", "Coordinador")->get());
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
    public function show(ParticipantType $participantType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParticipantType $participantType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParticipantType $participantType)
    {
        //
    }
}
