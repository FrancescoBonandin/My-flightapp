<?php

use App\Http\Controllers\api\AirportController;
use App\Http\Controllers\api\FlightController;
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

Route::get('/airports', [AirportController::class, 'index']);
Route::get('/flights', [FlightController::class, 'filtered']);
Route::get('/flight/{id}', [FlightController::class, 'getFlight']);
Route::post('/flight/{id}/reservation/submit', [FlightController::class, 'registerPassengers']);
