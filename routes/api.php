<?php

use Illuminate\Http\Request;

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

Route::get('offices', function(){
    $office = \App\Model\Office::all();
    return  \App\Http\Resources\OfficeResource::collection($office);
});

Route::get('specifiers', function(){
    $specifier = \App\Model\Specifier::all();
    return  \App\Http\Resources\SpecifierResource::collection($specifier);
});