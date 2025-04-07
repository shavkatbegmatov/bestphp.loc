<?php

namespace App\Repository;

use App\Database;
use App\Entity\User;
use PDO;

class UserRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function find(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new User(...$data) : null;
    }

    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM user");
        return array_map(fn($row) => new User(...$row), $stmt->fetchAll());
    }

    // public function create(User $user): bool {
    //     $stmt = $this->db->prepare("INSERT INTO user (name, password, created_at, updated_at) VALUES (:name, :password, :created_at, :updated_at)");
    //     return $stmt->execute([
    //         'name' => $user->name,
    //         'password' => password_hash($user->password, PASSWORD_BCRYPT),
    //         'created_at' => date('Y-m-d H:i:s'),
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ]);
    // }
}