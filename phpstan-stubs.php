<?php

namespace App\Models;

use RefBytes\Outseta\Models\Traits\HasAccount;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 */
class User {
    use HasAccount;
}
