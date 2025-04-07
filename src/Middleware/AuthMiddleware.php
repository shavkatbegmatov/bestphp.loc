<?php

namespace App\Middleware;

use App\Database;

class AuthMiddleware {
    public static function check(): bool {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return false;
        }
        return true;
    }

    public static function hasPermission(string $permissionName): bool {
        if (!self::check()) return false;

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT COUNT(*)
            FROM userrole ur
            JOIN rolepermission rp ON ur.role_id = rp.role_id
            JOIN permission p ON rp.permission_id = p.id
            WHERE ur.user_id = :user_id AND p.name = :permission
        ");
        $stmt->execute([
            'user_id' => $_SESSION['user_id'],
            'permission' => $permissionName
        ]);

        if ($stmt->fetchColumn() == 0) {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden: insufficient permission']);
            return false;
        }
        return true;
    }
}