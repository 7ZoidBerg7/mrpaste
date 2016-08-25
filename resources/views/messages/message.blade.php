@extends('layouts.default')
@section('content')   
@foreach($message as $ms)
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">                      
            <h2>{{$ms->title}}</h2>
            <textarea readonly name="text" class="form-control" rows="20">{{$ms->text}}</textarea>                     
            <small class="col-md-offset-9">Дата статьи: {{$ms->created_at}}</small>          
        </div>
    </div>
</div>
@endforeach

    
@stop