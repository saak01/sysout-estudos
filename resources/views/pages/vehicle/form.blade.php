@extends('layouts.default')
@section('content')
    @php
        $selectedModelId = old('model_id', $vehicle->model_id);
        $selectedColorId = old('color_id', $vehicle->color_id);
        $selectedModelYear = old('model_year', $vehicle->model_year);
        $selectedYear = old('year', $vehicle->year);
        $selectedPlace = old('plate', $vehicle->plate);
        $vehicleOptionals = $vehicle->optionals;
        $vehicleOptionalsIds = $vehicleOptionals->pluck('id')->toArray();
        //TODO verificar se existe alguma função que me informa que existe id
        if (old('_method')) {
            $vehicleOptionalsIds = old('optional_id', []); // array, sendo vazio ou não
        }
    @endphp

    @include('components.alert')
    <div class="page page-vehicle page-index">
        <h1>Formulário de Veículos</h1>
        <form method="POST" action="{{ url('/veiculos') }}" class="form-group">
            @csrf
            @method($vehicle->id ? 'PUT' : 'POST')

            <input type="hidden" name="id" value="{{$vehicle->id}}">

            <label>Modelo</label>
            <select class="form-select" name="model_id" id="" required>
                <option>Selecione a opção</option>
                @foreach ($models as $model)
                    <option value="{{ $model->id }}" {{ $model->id == $selectedModelId ? 'selected' : '' }}>
                        {{ $model->brand_name }} - {{ $model->name }}</option>
                @endforeach
            </select>

            <label>Cor</label>
            <select class="form-select" name="color_id" id="" required>
                <option>Selecione a opção</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}" {{ $color->id == $selectedColorId ? 'selected' : '' }}>
                        {{ $color->name }}</option>
                @endforeach
            </select>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Ano Modelo</label>
                        <input type="number" name="model_year" id="year" class="form-control" minlength="1900"
                            value="{{ $selectedModelYear }}" required />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Ano Fabricação</label>
                        <input type="number" name="year" id="year" class="form-control" minlength="1900"
                            value="{{ $selectedYear }}" required />
                    </div>
                </div>
            </div>

            .<div class="mb-3">
                <label for="" class="form-label">Placa</label>
                <input type="text" name="plate" id="plate" class="form-control" minlength="7" maxlength="7"
                    value="{{ $selectedPlace }}" required />
            </div>

            <div class="form-group">
                <label for="">Opcionais</label>
                @foreach ($optionals as $optional)
                    @php
                        $checked = in_array($optional->id, $vehicleOptionalsIds);
                    @endphp

                    <div class="form-check">
                        <input name="optional_id[]" class="form-check-input" type="checkbox" value="{{ $optional->id }}"
                            {{ $checked ? 'checked' : '' }} id="{{ 'optional-' . $optional->id }}">
                        <label class="form-check-label" for="{{ 'optional-' . $optional->id }}">
                            {{ $optional->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <a class="btn btn-secondary mt-2" href="{{ url('/veiculos')}}">Voltar</a>
            <button class="btn btn-primary mt-2" type="submit">Enviar</button>
        </form>
    </div>
@endsection
