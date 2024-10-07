<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(DocumentType::all());
        //return response()->json(url('plantilla_documentos'. '/coordinador' . '/coordinador.png'));
    }

    public function plantilla_participante($tipo_participante){

        $tipo_documento = DocumentType::where('type', $tipo_participante)->get();
        foreach($tipo_documento as $plantilla){
            $plantilla_documento = $plantilla->documentTemplate;
            $tipo_documento =  $plantilla->type;
        }

        $url_plantilla = url($plantilla_documento);
        $tipo_plantilla =  $tipo_documento;

        //png QR
        $png_qr = url('png_qrcode' . '/' . 'img_qr' . '/' . '66fb3db705cec.png');

        return response()->json([
            $tipo_plantilla,
            $url_plantilla,
            $png_qr
        ], 200);
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
    public function show(DocumentType $documentType)
    {
        /*$url_plantilla = url($documentType->documentTemplate);
        $tipo_plantilla = $documentType->type;
        return response()->json([
            $tipo_plantilla,
            $url_plantilla
        ], 200);*/
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentType $documentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentType $documentType)
    {
        //
    }
}
