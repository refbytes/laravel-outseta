<?php

namespace RefBytes\Outseta\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RefBytes\Outseta\Database\Factories\AccountFactory;
use RefBytes\Outseta\Models\Traits\Accountable;

class Account extends Model
{
    use Accountable;
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return AccountFactory::new();
    }
}
