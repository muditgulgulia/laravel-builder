<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="{{ url('admin/user').'/'.Auth::user()->id  .'/edit'}}"><i class="fa fa-user fa-fw"></i> User
                Profile</a></li>
        @if(Auth::user()->hasRole('administration'))
            <li><a href="{{route('theme.index') }}"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
        @endif
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out fa-fw"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>