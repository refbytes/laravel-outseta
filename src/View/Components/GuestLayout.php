<?php

namespace RefBytes\Outseta\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): string
    {
        return <<<'blade'
            <!DOCTYPE html>
                <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <meta name="description" content="{{ config('app.name', 'Laravel') }}">
                        <title>{{ config('app.name', 'Laravel') }}</title>
                        <x-outseta-quick-start-script />
                    </head>
                    <body>
                        <!-- Page Content -->
                        <main>
                            {{ $slot }}
                        </main>
                    </body>
                </html>
        blade;
    }
}
