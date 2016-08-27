<div class="col-md-4"></br>
    <div class="panel panel-default">
        <div class="panel-heading">Последние</div>
        <div class="panel-body">
            <?php $i = 0; ?>
            @foreach ($messages as $message)
                <?php $i++;?>
                <h4><a href="/{{ $message->slug, ['id'=>$message->id] }}">{{$message->title}}</a></h4>
                <small>Дата статьи: {{$message->created_at}}</small>
                @if ($i === 8) @break;
                @endif
            @endforeach
        </div>
    </div>
</div>
