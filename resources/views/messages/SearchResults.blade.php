@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Результат поиска: {{$find_it}}</div>
                    <div class="panel-body">
                        @foreach ($srch_title_results as $srch_result)
                                <h4><a href="/{{ $srch_result->slug, ['id'=>$srch_result->id] }}">{{$srch_result->title}}</a></h4>
                                <div >{{str_limit($srch_result->text, 75)}}</div>
                                <small>{{$srch_result->created_at}}</small>
                        @endforeach
                        @foreach ($srch_text_results as $srch_result)
                                <h4><a href="/{{ $srch_result->slug, ['id'=>$srch_result->id] }}">{{$srch_result->title}}</a></h4>
                                <div>{{str_limit($srch_result->text, 75)}}</div>
                                <small>{{$srch_result->created_at}}</small>
                        @endforeach
                        
                    </div>
            </div>
        </div>
        @include('layouts.search')
        @include('layouts.last_ten', ['$messages' => '$messages'])

    </div>
</div>
@stop