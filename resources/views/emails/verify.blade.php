
@component('mail::message')
# Email Verification

Thank you for Signing Up to Linka.
Your six digit code is {{$pin}}.
Please keep safely this pin to  avoid unauthorized user to use it.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
