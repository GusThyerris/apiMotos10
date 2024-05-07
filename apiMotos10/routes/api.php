<?php

use App\Http\Controllers\MotoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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

Route::get('/', function () {
    return 'API de motos da hora'.Response() -> json([],Response::HTTP_NO_CONTENT);
});
route::get('/motos', [MotoController::class, 'index']);
route::post('/motoscadastra', [MotoController::class, 'store']);