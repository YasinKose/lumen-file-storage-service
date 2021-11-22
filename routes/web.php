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

$router->post("upload-file", [
    'as' => 'upload-file', 'uses' => 'FileUploadController@uploadFile',
]);
$router->post("create-temporary/{id}", [
    'as' => 'create-temporary', 'uses' => 'TemporaryUrlController@create'
]);
$router->post("create-temporaries", [
    'as' => 'create-temporaries', 'uses' => 'TemporaryUrlController@creates'
]);

$router->get("file/{slug}", [
    'as' => 'show-file', 'uses' => 'TemporaryUrlController@show'
]);
$router->get("file-download/{slug}", [
    'as' => 'download-file', 'uses' => 'TemporaryUrlController@download'
]);
