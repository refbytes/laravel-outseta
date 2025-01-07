<?php

namespace RefBytes\Outseta\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use function Laravel\Prompts\table;

class OutsetaPlanFamiliesCommand extends Command
{
    public $signature = 'outseta:plan-families';

    public $description = 'Display Plan Families from Outseta';

    public function handle(): int
    {
        $response = Http::withToken('Outseta '.config('outseta.api_key').':'.config('outseta.api_secret'))
            ->get('https://'.config('outseta.api.subdomain').'.outseta.com/api/v1/billing/planfamilies')
            ->json();

        $data = collect(data_get($response, 'items'))
            ->map(function ($item) {
                return [
                    'Name' => data_get($item, 'Name'),
                    'Uid' => data_get($item, 'Uid'),
                ];
            })
            ->toArray();

        table(
            headers: ['Plan Family Name', 'Uid'],
            rows: $data
        );

        return self::SUCCESS;
    }
}
