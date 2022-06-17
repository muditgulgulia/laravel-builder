<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- jQuery and js -->
    @include('layouts.admin.partial.layout-css')
    @include('layouts.admin.partial.layout-js')
    @yield('css')

</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if(Auth::check())
                <a style="color: deepskyblue;" class="navbar-brand" href="{{url('/admin')}}"><strong>Super
                        Admin</strong>
                </a>
            @else
                <a style="color: deepskyblue;" class="navbar-brand"
                   href="{{url('/')}}"><strong>{{config('app.name')}}</strong></a>
            @endif
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            @if(Auth::check())
                <li>
                    <a href="{{url('/')}}" target="_blank">
                        <div>
                            <i class="fa fa-globe"></i> Visit Site
                        </div>
                    </a>
                </li>
                @include('layouts.default.notification')

                @include('layouts.admin.partial.user-profile-menus')

            @endif

        </ul>
    @if(Auth::check())
        <!-- /.navbar-top-links -->
        @include('layouts.admin.partial.admin-left-menus')
        <!-- /.navbar-static-side -->
        @endif
    </nav>
    <div id="{{Auth::check() ? 'page-wrapper' : 'wrapper'}}">
        <div class="container-fluid">
            @include('flash::message')
            @yield('content')

            @if(Auth::check())
            @endif
        </div>
    </div>
</div>

@include('layouts.admin.partial.footer')

@yield('js')

<!-- Scripts -->
</body>
</html>
