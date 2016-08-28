<?php
// Routes


// WEB

$app->get('[/]', 'App\Route\Login:get');
$app->get('/login', 'App\Route\Login:get');

$app->get('/logout', 'App\Route\Logout:get');

$app->get('/agenda[/data/{dt:\d\d\d\d-\d\d-\d\d}]', 'App\Route\Agenda:get');
$app->get('/agenda/consultorio/{id:\d+}/data/{dt:\d\d\d\d-\d\d-\d\d}', 'App\Route\Agenda\Consultorio:get');


// API

$app->post('/api-v1/auth/login', 'App\Route\API\Auth\Login:post');
$app->get('/api-v1/auth/logout', 'App\Route\API\Auth\Logout:get');
