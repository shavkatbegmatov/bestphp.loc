<?php

namespace App\Middleware;

class AuthMiddleware {
    public static function check(): bool {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return false;
        }
        return true;
    }
}