<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LogoutController extends Controller
{

     /**
     * Cierre de sesión del usuario.
     * @OA\Get(
     *     path="/api/logout",
     *     tags={"Usuarios"},
     *     security={{"sanctum":{}}},
     *    
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(property="mensaje", type="string", example="User is logged out successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error en la solicitud",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){

        auth()->user()->tokens()->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'User is logged out successfully'
        ], 200);
     }
}
