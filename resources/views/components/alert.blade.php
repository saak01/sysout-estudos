@php
    $success = session('success');

    $error = session('error');

    $errorslist = $errors->all();

@endphp

@if ($success)
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{$success}}
</div>
@endif


@if (count($errorslist) > 0)
    <ul>
        @foreach ($errorslist as $error)
        @if ($error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
        </div>
        @endif
        @endforeach
    </ul>
@endif
