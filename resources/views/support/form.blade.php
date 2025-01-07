<x-app-layout>
<div id="support-form"></div>
    <script>
        var o_options = {
            domain: '{{ config('outseta.api.subdomain') }}.outseta.com',
            load: 'support',
            support: {
                mode: 'embed',
                selector: '#support-form'
            }
        };
    </script>
    <script src="https://cdn.outseta.com/outseta.min.js"
            data-options="o_options">
    </script>
</x-app-layout>
