@component('mail::message')
Hi  {{ $friend_name }}
# Here is a great deal



Thanks,<br>
from {{ $name }} <br>
{{ config('app.name') }}
@endcomponent
