<?php

namespace App\Entity;

class Role {
    public function __construct(
        public int $id,
        public string $name
    ) {}
}