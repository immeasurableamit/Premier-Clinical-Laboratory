@component('mail::message')
# Welcome to Covis Portal

Your account was created by Covis Admin.

Login Details :

Email : {{ $email }} <br>
Password : {{ $password }}

@component('mail::button', ['url' => $url ])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
