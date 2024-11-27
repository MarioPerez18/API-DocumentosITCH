<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipantTypeController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InstitutionTypeController;
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
Route::get('/validacion/{cadena}', [DocumentController::class, 'decifrar_documento']);


Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/logout', [LogoutController::class, 'store']);
    Route::post('/user-event', [EventUserController::class, 'asignar_coordinador_a_evento']);
    Route::post('/institution', [InstitutionController::class, 'store']);
    Route::put('/update-institution/{institution}', [InstitutionController::class, 'update']);
    Route::delete('/institution/{institution}', [InstitutionController::class, 'destroy']);
    Route::put('/event-participant-type', [EventParticipantTypeController::class, 'asignar_tipos_participantes_a_eventos']);
    Route::get('/type_document/{tipo_participante}', [DocumentTypeController::class, 'plantilla_participante']);
    Route::apiResources([
        'events' => EventController::class,
        'documents' => DocumentController::class,
        'participant-types' => ParticipantTypeController::class,
        'participant-event' => EventUserController::class,
        'users' => UserController::class,
        'institution-type' => InstitutionTypeController::class,
        'document_type' => DocumentTypeController::class,
        'participant-type-document-type' => EventParticipantTypeController::class
    ]);
});




