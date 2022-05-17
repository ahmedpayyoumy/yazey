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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'as' => 'api.'
], function () {
    Route::group([
        'prefix' => 'image',
        'as' => 'image.'
    ], function () {
        Route::post('upload', 'ImageController@upload')->name('upload');
    });
});

// Route::post('/facebook/broadcast/send', 'FacebookMessageController@sendBroadcastMessage');
