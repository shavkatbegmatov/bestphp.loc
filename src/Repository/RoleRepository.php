<?php

namespace App\Repository;

use App\Database;
use App\Entity\Role;
use PDO;

class RoleRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function find(int $id): ?Role {
        $stmt = $this->db->prepare("SELECT * FROM role WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new Role(...$data) : null;
    }

    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM role");
        return array_map(fn($row) => new Role(...$row), $stmt->fetchAll());
    }

    // public function create(Role $role): bool {
    //     $stmt = $this->db->prepare("INSERT INTO role (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)");
    //     return $stmt->execute([
    //         'name' => $role->name,
    //         'created_at' => date('Y-m-d H:i:s'),
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ]);
    // }
}


