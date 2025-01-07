<?php

namespace RefBytes\Outseta\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): string
    {
        return <<<'blade'
        <!DOCTYPE html>
            <html>
                <head>
                </head>
                <body>
                    {{ $slot }}
                </body>
            </html>
    blade;
    }
}
