<?php

namespace RefBytes\Outseta\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use function Laravel\Prompts\table;

class OutsetaPlansCommand extends Command
{
    public $signature = 'outseta:plans';

    public $description = 'Display Plans from Outseta';

    public function handle(): int
    {
        $response = Http::withToken('Outseta '.config('outseta.api_key').':'.config('outseta.api_secret'))
            ->get('https://'.config('outseta.api.subdomain').'.outseta.com/api/v1/billing/plans?fields=Name,Uid,PlanAddOns.*,PlanAddOns.AddOn.Name,PlanAddOns.AddOn.Uid')
            ->json();

        $data = collect(data_get($response, 'items'))
            ->map(function ($item) {
                return [
                    'Name' => data_get($item, 'Name'),
                    'Uid' => data_get($item, 'Uid'),
                    'Plan Add-ons' => collect(data_get($item, 'PlanAddOns'))->map(function ($item) {
                        return $item['AddOn']['Name'].': '.$item['AddOn']['Uid'];
                    })->join("\n"),
                ];
            })
            ->toArray();

        table(
            headers: ['Plan Name', 'Uid', 'Plan Add-ons'],
            rows: $data
        );

        return self::SUCCESS;
    }
}
