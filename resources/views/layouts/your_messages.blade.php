<div class="col-md-4">
    <div class="panel panel-default right">
        <div class="panel-heading">Мои записи</div>
        <div class="panel-body">
            <?php $i = 0; ?>
            <?php //dd($messages); ?>
            @foreach ($your_messages as $your_message)
                <?php $i++;?>
                <h4><a href="/{{ $your_message->slug, ['id'=>$your_message->id] }}">{{$your_message->title}}</a></h4>
                <small>Дата: {{$your_message->created_at}}</small>
                @if ($i === 8) @break;
                @endif
            @endforeach
        </div>
    </div>
</div>