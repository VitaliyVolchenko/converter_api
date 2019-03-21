<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::post('/conv', function (Request $request){
    return response()->json(['mes'=>$request->input('number')]);
}); */

// converter
Route::post('/converter', 'ConverterController@converter');