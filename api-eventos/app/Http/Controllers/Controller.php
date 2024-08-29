<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*             title="API Generación y Validación de documentos de participación", 
*             version="1.0",
*             description="Listado de rutas de la API"
* )
* @OA\Server(url="http://localhost:8000")
*/

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
