<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipantController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\ParticipantTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//rutas publicas
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::get('/institutions', [InstitutionController::class, 'index']);
Route::get('/validation/{cadena}', [DocumentController::class, 'decifrar_documento']);



Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/logout', [LogoutController::class, 'store']);
    Route::apiResources([
        'events' => EventController::class,
        'documents' => DocumentController::class,
        'participant-types' => ParticipantTypeController::class,
        'participant-event' => EventParticipantController::class,
        'users' => UserController::class   
    ]);
});




