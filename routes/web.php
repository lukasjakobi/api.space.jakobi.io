<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// LAUNCH
$router->get('/launch', ['uses' => 'LaunchController@getLaunches', 'as' => 'Launch@getLaunches']);
$router->post('/launch', ['uses' => 'LaunchController@createLaunch', 'as' => 'Launch@createLaunch']);
$router->get('/launch/{uuid}', ['uses' => 'LaunchController@getLaunch', 'as' => 'Launch@getLaunch']);
$router->post('/launch/{uuid}', ['uses' => 'LaunchController@updateLaunch', 'as' => 'Launch@updateLaunch']);
$router->post('/launch/provider/{uuid}', ['uses' => 'LaunchController@getLaunchesByProvider', 'as' => 'Launch@getLaunchesByProvider']);
$router->post('/launch/rocket/{uuid}', ['uses' => 'LaunchController@getLaunchesByRocket', 'as' => 'Launch@getLaunchesByRocket']);
$router->post('/launch/pad/{uuid}', ['uses' => 'LaunchController@getLaunchesByPad', 'as' => 'Launch@getLaunchesByPad']);

// Rocket
$router->get('/rocket', ['uses' => 'RocketController@getRockets', 'as' => 'Launch@getLaunches']);
$router->post('/rocket', ['uses' => 'RocketController@createRocket', 'as' => 'Launch@createLaunch']);
$router->get('/rocket/{uuid}', ['uses' => 'RocketController@getRocket', 'as' => 'Launch@getLaunch']);
$router->post('/rocket/{uuid}', ['uses' => 'RocketController@updateLaunch', 'as' => 'Launch@updateLaunch']);

