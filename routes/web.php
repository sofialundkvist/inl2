<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/products', 'ProductsController@index');

$router->get('/products/{id}', 'ProductsController@show');

$router->post('/products', 'ProductsController@create');

$router->get('/stores', 'StoresController@index');

$router->get('/reviews', 'ReviewsController@index');
