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
Route::prefix('v1')->group(function(){
    Route::group(['middleware' => 'auth:api'], function(){
        Route::apiResource('offices','OfficeController');
        Route::apiResource('specifiers','SpecifierController');
        Route::post('specifiers/unlink','SpecifierController@unlinkOffice')->name('specifiers.unlinkOffice');
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
});
