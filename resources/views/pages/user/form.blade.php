@extends('layouts.default')
@section('content')

<div class="page page-user page-index">
    @include('components.alert')
    <h1>Formulário de Usuário</h1>
    <form method="POST" action="{{url('/usuarios')}}">
        @csrf

        @method($user->id ? 'PUT': 'POST')
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" value="{{old('name',$user->name)}}" name="name" class="form-control" maxlength="30" required>
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" value="{{old('email',$user->email)}}" name="email" class="form-control" maxlength="500" required>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" class="form-control" minlength="8" maxlength="16" {{ !$user->id ? 'required' : ''}}/>
        </div>
        <button class="btn btn-primary mt-2 " type="submit">Enviar</button>
    </form>
    <a class="btn mt-2 btn-secondary" href="{{url('/usuarios')}}">Voltar</a>
</div>
@endsection
