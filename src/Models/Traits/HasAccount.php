<?php

namespace RefBytes\Outseta\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasAccount
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(config()->get('outseta.auth.account'));
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

    public function users(): HasMany
    {
        return $this->hasMany(
            related: config()->get('outseta.auth.user'),
            foreignKey: 'account_id',
            localKey: 'account_id',
        );
    }
}
