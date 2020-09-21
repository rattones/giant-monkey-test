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


// $router->get('/home', 'HelloWorld@say');

// Clients
$router->post('/clients', 'ClientsController@create');
$router->get('/clients', 'ClientsController@get');
$router->get('/clients/{id}', 'ClientsController@get');

// Processors
$router->post('/processors', 'ProcessorsController@create');
$router->get('/processors/{id}', 'ProcessorsController@get');

// Jobs
$router->post('/jobs', 'JobsController@create');
$router->put('/jobs/{id}', 'JobsController@update');
$router->get('/jobs', 'JobsController@get');
$router->get('/jobs/{id}', 'JobsController@get');
$router->get('/jobs/getStatus/{id}', 'JobsController@getStatus');

// Picking a job
$router->get('/pick', 'JobsController@pickJob');
$router->patch('/done/{id}', 'JobsController@setJobDone');
