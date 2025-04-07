<?php

namespace App\Entity;

class Permission {
    public function __construct(
        public int $id,
        public string $name
    ) {}
}