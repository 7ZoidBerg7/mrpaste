@extends('layouts.default')
@section('content')   
@foreach($message as $ms)
@if($ms->access_status == 3)
    <?php $id = Auth::id(); ?>
    @if ($ms->user_id == $id)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">                      
                    <h2>{{$ms->title}}</h2>
                    <textarea readonly name="text" class="form-control" rows="20">{{$ms->text}}</textarea>                     
                    <small class="col-md-offset-9">Дата статьи: {{$ms->created_at}}</small>          
                    @if ($ms->non_delete == 1)
                        <small class="col-md-offset-9">Доступно до: без ограничений</small>
                        @else
                            <small class="col-md-offset-9">Доступно до: {{$ms->live_to}}</small>
                    @endif
                </div>
            </div>
        </div>
        @else
            <p>кышь</p>>
    @endif
@else
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">                      
            <h2>{{$ms->title}}</h2>
            <textarea readonly name="text" class="form-control" rows="20">{{$ms->text}}</textarea>                     
            <small class="col-md-offset-9">Дата статьи: {{$ms->created_at}}</small>          
            @if ($ms->non_delete == 1)
            <small class="col-md-offset-9">Доступно до: без ограничений</small>
            @else
            <small class="col-md-offset-9">Доступно до: {{$ms->live_to}}</small>
            @endif
        </div>
    </div>
</div>
@endif
@endforeach

    
@stop