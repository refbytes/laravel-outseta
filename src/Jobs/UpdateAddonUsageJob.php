<?php

namespace RefBytes\Outseta\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateAddonUsageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $uid,
        public int $amount,
        public ?Carbon $date = null,
    ) {}

    public function handle(): void
    {
        if (empty($this->date)) {
            $this->date = Carbon::now();
        }

        $response = Http::withToken('Outseta '.config('outseta.api_key').':'.config('outseta.api_secret'))
            ->post('https://'.config('outseta.api.subdomain').'.outseta.com/api/v1/billing/usage', [
                'UsageDate' => $this->date->toDateTimeLocalString(),
                'Amount' => $this->amount,
                'SubscriptionAddOn' => [
                    'Uid' => $this->uid,
                ],
            ]);
    }
}
