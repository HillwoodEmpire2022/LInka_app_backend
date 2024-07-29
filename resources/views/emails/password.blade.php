@component('mail::message')

Your 6-digits PIN is <h3>{{$pin}}</h3>
<p>Please Do not share this One Time PIN with anyone. You made a request to reset your password. Please DISCARD if this was not You</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

