@component('mail::message')
# Email OTP verification

OTP to register in covis app is , {{ $email_otp }}

OTP verification is required to register in Covis

If you have any concerns, please contact us at covis@covis.co.za

Thanks,<br>
{{ config('app.name') }}
@endcomponent
