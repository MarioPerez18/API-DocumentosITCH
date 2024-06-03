<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Authenticate the user.
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
            'user' => $user
        ];

        return response()->json($response, 200);

    }
}
