@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Новая запись</div>
                <div class="panel-body">
                    @foreach ($messages as $message)
                    <form class="form-horizontal" role="form" method="POST" action="/change/{{ $message->slug, ['id'=>$message->id] }}">
                        {{ csrf_field() }}                       
                        
                        <?php //dd($messages); ?>
                        
                        <label for="title" class="col-md-1 control-label">Заголовок:</label>
                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $message->title}}">
                            </div>
                                                                       
                        <label for="title" class="col-md-1 control-label">Текст:</label>
                            <div class="col-md-12">
                                <textarea name="text" class="form-control" rows="12">{{ $message->text }}</textarea>
                            </div>
                        
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-floppy-o"></i>Сохранить
                                </button>
                            </div>
                        @endforeach
                                               
                    </form>
                    
                    @if(Session::has('message'))
                    {{Session::get('message')}}
                    @endif                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop