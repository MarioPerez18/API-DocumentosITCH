<?php

namespace App\Http\Controllers;

use App\Models\Document;
use DateTime;
use Illuminate\Http\Request;
use QRCode;
use FPDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCorreos;
use App\Models\EventUser;

class DocumentController extends Controller
{

   
    private $nombre_archivo;
    private $folio_documento;

   
    public function getNombreArchivo(){
        return $this->nombre_archivo;
    }

    public function setNombreArchivo($nombre_archivo){
        $this->nombre_archivo = $nombre_archivo;
    }

    public function getFolioDocumento(){
        return $this->folio_documento;
    }

    public function setFolioDocumento($folio_documento){
        $this->folio_documento = $folio_documento;
    }

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Document::all(), 200);
    }

    public function cifrar_datos($body){ 
        //crifrar datos.
        $datos_del_participante = json_encode($body);
        $cifrarDatos = Crypt::encryptString($datos_del_participante);
        $url = 'http://localhost:8000/api/validation/' . $cifrarDatos;
        return $url;
    }


    //método que decifra la cadena.
    public function decifrar_cadena($cadena){
        try{
            $decifrarDatos = Crypt::decryptString($cadena);
        }catch(DecryptException $error){
            echo $error;
        }
        return $decifrarDatos;
    }

    //método que generará el codigo Qr.
    public function generar_qrcode($url){
        //nombre y ruta del png
        $nombre_png = uniqid().'.png';
        $ruta_png_QRcode = public_path('png_qrcode') . '/' . $nombre_png;
        $this->setFolioDocumento($nombre_png);
        QRcode::png($url, $ruta_png_QRcode);
        //echo $url;
        return $ruta_png_QRcode;
    }

    //método que generará el pdf.
    public function generar_pdf($QRcode, $body, $nombre_archivo){
        //registro de la peticion
        $registro = $body;

        //nombre y ruta del archivo pdf
        //$nombre_archivo = "{$registro["Evento"]}_{$registro["Nombres"]}.pdf";
        $this->setNombreArchivo($nombre_archivo);
        $ruta_pdf = public_path('archivos_pdf') . '/' . $nombre_archivo;
        //ruta del png
        $ruta_png = public_path('plantilla_documentos') . '/TEC.png';

        //ruta de los logos del tecnm
        $ruta_png_itch = public_path('logos_itch') . '/logoItch.png';
        $ruta_png_tecnm = public_path('logos_itch') .  '/tecnm.png';

        //formatear fecha
        $fecha = new DateTime($registro["FechaTermino"]);
        $fechaFormateada = $fecha->format('d \d\e M \d\e\l Y');

         //crear pdf
        $pdf = new FPDF();
        $pdf->AddPage('horizontal');
        $pdf->Image($ruta_png, 0, 0, 300, 210,'PNG');
        $pdf->Image($QRcode,  141, 170, 30, 30,'PNG');
        $pdf->Image($ruta_png_tecnm,  220, 5, 40, 20,'PNG');
        $pdf->Image($ruta_png_itch,  258, 5, 30, 20,'PNG');
        $pdf->SetFont('Arial','',20);
        $pdf->SetXY($registro["coordenada_x"],$registro["coordenada_y"]);
        $pdf->Cell(161, 10,  utf8_decode("{$registro["Nombres"]} {$registro["ApellidoPaterno"]} {$registro["ApellidoMaterno"]}"), 0, 0, 'C');
        $pdf->SetFont('Arial','',15);
        $pdf->SetXY(76,102);
        $pdf->MultiCell(161, 7, utf8_decode("Por su participación como {$registro["TipoParticipante"]} en el evento {$registro["Evento"]}: {$registro["Descripcion"]}") , 0, 'C', 0);
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(76,160);
        $pdf->MultiCell(161, 3,  utf8_decode("Fecha de finalización: {$fechaFormateada}"), 0, 'C', 0);

        // Guardar el archivo pdf en la carpeta especificada
        $pdf->Output('F', $ruta_pdf, true);
    }



    /**
     * Almacena un recurso creado - genera documentos de participación.
     * @OA\Post(
     *     path="/api/documents",
     *     tags={"Documentos"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id", "Nombres", "ApellidoPaterno", "ApellidoMaterno", "Correo", "Evento", "Descripcion", "TipoParticipante", "FechaTermino"},
     *             @OA\Property(property="id", type="number", example="1"),
     *             @OA\Property(property="Nombres", type="string", example="Luis Mario"),
     *             @OA\Property(property="ApellidoPaterno", type="string", example="Pérez"),
     *             @OA\Property(property="ApellidoMaterno", type="string", example="Ramírez"),
     *             @OA\Property(property="Correo", type="string", example="vapire117@gmail.com"),
     *             @OA\Property(property="Evento", type="string", example="Academia Journals"),
     *             @OA\Property(property="Descripcion", type="text", example="Espacio de trabajo que da a conocer los resultados de trabajos de investigación."),
     *             @OA\Property(property="TipoParticipante", type="string", example="Ponente"),
     *             @OA\Property(property="FechaTermino", type="datetime", example="2024-05-29 17:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Documentos generados y enviados"),
     *             @OA\Property(property="icono", type="string", example="success")
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
        $datos_del_participante = array(
            "id" => $request->id,
            "Nombres" => $request->participante["Nombres"],
            "ApellidoPaterno" => $request->participante["ApellidoPaterno"],
            "ApellidoMaterno" => $request->participante["ApellidoMaterno"],
            "Correo" => $request->participante["Correo"],
            "Evento" => $request->participante["Evento"],
            "Descripcion" => $request->participante["Descripcion"],
            "TipoParticipante" => $request->participante["TipoParticipante"],
            "FechaTermino" => $request->participante["FechaTermino"],
            "coordenada_x" => $request->coordenada_x,
            "coordenada_y" => $request->coordenada_y
        );

        //nombre del archivo
        $nombre_archivo_pdf = "{$datos_del_participante["Evento"]}_{$datos_del_participante["Nombres"]}.pdf";
        //se verifica si el archivo ya existe, si ya existe ya no se creará otra vez
        //sino existe generarlo.
        $generados = Document::select('archive')->get();
        foreach($generados as $archivo_generado){
            if($nombre_archivo_pdf == $archivo_generado["archive"]){
                return response()->json([
                    "documento" => "Los documentos ya existen",
                    "icono" => "error"
                ], 208);
            } 
        }
       

        $this->generar_pdf($this->generar_qrcode($this->cifrar_datos($datos_del_participante)), $datos_del_participante, $nombre_archivo_pdf);
        $this->guardar_documento();
        $id_documento = Document::select('id')->get();
        $this->vincular_documento_participante($id_documento,  $datos_del_participante);
        $this->enviar_documentos_por_correo($datos_del_participante);
        return response()->json([
            "documento" => "Documentos generados y enviados",
            "icono" => "success"
        ], 201);
        
        /*//esto si funcionó, recupera el nombre del participante del objeto participante.
        return response()->json([
            "documento" => $request->participante["Nombres"],
            "icono" => "success"
        ], 201);*/
    }


    //método que guardará el registro creado.
    public function guardar_documento(){
        //Separar el número de la extension png
        $folio_documento = explode('.', $this->getFolioDocumento());
        $numero =  $folio_documento[0];
        //verificar si el archivo existe
        $generado = (file_exists(public_path('archivos_pdf') . '/' . $this->getNombreArchivo()) ? True : False );
        $entregado = true;
        $archivo = $this->getNombreArchivo();
        $fechaGenerado = date('Y-m-d H:i:s');
        $fechaEntregado = date('Y-m-d H:i:s');

        Document::create([
            'number' => $numero,
            'generated' => $generado,
            'delivered' => $entregado,
            'archive' => $archivo,
            'dateGenerated' => $fechaGenerado,
            'deliveryDate' => $fechaEntregado
        ]);
    }


    /**
     * Validación del documento de participación digital.
     * @OA\Get(
     *     path="/api/documents",
     *     tags={"Documentos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="cadena",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="Nombres", type="string", example="Luis Mario"),
     *             @OA\Property(property="ApellidoPaterno", type="string", example="Pérez"),
     *             @OA\Property(property="ApellidoMaterno", type="string", example="Ramírez"),
     *             @OA\Property(property="Evento", type="string", example="Academia Journals"),
     *             @OA\Property(property="Descripcion", type="text", example="Espacio de trabajo que da a conocer los resultados de trabajos de investigación."),
     *             @OA\Property(property="TipoParticipante", type="string", example="Ponente"),
     *             @OA\Property(property="FechaTermino", type="datetime", example="2024-05-29 17:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Los datos no coinciden"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */


    public function decifrar_documento($cadena){
        $cadena_decifrada = $this->decifrar_cadena($cadena);
        return response()->json(json_decode($cadena_decifrada));  
    }
    

    public function vincular_documento_participante($id_documento, $id_usuario){
        $id_documento_participante = $id_documento->toArray();
        foreach($id_documento_participante as $id){
             EventUser::where('id', $id_usuario["id"])->update(['document_id' => $id["id"]]);
        }
    }


    //Enviar los documentos de participación
    public function enviar_documentos_por_correo($body){
        $pdf = public_path('archivos_pdf') . '/' . $this->getNombreArchivo();
        Mail::to($body["Correo"])->send(new EnviarCorreos($pdf, $body));
    }

   
    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
