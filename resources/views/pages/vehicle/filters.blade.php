<form method="GET" action="{{ url('/veiculos') }}">
    <div class="row">

        <div class="col-6">
            @include('components.limit')
        </div>

        <div class="col-6">
            @include('components.sort', [
                'columns' => [
                    'id' => 'Id',
                ],
            ])
        </div>

    </div>

    <div class="d-flex mt-2">

        <a class="btn btn-sm btn-primary me-2" href="{{ url('veiculos') }}">Limpar Filtros</a>

        <button class="btn btn-sm btn-primary" type="submit">Atualizar</button>

    </div>

</div>
</form>
