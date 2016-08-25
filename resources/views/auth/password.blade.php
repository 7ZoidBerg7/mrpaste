@extends('layouts.default')

@section('content')
<form method="POST" action="/password/email">
    {!! csrf_field() !!}
    <p>Email <input type="email" name="email" value="{{ old('email') }}"></p>
    <input type="hidden" name="_token" value="{{csrf_token()}}"><br>
    <input type="button" value="OK">
</form>
@stop