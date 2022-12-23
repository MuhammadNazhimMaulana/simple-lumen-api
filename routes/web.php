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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Index
$router->get('/qr', ['uses' => 'Api\QRController@index']);

$router->group(['prefix' => 'api'], function() use ($router){
    // Category
    $router->group(['prefix' => 'category'], function () use ($router){
        $router->get('/', ['uses' => 'Api\CategoryController@index']);
        $router->get('/{id}', ['uses' => 'Api\CategoryController@show']);
        $router->post('/', ['uses' => 'Api\CategoryController@create']);
        $router->put('/{id}', ['uses' => 'Api\CategoryController@update']);
        $router->delete('/{id}', ['uses' => 'Api\CategoryController@delete']);
    });

    // Food
    $router->group(['prefix' => 'food'], function () use ($router){
        $router->get('/', ['uses' => 'Api\FoodController@index']);
        $router->get('/{id}', ['uses' => 'Api\FoodController@show']);
        $router->post('/', ['uses' => 'Api\FoodController@create']);
        $router->put('/{id}', ['uses' => 'Api\FoodController@update']);
        $router->delete('/{id}', ['uses' => 'Api\FoodController@delete']);
    });
});
