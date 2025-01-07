<?php

namespace RefBytes\Outseta\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RefBytes\Outseta\Enums\AccountStage;
use RefBytes\Outseta\Tests\TestSupport\Models\User;

class AccountFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'uid' => $this->faker->uuid(),
            'is_demo' => false,
        ];
    }

    public function demo(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_demo' => true,
            ];
        });
    }

    public function trialing(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'account_stage' => AccountStage::Trialing->value,
            ];
        });
    }

    public function subscribed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'account_stage' => AccountStage::Subscribing->value,
            ];
        });
    }

    public function cancelling(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'account_stage' => AccountStage::Canceling->value,
            ];
        });
    }

    public function expired(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'account_stage' => AccountStage::Expired->value,
            ];
        });
    }

    public function trialExpired(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'account_stage' => AccountStage::TrialExpired->value,
            ];
        });
    }

    public function cancellingTrial(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'account_stage' => AccountStage::CancellingTrial->value,
            ];
        });
    }

    public function withAddons(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'current_subscription' => [
                    'SubscriptionAddOns' => [
                        [
                            'AddOn' => [
                                'Name' => 'CPUs',
                                'MinimumQuantity' => 1,
                                'SubscriptionCount' => 0,
                                'Quantity' => 0,
                            ],
                            'Quantity' => 1,
                        ],
                        [
                            'AddOn' => [
                                'Name' => 'Storage',
                                'MinimumQuantity' => 1,
                                'SubscriptionCount' => 0,
                                'Quantity' => 0,
                            ],
                            'Quantity' => 1,
                        ],
                    ],
                ],
            ];
        });
    }
}
