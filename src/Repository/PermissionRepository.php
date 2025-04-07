<?php

namespace App\Repository;

use App\Database;
use App\Entity\Permission;
use PDO;

class PermissionRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function find(int $id): ?Permission {
        $stmt = $this->db->prepare("SELECT * FROM permission WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new Permission(...$data) : null;
    }

    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM permission");
        return array_map(fn($row) => new Permission(...$row), $stmt->fetchAll());
    }

    // public function create(Permission $permission): bool {
    //     $stmt = $this->db->prepare("INSERT INTO permission (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)");
    //     return $stmt->execute([
    //         'name' => $permission->name,
    //         'created_at' => date('Y-m-d H:i:s'),
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ]);
    // }
}