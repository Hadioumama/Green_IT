<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========== ÉTUDIANT 1 : AUTHENTIFICATION (NE PAS TOUCHER) ==========

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== ÉTUDIANT 1 : DASHBOARD (NE PAS TOUCHER) ==========

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// ========== ÉTUDIANT 2 : DEVICES + ENERGY (TA PARTIE) ==========

Route::middleware('auth')->group(function () {
    Route::get('/devices/a-remplacer', [DeviceController::class, 'aRemplacer'])->name('devices.remplacer');
    // Devices CRUD complet
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
    Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/devices/{device}', [DeviceController::class, 'show'])->name('devices.show');
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');

    // Energy (consommation)
    Route::get('/energy', [EnergyController::class, 'indexWeb'])->name('energy.index');
    Route::get('/energy/create', [EnergyController::class, 'createWeb'])->name('energy.create');
    Route::post('/energy', [EnergyController::class, 'storeWeb'])->name('energy.store');
});
Route::get('/profile', function () {
    return view('layouts.profile');
})->middleware('auth')->name('profile');
Route::patch('/profile', function (Illuminate\Http\Request $request) {
    $user = Auth::user();

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return back()->with('success', 'Profil mis à jour avec succès !');

})->middleware('auth')->name('profile.update');