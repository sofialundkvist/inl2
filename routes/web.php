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

$router->get('/stores', function() {
    return "Lista butiker";
});

$router->post('/reviews', function() {
    return "Lista recensioner";
});
