<x-app-layout>
    <div id="profile-embed"></div>
    <script>
        var o_profile_options = {
            "id": "Outseta",
            "domain": "{{ config('outseta.api.subdomain') }}.outseta.com",
            "load": "profile",
            "profile": {
                "id": "profile_embed",
                "mode": "embed",
                "selector": "#profile-embed"
            }
        };
    </script>
    <script src="https://cdn.outseta.com/outseta.min.js"
            data-options="o_profile_options">
    </script>
</x-app-layout>
