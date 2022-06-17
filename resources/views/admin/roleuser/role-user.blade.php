@extends('layouts.admin.layout')
@section('title')
    Assign roles to user
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'User','levelOneLink'=>url('admin/user'),'levelTwo'=>'Assign roles to user','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Assign roles to user
                </div>
                <div class="panel-body">
                    <div class="row">
                    {!! Form::open(['url'=> 'admin/user/roles', 'class' => ''] ) !!}
                    <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                                @foreach($roles as $role)

                                    <li class="col-xs-6 col-sm-3 ">
                                        <div class="checkbox-inline">
                                            @if(in_array($role->id,$getAllAttachedRoles))
                                                {{ Form::checkbox('roleuser[]', $role->id, true, ['class' => '']) }}
                                                <strong> {{ ucfirst($role->name) }}</strong>
                                            @else
                                                {{ Form::checkbox('roleuser[]', $role->id, null, ['class' => '']) }}
                                                <strong> {{ ucfirst($role->name) }}</strong>
                                            @endif
                                        </div>
                                    </li>

                                @endforeach

                            </ul>
                        </div>
                        <div class="col-lg-12">
                            {{ Form::hidden('user_id', $userId) }}
                            &nbsp;
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                            {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
                            <a href="{{url('admin/user')}}" class="btn btn-sm btn-warning">Cancel</a>
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
