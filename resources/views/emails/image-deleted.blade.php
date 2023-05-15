@component('mail::message')
# Image Deleted

Hello Admin,

The user {{ $user->name }} ({{ $user->email }}) has deleted the following image:

{{ $image->image_path }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent
