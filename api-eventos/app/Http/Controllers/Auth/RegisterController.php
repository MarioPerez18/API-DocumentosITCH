<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
     /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $request->validate([
            'paternalSurname' => 'required',
            'maternalSurname' => 'required',
            'names' => 'required|min:4|max:30',
            'gender' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            'institutions_id' => 'required'
        ]);

        
        $user = User::create([
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
            'names' => $request->names,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'institutions_id' => $request->institutions_id
        ]);

        //$data['token'] = $user->createToken($request->email)->plainTextToken;
        //$data['user'] = $user;

        $response = [
            'token' => $user->createToken($request->email)->plainTextToken,
            'user' => $user
        ];

        return response()->json($response, 201);

    }
}
