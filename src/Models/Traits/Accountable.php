<?php

namespace RefBytes\Outseta\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use RefBytes\Outseta\Enums\AccountStage;
use RefBytes\Outseta\Models\Addon;
use RefBytes\Outseta\Models\Plan;

/**
 * @property int $account_stage
 * @property array $current_subscription
 */
trait Accountable
{
    public function initializeAccountable()
    {
        $this->mergeCasts([
            'current_subscription' => 'array',
            'subscriptions' => 'array',
            'deals' => 'array',
        ]);
    }

    public function users(): HasMany
    {
        return $this->hasMany(config()->get('outseta.auth.user'));
    }

    public function onTrial(): bool
    {
        return empty($this->current_subscription)
            || ($this->account_stage === AccountStage::Trialing->value);
    }

    public function subscribed(): bool
    {
        return $this->account_stage === AccountStage::Subscribing->value;
    }

    public function onTrialOrSubscribed(): bool
    {
        return $this->onTrial()
            || $this->subscribed();
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
                uid: data_get($addOn, 'Uid'),
                quantity: data_get($addOn, 'Quantity'),
                min_quantity: data_get($addOn, 'AddOn.MinimumQuantity'),
            );
        });
    }
}
