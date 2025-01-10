<x-mail::message>
# Hello {{$name}}

This is auth data <br>
user number : {{$auth_code}} <br>
passwod : {{$pwd}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
