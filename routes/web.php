<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'penjualan'], function () use ($router) {
    $router->get('/', function () {
        return response()->json([
            [
                "id" => 1,
                "name" => "Abyan"
            ],
            [
                "id" => 2,
                "name" => "Bambang"
            ],
            [
                "id" => 3,
                "name" => "Chilie"
            ],
        ]);
    });
    $router->get('/{id}', function ($id) {
        return response()->json([
            "id" => $id,
            "name" => "Person",
            "Address" => "At Here"
        ]);
    });
    $router->post('/', function () {
        return response()->json([
            "msg" => "Success added",
        ]);
    });
    $router->put('/{id}', function (Request $request, $id) {
        $address = $request->input('address', 'At Earth');
        return response()->json([
            "id" => $id,
            "address" => $address,
        ]);
    });
    $router->delete('/{id}', function ($id) {
        return response()->json([
            "msg" => "Success deleted",
        ]);
    });
});
