<x-dynamic-component :component="config('outseta.layouts.guest')">
    <div id="login-embed"></div>
    <script>
        var o_login_options = {
            "id": "Outseta",
            "domain": "{{ config('outseta.api.subdomain') }}.outseta.com",
            "load": "auth",
            "auth": {
                "widgetMode": "login",
                "id": "login_embed",
                "mode": "embed",
                "selector": "#login-embed"
            }
        };
    </script>
    <script src="https://cdn.outseta.com/outseta.min.js"
            data-options="o_login_options">
    </script>
</x-dynamic-component>
