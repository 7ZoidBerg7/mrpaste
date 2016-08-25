@extends('layouts.default')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Новая запись</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
                        {{ csrf_field() }}                       
                        <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{Auth::id()}}">
                        <label for="title" class="col-md-1 control-label">Заголовок:</label>
                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title">                              
                            </div>                                                                  
                                                                       
                        <label for="title" class="col-md-1 control-label">Текст:</label>
                            <div class="col-md-12">
                                <textarea name="text" class="form-control" rows="16"></textarea>
                            </div>
                        
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-floppy-o"></i>Сохранить
                                    </button>
                                </div>
                            </div>
                                               
                    </form>
                    
                    @if(Session::has('message'))
                    {{Session::get('message')}}
                    @endif                    
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-4 ">
            <div class="panel panel-default">
                <div class="panel-heading">Последние 10</div>
                <div class="panel-body">
                    <?php $i = 0; ?>
                    <?php //dd($messages); ?>
                    @foreach ($messages as $message)
                        <?php $i++; ?>
                        <h4><a href="/{{ $message->slug, ['id'=>$message->id] }}">{{$message->title}}</a></h4>
                        <small>Дата статьи: {{$message->created_at}}</small>
                        @if ($i === 8) @break;
                        @endif
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop