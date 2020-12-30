<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// LAUNCH
$router->get('/launch/upcoming', ['uses' => 'LaunchController@getUpcomingLaunches', 'as' => 'Launch@getUpcomingLaunches']);
$router->get('/launch/previous', ['uses' => 'LaunchController@getPreviousLaunches', 'as' => 'Launch@getPreviousLaunches']);
$router->get('/launch/search', ['uses' => 'LaunchController@searchLaunches', 'as' => 'Launch@searchLaunches']);
$router->post('/launch', ['uses' => 'LaunchController@createLaunch', 'as' => 'Launch@createLaunch']);
$router->get('/launch/{launch}', ['uses' => 'LaunchController@getLaunch', 'as' => 'Launch@getLaunch']);
$router->post('/launch/{launch}', ['uses' => 'LaunchController@updateLaunch', 'as' => 'Launch@updateLaunch']);
$router->delete('/launch/{launch}', ['uses' => 'LaunchController@deleteLaunch', 'as' => 'Launch@deleteLaunch']);
$router->get('/launch/provider/{provider}', ['uses' => 'LaunchController@getLaunchesByProvider', 'as' => 'Launch@getLaunchesByProvider']);
$router->get('/launch/rocket/{rocket}', ['uses' => 'LaunchController@getLaunchesByRocket', 'as' => 'Launch@getLaunchesByRocket']);
$router->get('/launch/pad/{pad}', ['uses' => 'LaunchController@getLaunchesByPad', 'as' => 'Launch@getLaunchesByPad']);

// Rocket
$router->get('/rocket', ['uses' => 'RocketController@getRockets', 'as' => 'Rocket@getRockets']);
$router->post('/rocket', ['uses' => 'RocketController@createRocket', 'as' => 'Rocket@createRocket']);
$router->get('/rocket/{rocket}', ['uses' => 'RocketController@getRocket', 'as' => 'Rocket@getRocket']);
$router->post('/rocket/{rocket}', ['uses' => 'RocketController@updateRocket', 'as' => 'Rocket@updateRocket']);

// Provider
$router->get('/provider', ['uses' => 'ProviderController@getProviders', 'as' => 'Provider@getProviders']);
$router->post('/provider', ['uses' => 'ProviderController@createProvider', 'as' => 'Provider@createProvider']);
$router->get('/provider/{provider}', ['uses' => 'ProviderController@getProvider', 'as' => 'Provider@getProvider']);
$router->post('/provider/{provider}', ['uses' => 'ProviderController@updateProvider', 'as' => 'Provider@updateProvider']);

