<?php

namespace RefBytes\Outseta\Tests\TestSupport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use RefBytes\Outseta\Models\Traits\HasAccount;

class User extends BaseUser
{
    use HasAccount;
    use HasFactory;
    use Notifiable;
}
