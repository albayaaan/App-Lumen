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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
    $router->get('/{id}/confirm', ['middleware' => 'auth', function (Request $request, $id) {
        $user = $request->user();

        Log::debug($user);
        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
        }
        return response()->json([
            "msg" => "Confirmed",
        ]);
    }]);
    $router->get('/{id}/send-email', function (Request $request, $id) {
        $user = $request->user();
        Mail::raw('This is the email body', function ($message) {
            $message->to('albayaaan.z@gmail.com')->subject('Lumen email test');
        });
        return response()->json([
            "msg" => "Email Success",
        ]);
    });
});
