@component('mail::message')
# Password Reset Request

Hey There!

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $resetUrl])
Reset Password here
@endcomponent

make sure to reset your password

Thanks,
{{ config('app.name') }}
@endcomponent
