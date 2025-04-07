<?php

use App\Middleware\AuthMiddleware;
use App\Database;

// POST /users - создание пользователя (create)
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
    $stmt->execute([
        'name' => $name,
        'password' => md5($password)
    ]);

    echo json_encode(['message' => 'User created']);
});

// PUT /users/{id} - обновление пользователя (update)
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

// DELETE /users/{id} - удаление пользователя (delete)
$router->post('/users/{id}/delete', function ($id) {
    if (!AuthMiddleware::canDelete()) return;

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo json_encode(['message' => 'User deleted']);
});
