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

Route::group([    
    'prefix' => 'users',
    'middleware' => 'cors'
], function () {  
    Route::get('list', 'UsuarioController@list');  
    Route::post('create', 'UsuarioController@create');
    Route::delete('delete/{id}', 'UsuarioController@delete');
    Route::put('edit/{id}', 'UsuarioController@edit');
});
