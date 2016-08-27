<form class="form-horizontal" role="form" method="POST" action="/search">
    {{ csrf_field() }}
    <div class="col-md-3">
        <input class="form-control" type="text" name="Result" placeholder="Что искать?" required>
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fa-btn"></i>Поиск
    </button>
</form>