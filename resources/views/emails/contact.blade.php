@component('mail::message')
# New Contact Message

Name:
# {{ $maildata['name'] }}

Email:
# {{ $maildata['email'] }}

Message:
# {{ $maildata['message'] }}

<br>
{{ config('app.name') }}
@endcomponent
