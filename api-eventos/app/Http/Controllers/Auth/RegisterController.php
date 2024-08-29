<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
     /**
     * Registra a un nuevo usuario.
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="paternalSurname", type="string", example="Pérez"),
     *             @OA\Property(property="maternalSurname", type="string", example="Ramírez"),
     *             @OA\Property(property="names", type="string", example="Luis Mario"),
     *             @OA\Property(property="gender", type="string", example="H"),
     *             @OA\Property(property="phoneNumber", type="string", example="9831456152"),
     *             @OA\Property(property="email", type="string", example="mario@gmail.com"),
     *             @OA\Property(property="password", type="string", example="mario98321"),
     *             @OA\Property(property="institution_id", type="integer", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="5|fdervsdvsd43dfbsdsd"),
     *             @OA\Property(property="paternalSurname", type="string", example="Pérez"),
     *             @OA\Property(property="maternalSurname", type="string", example="Ramírez"),
     *             @OA\Property(property="names", type="string", example="Luis Mario"),
     *             @OA\Property(property="gender", type="string", example="H"),
     *             @OA\Property(property="phoneNumber", type="string", example="9831456152"),
     *             @OA\Property(property="email", type="string", example="mario@gmail.com"),
     *             @OA\Property(property="password", type="string", example="mario98321"),
     *             @OA\Property(property="institution_id", type="integer", example="1")
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(RegistroRequest $request){

        $data = $request->validated(); 
        $user = User::create([
            'paternalSurname' => $data['paternalSurname'],
            'maternalSurname' => $data['maternalSurname'],
            'names' => $data['names'],
            'gender' => $data['gender'],
            'phoneNumber' => $data['phoneNumber'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'institution_id' => $data['institution_id']
        ]);

        $response = [
            'token' => $user->createToken($data['email'])->plainTextToken,
            'role' => 'participante',
            'user' => $user->names,
            'user_id' => $user->id
        ];

        return response()->json($response, 201);

    }
}
