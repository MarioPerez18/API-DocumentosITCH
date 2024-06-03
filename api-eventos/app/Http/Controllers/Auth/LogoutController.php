<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LogoutController extends Controller
{

     /**
     * Log out the user from application.
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
