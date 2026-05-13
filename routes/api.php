<?php

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




//PARTIE ETUDIANT 2 
use App\Http\Controllers\EnergyController;

Route::get('/total-consumption', [EnergyController::class, 'totalConsumption']);
Route::get('/co2', [EnergyController::class, 'carbonEmission']);
Route::get('/by-device', [EnergyController::class, 'byDevice']);