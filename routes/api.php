<?php

use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */


$router->post('/user/register', RegisterController::class);
$router->post('/user/sign-in', LoginController::class);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/user/companies', Companies\CompaniesController::class);
    $router->post('/user/companies', Companies\AddCompanyController::class);
});



