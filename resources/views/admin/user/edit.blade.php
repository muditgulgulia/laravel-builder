@extends('layouts.admin.layout')

@section('title')
    Edit User
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'User','levelOneLink'=>url('admin/user'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit User')
    @slot('panelBody')
    {{ Form::model($userList, array('url' => array('admin/user', $userList->id),'method'=>'PUT')) }}
    @include('admin.user.create-edit-common')

    <div class="col-lg-12">
        <hr>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Update Password', ['class' => 'control-label ']) !!}
                <div>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter 6 Digit Password']) !!}
                    <span class="text-danger">Fill only when modifying passwords.</span>

                </div>
                @if($errors->has('password'))
                    <span class="text-danger">  {{ $errors->first('password') }}   </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <button type="submit" class="btn btn-sm btn-success">Update</button>
        {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
        <a href="{{url('admin/user')}}" class="btn btn-sm btn-warning">Cancel</a>

    </div>
    <!-- /.col-lg-6 (nested) -->
    {!! Form::close() !!}
    @endslot
    @endcomponent

@endsection
