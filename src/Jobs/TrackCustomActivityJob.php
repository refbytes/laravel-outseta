<?php

namespace RefBytes\Outseta\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use RefBytes\Outseta\Enums\EntityType;

class TrackCustomActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $title,
        public string $description,
        public string $data,
        public int $type,
        public string $uid,
    ) {}

    public function handle(): void
    {
        $response = Http::withToken('Outseta '.config('outseta.api_key').':'.config('outseta.api_secret'))
            ->post('https://'.config('outseta.api.subdomain').'.outseta.com/api/v1/activities/customactivity', [
                'Title' => $this->title,
                'Description' => $this->description,
                'ActivityData' => $this->data,
                'EntityType' => EntityType::Account->value,
                'EntityUid' => $this->uid,
            ]);
    }
}
