@extends('layouts.default')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Ваши записи</div>
                    <div class="panel-body">
                        @foreach ($your_messages as $your_message)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4><a href="/{{ $your_message->slug, ['id'=>$your_message->id] }}">{{$your_message->title}}</a></h4>
                                <div >{{str_limit($your_message->text, 50)}}</div>
                                <small class="col-md-offset-8">Дата: {{$your_message->created_at}}</small>
                                <a class="btn btn-link col-md-offset-7" href = "/{{ $your_message->slug, ['id'=>$your_message->id] }}">Открыть</a>
                                <a class="btn btn-link" href="/change/{{ $your_message->slug, ['id'=>$your_message->id] }}">Изменить</a>
                                <a class="btn btn-link" href="/delete/{{ $your_message->slug, ['id'=>$your_message->id] }}">Удалить</a>
                            </div>
                        </div>
                        @endforeach
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