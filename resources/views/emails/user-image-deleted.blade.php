@component('mail::message')
# Image Deleted

Hello User,

The Admin {{ $user->name }} ({{ $user->email }}) has deleted the following image:

{{ $image->image_path }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent
