@extends('layouts.default')
@section('content')
    <div class="page page-user page-index">

        @include('components.alert')
        <h1>Listagem de Usuários</h1>
        @include('pages.user.filters')
    <div class="table-responsive">
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>AÇÕES</th>
            </thead>
            <tbody>
                @foreach ($list as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="buttons d-flex">
                                <a class="btn btn-primary btn-sm me-2"
                                    href="{{ url('/usuarios/' . $user->id . '/editar') }}">Editar Usuário</a>
                                @include('components.delete', [
                                    'url' => '/usuarios',
                                    'id' => $user->id,
                                    'text' => 'Remover Usuário',
                                ])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>
    <a class="btn btn-md btn-primary" href="{{ url('/usuarios/cadastrar') }}">Criar novo usuário</a>
    </div>
@endsection
