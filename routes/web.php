<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\StatistikController::class, 'index']);
Route::get('/actor', [App\Http\Controllers\ActorController::class, 'index']);
Route::get('/flag', [App\Http\Controllers\FlagofshipController::class, 'index']);
Route::get('/incidenttype', [App\Http\Controllers\IncidenttypeController::class, 'index']);
Route::get('/nighttype', [App\Http\Controllers\NighttypeController::class, 'index']);
Route::get('/perpetrator', [App\Http\Controllers\PerpetratorsController::class, 'index']);
Route::get('/stolen', [App\Http\Controllers\StolenpropertyController::class, 'index']);
Route::get('/tanggal', [App\Http\Controllers\TanggalController::class, 'index']);
Route::get('/time', [App\Http\Controllers\TimeofincidentController::class, 'index']);
Route::get('/treatment', [App\Http\Controllers\TreatmentofcrewController::class, 'index']);
Route::get('/typeofship', [App\Http\Controllers\TypeofshipController::class, 'index']);
Route::get('/weapon', [App\Http\Controllers\WeaponController::class, 'index']);
Route::get('/country', [App\Http\Controllers\CountryController::class, 'index']);
