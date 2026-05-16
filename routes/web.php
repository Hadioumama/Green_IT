<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/{n}', function ($n) {
return view($n);
});
*/
//parametre facultatif
/*Route::get('/test/OUMAMA/{m?}', function ($m='p123') {
    echo "je suis la page".$m;
});
Route::get('/oumama',[ oumamacontroller::class,'test']);
Route::view('/hell','hello');
Route::view('/index', 'welcome', ['id' => 100]);
Route::get('/pp','App\Http\Controllers\C1@test');
Route::get('/pp/{x}/{y}','App\Http\Controllers\C1@calcul');
Route::get('/home', function () {
   return view('home');
});
Route::view('/contact','contact')->Middleware('testM');
Route::get('/data','App\Http\Controllers\C1@getdata');*/
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    // Auth::user() récupère l'utilisateur connecté
return view('dashboard', ['user' => Auth::user()]);
})->middleware('auth'); // ← Bloque l'accès si non connecté
Route::get('/dashboard', function () {
    return view('dashboard', ['user' => Auth::user()]);
})->middleware('auth');
 Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
    Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/devices/{device}', [DeviceController::class, 'show'])->name('devices.show');
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
