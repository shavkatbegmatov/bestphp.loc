<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Repository\UserRepository;
use App\Repository\RoleRepository;
use App\Repository\PermissionRepository;
use App\Repository\ModuleRepository;

$router = new Router();

$router->get('/', function () {
    return 'Добро пожаловать в JCore!';
});

$router->get('/users', function () {
    $repo = new UserRepository();
    return json_encode($repo->all());
});

$router->get('/roles', function () {
    $repo = new RoleRepository();
    return json_encode($repo->all());
});

$router->get('/permissions', function () {
    $repo = new PermissionRepository();
    return json_encode($repo->all());
});

$router->get('/modules', function () {
    $repo = new ModuleRepository();
    return json_encode($repo->all());
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);