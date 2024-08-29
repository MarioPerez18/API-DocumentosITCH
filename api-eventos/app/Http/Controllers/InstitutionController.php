<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituciones = Institution::with('institution_type')->where('is_deleted', false)->get();
        return response()->json($instituciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //se eliminan los acentos de las cadenas
        $UriLongName = Str::ascii($request->longName);
        Institution::create([
            "shortName" => $request->shortName,
            "longName" => $request->longName,
            "longNameUri" => Str::lower($UriLongName),
            "institution_type_id" => $request->institution_type_id
        ]);

        return response()->json([
            "respuesta" => "La institución ha sido registrada",
            "icono" => "success"
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Institution $institution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institution $institution)
    {
        //se eliminan los acentos de las cadenas
        $UriLongName = Str::ascii($request->longName);
        Institution::where('id', $institution->id)->update([
            "shortName" => $request->shortName,
            "longName" => $request->longName,
            "longNameUri" => Str::lower($UriLongName),
            "institution_type_id" => $request->institution_type_id
        ]);
        
        return response()->json([
            "respuesta" => "Institucion actualizada",
            "icono" => "success"
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution)
    {
        Institution::where('id', $institution->id)->update(['is_deleted' => true]);

        return response()->json([
            "respuesta" => "Institucion eliminada",
            "icono" => "success"
        ], 202);
    }
}
