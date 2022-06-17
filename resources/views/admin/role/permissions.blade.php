@extends('layouts.admin.layout')
@section('title')
    Add competence
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/role'),'levelTwo'=>'Competence','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Competence
                </div>
                <div class="panel-body">
                    <div class="row">
                    {!! Form::open(['url'=> 'admin/role/competence', 'class' => ''] ) !!}
                    <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                                @foreach($permissions as $permission)

                                    <li class="col-xs-6 col-sm-3 ">
                                        <div class="checkbox-inline">
                                            @if(in_array($permission->name,$rolePerms))
                                                {{ Form::checkbox('permissions[]', $permission->id, true, ['class' => '']) }}
                                                <strong data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ ucfirst($permission->display_name) }}</strong>
                                            @else
                                                {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => '']) }}
                                                <strong data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ ucfirst($permission->display_name) }}</strong>
                                            @endif
                                        </div>
                                    </li>

                                @endforeach

                            </ul>
                        </div>
                        <div class="col-lg-12">
                            {{ Form::hidden('role_id', $id) }}
                            &nbsp;
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                            {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
                            <a href="{{url('admin/role')}}" class="btn btn-sm btn-warning">Cancel</a>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                {!! Form::close() !!}

                <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

@endsection
