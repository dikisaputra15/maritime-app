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
Route::get('/flagactor', [App\Http\Controllers\FlagofshipactorController::class, 'index']);
Route::get('/incidenttype', [App\Http\Controllers\IncidenttypeController::class, 'index']);
Route::get('/nighttype', [App\Http\Controllers\NighttypeController::class, 'index']);
Route::get('/perpetrator', [App\Http\Controllers\PerpetratorsController::class, 'index']);
Route::get('/tanggal', [App\Http\Controllers\TanggalController::class, 'index']);
Route::get('/time', [App\Http\Controllers\TimeofincidentController::class, 'index']);
Route::get('/treatment', [App\Http\Controllers\TreatmentofcrewController::class, 'index']);
Route::get('/typeofship', [App\Http\Controllers\TypeofshipController::class, 'index']);
Route::get('/typeofshipactor', [App\Http\Controllers\TypeofshipactorController::class, 'index']);
Route::get('/weapon', [App\Http\Controllers\WeaponController::class, 'index']);
Route::get('/assaulted', [App\Http\Controllers\AssaultedtypeController::class, 'index']);
Route::get('/timetype', [App\Http\Controllers\TimeofincidenttypeController::class, 'index']);
Route::get('/region', [App\Http\Controllers\RegionController::class, 'index']);
Route::get('/injured', [App\Http\Controllers\InjuredController::class, 'index']);
Route::get('/fatality', [App\Http\Controllers\FatalityController::class, 'index']);
Route::get('/vesselloss', [App\Http\Controllers\VessellossController::class, 'index']);
Route::get('/propertyloss', [App\Http\Controllers\PropertylossController::class, 'index']);
Route::get('/articlelink', [App\Http\Controllers\ArticlelinkController::class, 'index']);
