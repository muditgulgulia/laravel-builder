<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{url('admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @if(Auth::user()->hasRole('administration'))
                <li>
                    <a href="#">
                        <i class="fa fa-users fa-fw"></i> User Management <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('user.index')}}">Users</a></li>
                        <li><a href="{{route('user.create')}}">Add User</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-asl-interpreting fa-fw"></i> Roles
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('role.index') }}"> Roles</a></li>
                        <li><a href="{{route('role.create') }}"> Add Role</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-user-secret fa-fw"></i> Permissions
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('permission.index') }}"> Permissions</a></li>
                        <li><a href="{{route('permission.create') }}"> Add Permission</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-pagelines fa-fw"></i> Page Builder
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('page.index') }}"> Pages</a></li>
                        <li><a href="{{route('page.create') }}"> Add Page</a></li>
                    </ul>
                </li>
                {{--<li>
                    <a href="#">
                        <i class="fa fa-file fa-fw"></i> Backup
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('backup.index') }}"> Backups</a></li>
                        <li><a href="{{route('backup.create') }}"> Create Backup</a></li>
                    </ul>
                </li>--}}
                <li>
                    <a href="#">
                        <i class="fa fa-angle-double-up fa-fw"></i> Module Creator
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('module.index') }}"> Modules</a></li>
                        <li><a href="{{route('module.create') }}"> Add Module</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-angle-double-up fa-fw"></i> Slider
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('slider.index') }}"> Sliders</a></li>
                        <li><a href="{{route('slider.create') }}"> Add Slider</a></li>
                        <li><a href="{{route('slider.showconfiguredslider') }}"> Show Sliders</a></li>
                        <li><a href="{{route('slider.addconfiguredslider') }}"> Configure Slider</a></li>
                    </ul>
                </li>

                @foreach($customModule as $module)
                    @if($module->active && $module->controller_related_to == 'Admin')
                        <li>
                            <a href="#">
                                &nbsp;<i class="fa fa-windows  fa-fw"></i> {{ $module->module_name}}
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('admin/'.strtolower($module->module_name)) }}">
                                        {{$module->module_name}}s</a></li>
                                @if(Auth::user()->can(strtolower($module->module_name).'.create'))
                                    <li><a href="{{url('admin/'.strtolower($module->module_name).'/create') }}">
                                            Add {{$module->module_name}}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endforeach

            @endif
            <li>
                <a href="#">
                    <i class="fa fa-gear fa-fw"></i> Settings
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('theme.index') }}"> Update Theme </a></li>
                    <li><a href="{{route('cache.management') }}"> Clear Compiled & Views</a></li>
                    <li><a href="{{route('log.index') }}"> Logs </a></li>
                </ul>
            </li>
            <li ><a href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="text-danger"><i class="fa fa-sign-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>