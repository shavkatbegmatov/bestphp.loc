<?php

namespace App\Repository;

use App\Database;
use App\Entity\Module;
use PDO;

class ModuleRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function find(int $id): ?Module {
        $stmt = $this->db->prepare("SELECT * FROM module WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new Module(...$data) : null;
    }

    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM module");
        return array_map(fn($row) => new Module(...$row), $stmt->fetchAll());
    }

    // public function create(Module $module): bool {
    //     $stmt = $this->db->prepare("INSERT INTO module (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)");
    //     return $stmt->execute([
    //         'name' => $module->name,
    //         'created_at' => date('Y-m-d H:i:s'),
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ]);
    // }
}