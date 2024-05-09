@php
    $success = session('success');

    $error = session('error');

    $errorslist = $errors->all();

@endphp

@if ($success)
<div class="alert alert-success" role="alert">
    {{$success}}
</div>
@endif

@if ($error)
<div class="alert alert-danger" role="alert">
    {{$error}}
</div>
@endif

@if (count($errorslist) > 0)
    <ul>
        @foreach ($errorslist as $error)
            {{$error}}
        @endforeach
    </ul>
@endif
