<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix'=>'todo'],function () use ($router)
{
    $router->post('delete/{id}','Controller@delete');
    $router->get('update/{id}','Controller@update');
    $router->get('index','Controller@index');
    $router->post('store','Controller@store');
    //$router->get('/login/[{id}]','Controller@getLogin');
    //$router->post('/login','Controller@postLogin');
});




