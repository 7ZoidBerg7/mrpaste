@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Результат поиска</div>
                    <div class="panel-body">
                        @foreach ($your_messages as $your_message)
                                <h4><a href="/{{ $your_message->slug, ['id'=>$your_message->id] }}">{{$your_message->title}}</a></h4>
                                <div >{{str_limit($your_message->text, 75)}}</div>
                                <small class="col-md-offset-0">{{$your_message->created_at}}</small>
                        @endforeach
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
                        @if ($i === 10) @break;
                        @endif
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop