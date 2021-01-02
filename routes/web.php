<?php

/** @var Router $router */
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// LAUNCH
$router->get('/launch/upcoming', ['uses' => 'LaunchController@getUpcomingLaunches', 'as' => 'Launch@getUpcomingLaunches']);
$router->get('/launch/previous', ['uses' => 'LaunchController@getPreviousLaunches', 'as' => 'Launch@getPreviousLaunches']);
$router->get('/launch/unpublished', ['uses' => 'LaunchController@getUnpublishedLaunches', 'as' => 'Launch@getUnpublishedLaunches', 'middleware' => 'admin']); // admin // todo
$router->get('/launch/search', ['uses' => 'LaunchController@searchLaunches', 'as' => 'Launch@searchLaunches']); // todo
$router->post('/launch', ['uses' => 'LaunchController@createLaunch', 'as' => 'Launch@createLaunch', 'middleware' => 'admin']); // admin // todo
$router->get('/launch/{launch}', ['uses' => 'LaunchController@getLaunch', 'as' => 'Launch@getLaunch']);
$router->post('/launch/{launch}', ['uses' => 'LaunchController@updateLaunch', 'as' => 'Launch@updateLaunch', 'middleware' => 'admin']); // admin // todo
$router->delete('/launch/{launch}', ['uses' => 'LaunchController@deleteLaunch', 'as' => 'Launch@deleteLaunch', 'middleware' => 'admin']); // admin // todo

$router->get('/launch/provider/{provider}', ['uses' => 'LaunchController@getLaunchesByProvider', 'as' => 'Launch@getLaunchesByProvider']);
$router->get('/launch/rocket/{rocket}', ['uses' => 'LaunchController@getLaunchesByRocket', 'as' => 'Launch@getLaunchesByRocket']);
$router->get('/launch/pad/{pad}', ['uses' => 'LaunchController@getLaunchesByPad', 'as' => 'Launch@getLaunchesByPad']);

// Rocket
$router->get('/rocket', ['uses' => 'RocketController@getRockets', 'as' => 'Rocket@getRockets']);
$router->post('/rocket', ['uses' => 'RocketController@createRocket', 'as' => 'Rocket@createRocket', 'middleware' => 'admin']); // admin // todo
$router->get('/rocket/{rocket}', ['uses' => 'RocketController@getRocket', 'as' => 'Rocket@getRocket']);
$router->post('/rocket/{rocket}', ['uses' => 'RocketController@updateRocket', 'as' => 'Rocket@updateRocket', 'middleware' => 'admin']); // admin // todo
$router->delete('/rocket/{rocket}', ['uses' => 'RocketController@deleteRocket', 'as' => 'Rocket@deleteRocket', 'middleware' => 'admin']); // admin // todo

// Provider
$router->get('/provider', ['uses' => 'ProviderController@getProviders', 'as' => 'Provider@getProviders']);
$router->post('/provider', ['uses' => 'ProviderController@createProvider', 'as' => 'Provider@createProvider', 'middleware' => 'admin']); // admin // todo
$router->get('/provider/{provider}', ['uses' => 'ProviderController@getProvider', 'as' => 'Provider@getProvider']);
$router->post('/provider/{provider}', ['uses' => 'ProviderController@updateProvider', 'as' => 'Provider@updateProvider', 'middleware' => 'admin']); // admin // todo
$router->delete('/provider/{provider}', ['uses' => 'ProviderController@deleteProvider', 'as' => 'Provider@deleteProvider', 'middleware' => 'admin']); // admin // todo

// Pad
$router->get('/pad', ['uses' => 'PadController@getPads', 'as' => 'Pad@getPads']); // todo
$router->post('/pad', ['uses' => 'PadController@createPad', 'as' => 'Pad@createPad', 'middleware' => 'admin']); // admin // todo
$router->get('/pad/{pad}', ['uses' => 'PadController@getPad', 'as' => 'Pad@getPad']); // todo
$router->post('/pad/{pad}', ['uses' => 'PadController@updatePad', 'as' => 'Pad@updatePad', 'middleware' => 'admin']); // admin // todo
$router->delete('/pad/{pad}', ['uses' => 'PadController@deletePad', 'as' => 'Pad@deletePad', 'middleware' => 'admin']); // admin // todo

