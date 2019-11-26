@component('mail::message')
# Message recieved

<div dir="ltr" class="text-capitalize title">
    {{ $message }}<br>
    Best,<br>


    {{ config('app.name') }}<br>
    {{ env('APP_URL') }}
</div>

@endcomponent