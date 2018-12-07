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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api', 'namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    $api->get('version', function () {
        return response('this is version v1');
    });
    $api->get('exception', function () {
        throw new Exception('this is exception');
    });
    $api->get('users/{id}', ['as' => 'users.show', 'uses'=>'UserController@show']);
    $api->get('users', ['as' => 'users.index', 'uses'=>'UserController@index']);
});


$api->version('v2', function ($api) {
    $api->get('version', function () {
        return response('this is version v2');
    });
});
