<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\C1;
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