@component('mail::message')
# New User

A new user has signed up on indicators.ps<br>

Name: {{ $message->name }}<br>
Email: {{ $message->email }}<br>

@component('mail::button', ['url' => $url])
View User
@endcomponent

Best,<br>
{{ config('app.name') }}<br>
{{ env('APP_URL') }}
@endcomponent