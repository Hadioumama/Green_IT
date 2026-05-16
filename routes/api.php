<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnergyController;

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

// ========== ÉTUDIANT 2 : API ENERGY ==========

Route::get('/total-consumption', [EnergyController::class, 'totalConsumption']);
Route::get('/co2', [EnergyController::class, 'carbonEmission']);
Route::get('/by-device', [EnergyController::class, 'byDevice']);