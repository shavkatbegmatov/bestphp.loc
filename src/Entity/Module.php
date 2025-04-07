<?php

namespace App\Entity;

class Module {
    public function __construct(
        public int $id,
        public string $name
    ) {}
}