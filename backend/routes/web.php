<?php

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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['namespace' => 'Auth'], function () use ($router) {
        $router->post("/authenticate", 'LoginController@login');
    });

    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        $router->group(['namespace' => 'Auth'], function () use ($router) {
            $router->group(['prefix' => 'auth'], function () use ($router) {
                $router->get("/logout", 'LoginController@logout');
            });
        });
        $router->group(['namespace' => 'User'], function () use ($router) {

            $router->group(['prefix' => 'user'], function () use ($router) {
                $router->get("/{id}", 'UserController@getById');
                $router->put('/edit/{id}', 'UserController@update');
            });
        });
        $router->group(['namespace' => 'Trabalhos'], function () use ($router) {
            $router->group(['prefix' => 'trabalhos'], function () use ($router) {
                $router->get('/{user_id}', 'TrabalhosController@index');
                $router->post('/register', 'TrabalhosController@create');
                
            });
        });
    });
});
