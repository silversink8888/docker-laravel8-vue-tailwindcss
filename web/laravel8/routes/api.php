<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\NoteController;
use App\Http\Controllers\MoneyController;

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

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
    Route::post('product/upload', 'ProductController@upload');

    Route::apiResources([
        'user' => 'UserController',
        'product' => 'ProductController',
        'category' => 'CategoryController',
        'tag' => 'TagController',
    ]);
});



Route::namespace('App\\Http\\Controllers')->group(function () {

    Route::get( '/money', [MoneyController::class, 'index']);
//    Route::get('/money','MoneyController@index');
    Route::post('/money','MoneyController@store');
    Route::get( '/money/{money}', [MoneyController::class, 'show']);
    Route::put( '/money/edit/{money}' ,[MoneyController::class, 'update']);

    Route::delete('/money/{money}',[MoneyController::class, 'destroy']);

    Route::apiResources([
        'money' => 'MoneyController',
    ]);

});

/*
Route::get('/tasks', 'App\Http\Controllers\TaskController@index');
//Route::post('/tasks', 'App\Http\Controllers\TaskController@store');
Route::post('/tasks', 'App\Http\Controllers\TaskController@store');

Route::get('/tasks/{task}', 'App\Http\Controllers\TaskController@show');
Route::put('/tasks/{task}', 'App\Http\Controllers\TaskController@update');
Route::delete('/tasks/{task}', 'App\Http\Controllers\TaskController@destroy');
*/





