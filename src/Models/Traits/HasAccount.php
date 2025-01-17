<?php

namespace RefBytes\Outseta\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use RefBytes\Outseta\Models\Account;

trait HasAccount
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function plan(): bool
    {
        return $this->account->plan();
    }

    public function onTrial(): bool
    {
        return $this->account->onTrial();
    }

    public function isDemo(): bool
    {
        return $this->account->is_demo;
    }

    public function subscribed(): bool
    {
        return $this->account->subscribed();
    }

    public function onTrialOrSubscribed(): bool
    {
        return $this->account->onTrialOrSubscribed();
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Account::class);
    }
}
