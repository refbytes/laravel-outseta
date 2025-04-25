<?php

namespace RefBytes\Outseta\Models;

class Plan
{
    public function __construct(
        public ?string $name = null,
        public ?string $uid = null,
    ) {}
}
