<x-dynamic-component :component="config('outseta.layouts.guest')">
    <div data-o-auth="1"
         data-widget-mode="register"
         @if($planFamilyUid = config('outseta.plan.family_uid'))
             data-plan-family-uid="{{ $planFamilyUid }}"
         @endif
         @if($planPaymentTerm = config('outseta.plan.payment_term'))
             data-plan-payment-term="{{ $planPaymentTerm }}"
         @endif
         data-skip-plan-options="true"
         data-mode="embed"
    ></div>
    @if(request()->has('planUid'))
        <script>
            window.addEventListener('load', () => {
                Outseta.auth.open({
                    widgetMode: 'register',
                    mode: 'embed',
                    planUid: '{{ request()->get('planUid') }}'
                });
            });
        </script>
    @endif
</x-dynamic-component>

