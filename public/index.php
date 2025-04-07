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
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new UserRepository();
    return json_encode($repo->all());
});

$router->get('/users/{id}', function ($id) {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new UserRepository();
    $user = $repo->find((int) $id);
    if (!$user) {
        http_response_code(404);
        return json_encode(['error' => 'User not found']);
    }
    return json_encode($user);
});

$router->get('/roles', function () {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new RoleRepository();
    return json_encode($repo->all());
});

$router->get('/roles/{id}', function ($id) {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new RoleRepository();
    $role = $repo->find((int) $id);
    if (!$role) {
        http_response_code(404);
        return json_encode(['error' => 'Role not found']);
    }
    return json_encode($role);
});

$router->get('/permissions', function () {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new PermissionRepository();
    return json_encode($repo->all());
});

$router->get('/permissions/{id}', function ($id) {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new PermissionRepository();
    $perm = $repo->find((int) $id);
    if (!$perm) {
        http_response_code(404);
        return json_encode(['error' => 'Permission not found']);
    }
    return json_encode($perm);
});

$router->get('/modules', function () {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new ModuleRepository();
    return json_encode($repo->all());
});

$router->get('/modules/{id}', function ($id) {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        return json_encode(['error' => 'Unauthorized']);
    }
    $repo = new ModuleRepository();
    $mod = $repo->find((int) $id);
    if (!$mod) {
        http_response_code(404);
        return json_encode(['error' => 'Module not found']);
    }
    return json_encode($mod);
});

$router->post('/auth/login', function () {
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    $password = $input['password'] ?? '';

    $repo = new UserRepository();
    $users = $repo->all();

    foreach ($users as $user) {
        if ($user->name === $name && $user->password === md5($password)) {
            $_SESSION['user_id'] = $user->id;
            return json_encode(['message' => 'Login successful', 'user_id' => $user->id]);
        }
    }

    http_response_code(401);
    return json_encode(['error' => 'Invalid credentials']);
});

$router->post('/auth/logout', function () {
    session_destroy();
    return json_encode(['message' => 'Logged out']);
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
