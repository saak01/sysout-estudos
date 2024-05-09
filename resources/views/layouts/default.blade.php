<!DOCTYPE html>
<html lang="en">
@include('components.head')
<body>
    @include('components.header')
    <main class="d-flex container mt-4">
    @include('components.sidebar')
    <div class="as-4 flex-grow" id="content">
        @yield('content')
    </div>
    </main>
    @include('components.footer')

    <script src="{{asset('node_modules/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('node_modules/@popperjs/core/dist/umd/popper.js')}}"></script>
</body>
</html>
