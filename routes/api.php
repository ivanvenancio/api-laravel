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

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('offices', function(){
        $office = \App\Model\Office::paginate(10);
        return  \App\Http\Resources\OfficeResource::collection($office);
    });
    Route::get('offices/{office}', function(\App\Model\Office $office){    
        return  new \App\Http\Resources\OfficeResource($office);
    });
    
    Route::get('specifiers', function(){
        $specifier = \App\Model\Specifier::paginate(10);
        return  \App\Http\Resources\SpecifierResource::collection($specifier);
    });    

    Route::get('specifiers/{specifier}', function(\App\Model\Specifier $specifier){    
        return  new \App\Http\Resources\SpecifierResource($specifier);
    });
});

Route::post('login', function(Request $request){
    $data = $request->only('email', 'password');
    $token = \Auth::guard('api')->attempt($data);
    if(!$token){
        return response()->json([
            'error' => 'Credentials invalid'
            ], 400);
    }
    return ['token' => $token];
});