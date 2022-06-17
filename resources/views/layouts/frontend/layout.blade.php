<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    {{--Js css file--}}
    @yield('css')    @yield('js')
    @include('layouts.frontend.partial.jscsscombo')

</head>
<body>

{{--navar details--}}
@include('layouts.frontend.partial.navbar')

<div class="container{{$selectedTheme->body_container_fluid ? '-fluid' : '' }}">

    {{--breadcrumb details--}}
    @include('layouts.frontend.partial.breadcrumb')

    @yield('content')

</div>

{{--footer details--}}
@include('layouts.frontend.partial.footer')

</body>
</html>
