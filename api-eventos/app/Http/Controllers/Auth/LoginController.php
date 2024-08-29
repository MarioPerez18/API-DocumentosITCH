<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Autenticar al usuario.
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="juan@gmail.com"),
     *             @OA\Property(property="password", type="string", example="juan12345")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="5|fdervsdvsd43dfbsdsd"),
     *             @OA\Property(property="role", type="string", example="participante"),
     *             @OA\Property(property="user", type="string", example="Luis Mario"),
     *             @OA\Property(property="user_id", type="integer", example="5"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la solicitud",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="correo y/o contraseña incorrectos")
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

        if(!auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status' => 'error',
                'message' => 'correo y/o contraseña incorrectos'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        //$data['token'] = $user->createToken($request->email)->plainTextToken;
        //$data['user'] = $user;

        $response = [
        
            'token' => $user->createToken($request->email)->plainTextToken,
            'role' => $user->role,
            'user' => $user->names,
            'user_id' => $user->id
        ];

        return response()->json($response, 200);

    }
}
