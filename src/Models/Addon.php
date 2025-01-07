<?php

namespace RefBytes\Outseta\Models;

class Addon
{
    public function __construct(
        public ?string $name = null,
        public ?int $quantity = null,
        public ?int $min_quantity = null,
    ) {}
}
