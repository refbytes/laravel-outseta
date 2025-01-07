<x-guest-layout>
    <div id="signup-embed"></div>
    <script>
        var o_signup_options = {
            "id": "Outseta",
            "domain": "{{ config('outseta.api.subdomain') }}.outseta.com",
            "load": "auth",
            "auth": {
                "widgetMode": "register",
                "skipPlanOptions": true,
                "id": "signup_embed",
                "mode": "embed",
                "selector": "#signup-embed"
            }
        };
    </script>
    <script src="https://cdn.outseta.com/outseta.min.js"
            data-options="o_signup_options">
    </script>
</x-guest-layout>

