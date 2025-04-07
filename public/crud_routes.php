<?php

use App\Middleware\AuthMiddleware;
use App\Database;

// --- USERS CRUD ---

$router->post('/users', function () {
    if (!AuthMiddleware::canCreate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    $password = $input['password'] ?? '';
    if (!$name || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Name and password are required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("INSERT INTO user (name, password, created_at, updated_at) VALUES (:name, :password, NOW(), NOW())");
    $stmt->execute(['name' => $name, 'password' => md5($password)]);
    echo json_encode(['message' => 'User created']);
});

$router->post('/users/{id}/update', function ($id) {
    if (!AuthMiddleware::canUpdate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? null;
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("UPDATE user SET name = :name, updated_at = NOW() WHERE id = :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    echo json_encode(['message' => 'User updated']);
});

$router->post('/users/{id}/delete', function ($id) {
    if (!AuthMiddleware::canDelete()) return;
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);
    echo json_encode(['message' => 'User deleted']);
});

// --- ROLES CRUD ---

$router->post('/roles', function () {
    if (!AuthMiddleware::canCreate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("INSERT INTO role (name) VALUES (:name)");
    $stmt->execute(['name' => $name]);
    echo json_encode(['message' => 'Role created']);
});

$router->post('/roles/{id}/update', function ($id) {
    if (!AuthMiddleware::canUpdate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("UPDATE role SET name = :name WHERE id = :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    echo json_encode(['message' => 'Role updated']);
});

$router->post('/roles/{id}/delete', function ($id) {
    if (!AuthMiddleware::canDelete()) return;
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("DELETE FROM role WHERE id = :id");
    $stmt->execute(['id' => $id]);
    echo json_encode(['message' => 'Role deleted']);
});

// --- MODULES CRUD ---

$router->post('/modules', function () {
    if (!AuthMiddleware::canCreate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("INSERT INTO module (name) VALUES (:name)");
    $stmt->execute(['name' => $name]);
    echo json_encode(['message' => 'Module created']);
});

$router->post('/modules/{id}/update', function ($id) {
    if (!AuthMiddleware::canUpdate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("UPDATE module SET name = :name WHERE id = :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    echo json_encode(['message' => 'Module updated']);
});

$router->post('/modules/{id}/delete', function ($id) {
    if (!AuthMiddleware::canDelete()) return;
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("DELETE FROM module WHERE id = :id");
    $stmt->execute(['id' => $id]);
    echo json_encode(['message' => 'Module deleted']);
});

// --- PERMISSIONS CRUD ---

$router->post('/permissions', function () {
    if (!AuthMiddleware::canCreate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("INSERT INTO permission (name) VALUES (:name)");
    $stmt->execute(['name' => $name]);
    echo json_encode(['message' => 'Permission created']);
});

$router->post('/permissions/{id}/update', function ($id) {
    if (!AuthMiddleware::canUpdate()) return;
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'] ?? '';
    if (!$name) {
        http_response_code(400);
        echo json_encode(['error' => 'Name is required']);
        return;
    }
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("UPDATE permission SET name = :name WHERE id = :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    echo json_encode(['message' => 'Permission updated']);
});

$router->post('/permissions/{id}/delete', function ($id) {
    if (!AuthMiddleware::canDelete()) return;
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("DELETE FROM permission WHERE id = :id");
    $stmt->execute(['id' => $id]);
    echo json_encode(['message' => 'Permission deleted']);
});