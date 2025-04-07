<?php

namespace App;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (!self::$instance) {
            try {
                self::$instance = new PDO('mysql:host=127.0.0.1;dbname=goodphp;charset=utf8mb4', 'root', '');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('DB connection error: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
