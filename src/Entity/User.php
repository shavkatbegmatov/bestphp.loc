<?php

namespace App\Entity;

class User {
    public function __construct(
        public int $id,
        public string $name,
        public string $password,
        public string $created_at,
        public string $updated_at
    ) {}
}