@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Результат поиска</div>
                    <div class="panel-body">
                        @foreach ($srch_results as $srch_result)
                                <h4><a href="/{{ $srch_result->slug, ['id'=>$srch_result->id] }}">{{$srch_result->title}}</a></h4>
                                <div >{{str_limit($srch_result->text, 75)}}</div>
                                <small class="col-md-offset-0">{{$srch_result->created_at}}</small>
                        @endforeach
                    </div>
            </div>
        </div>
        @include('layouts.search')
        @include('layouts.last_ten', ['$messages' => '$messages'])
        
        @if ($your_messages != null)
            @include('layouts.your_messages', ['$your_messages' => '$your_messages'])
        @endif
    </div>
</div>
@stop