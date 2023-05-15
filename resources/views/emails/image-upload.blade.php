@component('mail::message')
# Image Uploaded

Hello Admin,

The user {{ $user->name }} ({{ $user->email }}) has Uploaded the following image:

{{ $image->image_path }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent
