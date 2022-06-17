@extends('layouts.admin.layout')
@section('title')
    Add User
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'User','levelOneLink'=>url('admin/user')       ,'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Add User')
    @slot('panelBody')
    {!! Form::open(['url'=> 'admin/user', 'class' => '','files' => true] ) !!}

    {{--common file --}}
    @include('admin.user.create-edit-common')

    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Password', ['class' => 'control-label ']) !!}
                <span class="text-danger">*</span>

                <div>
                    {!! Form::password('password', ['class' => 'form-control','id' => 'password-confirm', 'placeholder' => 'Enter 6 Digit Password']) !!}
                </div>
                @if($errors->has('password'))
                    <span class="text-danger">  {{ $errors->first('password') }}   </span>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label ']) !!}
                <span class="text-danger">*</span>

                <div>
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                </div>
                @if($errors->has('password'))
                    <span class="text-danger">  {{ $errors->first('password') }}   </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-sm btn-success">Save</button>
            {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
            <a href="{{url('admin/user')}}" class="btn btn-sm btn-warning">Cancel</a>
        </div>
    </div>

    {!! Form::close() !!}

    @endslot
    @endcomponent

@endsection
