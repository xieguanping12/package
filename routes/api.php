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
$dispatcher = app('Dingo\Api\Dispatcher');

$api->version('v1', [/*'middleware' => 'api.auth','providers' => ['basic', 'jwt'],*/ 'namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    $api->get('version', function () {
        return response('this is version v1');
    });
    $api->get('exception', function () {
        throw new Exception('this is exception');
    });
    $api->get('users/{id}', ['as' => 'users.show', 'uses'=>'UserController@show']);
    $api->get('users', ['as' => 'users.index', 'uses'=>'UserController@index']);
    $api->put('user/{id}', function ($id){
        if ($id > 10) {
            throw new \Symfony\Component\HttpKernel\Exception\ConflictHttpException('id two big exception');
        }
    });
    $api->post('users', function () {
        $rules = [
            'username' => ['required','alpha'],
            'password' => ['required','min:7'],
        ];
        $payload = app('request')->only('username','password');
        $validator = app('validator')->make($payload,$rules);
        if ($validator->fails()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('could not create user',$validator->errors());
        }
    });
});


$api->version('v2', function ($api) {
    $api->get('version', function () {
        return response('this is version v2');
    });
});

Route::get('/', function () use ($dispatcher) {
   $users = $dispatcher->get('api/users');
   return View::make('index')->with('users',$users);
});
