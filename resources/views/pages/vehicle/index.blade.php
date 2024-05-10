@extends('layouts.default')
@section('content')
    <div class="page page-user page-index">

        @include('components.alert')

        <h1>Listagem de Veículos</h1>

        @include('pages.vehicle.filters')

        <div class="table-responsive">

            <table class="table table-striped mt-3">

                <thead class="table-dark">
                    <th>ID</th>
                    <th>Marcas</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Cor</th>
                    <th>Placa</th>
                    <th>Opcionais</th>
                    <th>Ações</th>
                </thead>

                <tbody>

                    @foreach ($list as $vehicle)

                    @php
                        $vehicleOptionals = $vehicle -> optionals;
                        $vehicleOptionalsNames = $vehicleOptionals->pluck('name')->toArray();
                        $vehicleOptionalsText = implode('; ',$vehicleOptionalsNames);
                    @endphp

                    <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->brand_name }}</td>
                            <td>{{ $vehicle->model_name }}</td>
                            <td> {{ $vehicle->model_year }}/{{ $vehicle->year }}</td>
                            <td>{{ $vehicle->color_name }}</td>
                            <td>{{ $vehicle->plate }}</td>
                            <td>{{ count($vehicleOptionalsNames) > 0 ? $vehicleOptionalsText : 'Não contem' }}</td>
                            <td>

                                <div class="buttons d-flex">

                                    <a class="btn btn-primary btn-sm me-2"
                                        href="{{ url('/veiculos/' . $vehicle->id . '/editar') }}">Editar Usuário</a>

                                    @include('components.delete', [
                                        'url' => '/veiculos',
                                        'id' => $vehicle->id,
                                        'text' => 'Remover Veículos',
                                    ])

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            {{ $list->links() }}

        </div>

        <a class="btn btn-md btn-primary" href="{{ url('/veiculos/cadastrar') }}">Criar novo veículo</a>

    </div>

@endsection
