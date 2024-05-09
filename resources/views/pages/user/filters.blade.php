<form method="GET" action="{{ url('/usuarios') }}">
    <div class="row">
        <div class="col-3">
            <div clas   s="form-group">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}">
            </div>
        </div>

        <div class="col-3">
            @include('components.limit')
        </div>

        <div class="col-3">
            @include('components.sort', [
                'columns' => [
                    'id' => 'Id',
                    'name' => 'Nome',
                    'email' => 'E-mail',
                ],
            ])
        </div>

    </div>
    <div class="d-flex mt-2">
        <a class="btn btn-sm btn-primary me-2" href="{{ url('usuarios') }}">Limpar Filtros</a>

        <button class="btn btn-sm btn-primary" type="submit">Atualizar</button>
    </div>
    </div>
</form>
