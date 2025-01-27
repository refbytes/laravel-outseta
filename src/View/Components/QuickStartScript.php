<?php

namespace RefBytes\Outseta\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class QuickStartScript extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): string
    {
        return <<<'blade'
        <script>
            var o_options = {
                domain: '{{ config('outseta.api.subdomain') }}.outseta.com',
                load: 'auth,customForm,emailList,leadCapture,nocode,profile,support'
            };
            window.setOutsetaAccessToken = function() {
                @if(session('outseta_access_token', null))
                    Outseta.setAccessToken('{{ session('outseta_access_token') }}');
                @endif
            };
        </script>
        <script src="https://cdn.outseta.com/outseta.min.js"
                data-options="o_options"
                onload="setOutsetaAccessToken()">
        </script>
    blade;
    }
}
