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

$router->group(['prefix' => 'file'], function () use ($router) {
    $router->post("upload", [
        'as' => 'upload',
        'uses' => 'FileController@store',
    ]);

    $router->get("/{slug}", [
        'as' => 'show',
        'uses' => 'FileController@show',
    ]);
});