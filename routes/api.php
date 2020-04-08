<?php

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

Route::get('/ping/{uuid}', 'ApiController@ping')->name('ping');
Route::post('/ping/{uuid}', 'ApiController@ping')->name('ping');
Route::post('/api/templates/{slug}', 'Api\TemplateController@store')->name('api.template.create_job');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/api/cronjob', 'Api\CronjobController@index')->name('api.cronjob.index');
    Route::get('/api/cronjob/{uuid}', 'Api\CronjobController@show')->name('api.cronjob.show');
    Route::post('/api/cronjob/{uuid}', 'Api\CronjobController@update')->name('api.cronjob.update');
    Route::post('/api/cronjob/{uuid}/silence', 'Api\CronjobController@silence')->name('api.cronjob.silence');
    Route::post('/api/cronjob/{uuid}/silence', 'Api\CronjobController@unsilence')->name('api.cronjob.unsilence');
});

// DELETE job/{uuid}?token={token} -- delete a given job


Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');