<?php

namespace RefBytes\Outseta\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use RefBytes\Outseta\Enums\AccountStage;

class Account extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'current_subscription' => 'array',
            'subscriptions' => 'array',
            'deals' => 'array',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function onTrial(): bool
    {
        return $this->account_stage === AccountStage::Trialing->value;
    }

    public function subscribed(): bool
    {
        return $this->account_stage === AccountStage::Subscribing->value;
    }

    public function onTrialOrSubscribed(): bool
    {
        return ($this->account_stage === AccountStage::Subscribing->value)
            || ($this->account_stage === AccountStage::Trialing->value);
    }

    public function plan(): Plan
    {
        return new Plan(
            name: data_get($this->current_subscription, 'Plan.Name'),
            uid: data_get($this->current_subscription, 'Plan.Uid'),
        );
    }

    public function addOns(): Collection
    {
        return collect(
            data_get($this->current_subscription, 'SubscriptionAddOns', [])
        )->map(function ($addOn) {
            return new Addon(
                name: data_get($addOn, 'AddOn.Name'),
                quantity: data_get($addOn, 'Quantity'),
                min_quantity: data_get($addOn, 'AddOn.MinimumQuantity'),
            );
        });
    }
}
