@extends('layouts.default')

@section('content')
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <p>Email <input type="email" name="email" value="{{ old('email') }}"></p>
    <p>Пароль <input type="password" name="password"></p>
    <p>Подтверждение пароля <input type="password" name="password_confirmation"></p>
    <input type="button" value="OK">
</form>
@stop