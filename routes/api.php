<?php

use App\Http\Controllers\Apilist;
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

Route::get('buku/{id?}', [Apilist::class,'buku']);
Route::get('datauser/{id?}', [Apilist::class,'datauser']);
Route::get('order/{id?}', [Apilist::class,'order']);
