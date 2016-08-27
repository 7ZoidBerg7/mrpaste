@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Изменить запись</div>
                <div class="panel-body">

                    
                    <form class="form-horizontal" role="form" method="POST" action="/change/{{ $change_messages->slug, ['id'=>$change_messages->id] }}">
                        {{ csrf_field() }}
                        <label for="title" class="col-md-1 control-label">Заголовок:</label>
                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $change_messages->title}}">
                            </div>
                                                                       
                        <label for="title" class="col-md-1 control-label">Текст:</label>
                            <div class="col-md-12">
                                <textarea name="text" class="form-control" rows="12">{{ $change_messages->text }}</textarea>
                            </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-2">
                                </br><p><b>Удалить через:</b></p>
                                <input type="radio" name="add_time" value="{{0}}">Не удалять</br>
                                <input type="radio" name="add_time" value="{{60*5}}">Через 5 минут</br>
                                <input type="radio" name="add_time" value="{{60*60}}" checked>Через 1 час</br>
                                <input type="radio" name="add_time" value="{{60*60*3}}">Через 3 часа</br>
                                <input type="radio" name="add_time" value="{{60*60*24*7}}">Через 1 неделю</br>
                                <input type="radio" name="add_time" value="{{60*60*24*30}}">Через 1 месяц</br>
                            </div>
                            <div class="col-md-3">
                                </br><p><b>Доступ:</b></p>
                                <input type="radio" name="access_status" value="1" checked>Всем пользователям</br>
                                <input type="radio" name="access_status" value="2">Только по ссылке</br>
                                @if (Auth::guest())
                                    <input type="radio" name="access_status" value="3" disabled><i>Только мне (нужно <a href="{{ url('/login') }}">войти</a> или <a href="{{ url('/register') }}">зарегестрироваться</a>)</br>
                                        @else
                                            <input type="radio" name="access_status" value="3">Только мне</br>
                                @endif                                                                
                            </div>
                            <div class="col-md-3">
                                </br><p><b>Тип текста:</b></p>
                                <input type="radio" name="lang" value="0" checked>Просто текст</br>
                                <input type="radio" name="lang" value="1">Код</br>
                            </div>
                        </div></br>
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-floppy-o"></i>Сохранить
                                </button>
                            </div>                        
                    </form>
                    
                    @if(Session::has('message'))
                    {{Session::get('message')}}
                    @endif                    
                    
                </div>
            </div>
        </div>
        @include('layouts.search')</br>
        @if ($your_messages != null)
            @include('layouts.your_messages', ['$your_messages' => '$your_messages'])
        @endif        
        @include('layouts.last_ten', ['$messages' => '$messages'])
        
    </div>
</div>
@stop