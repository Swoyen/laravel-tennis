<?php

use App\Http\Controllers\AttributesController;
use App\Http\Controllers\RankingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('rankings', RankingController::class);

Route::get('dates', [AttributesController::class, 'dates']);
Route::get('genders', [AttributesController::class, 'genders']);
Route::get('countries', [AttributesController::class, 'countries']);
Route::get('types', [AttributesController::class, 'types']);
