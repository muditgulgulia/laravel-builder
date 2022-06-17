<nav class="navbar navbar-{{$selectedTheme->navbar_style}}">
    <div class="container{{$selectedTheme->navbar_container_fluid ? '-fluid' : '' }}">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style="color: deepskyblue;" class="navbar-brand"
               href="{{url('/')}}"><strong>{{config('app.name')}}</strong></a></div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                {{--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>--}}
                @if(isset($pages))
                    @foreach($pages as $page)
                        @if($page->menu_option == 'header' || $page->menu_option == 'both')
                            <li {!! Request::is('/') ? 'class="active"' : '' !!}>
                                {!! link_to('pages/'.$page->slug, trans(ucwords($page->title))) !!}
                            </li>
                        @endif
                    @endforeach
                @endif

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if(Auth::guest())
                            <li>
                                <a href="{{url('register')}}">Register</a>
                            </li>
                            <li>
                                <a href="{{url('login')}}">login</a>
                            </li>
                        @else
                            <li>
                                <a href="{{url('admin')}}">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out fa-fw"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif

                        {{--<li class="divider"></li>--}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
