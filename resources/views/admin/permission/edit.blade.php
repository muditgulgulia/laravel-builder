@extends('layouts.admin.layout')

@section('title')
    Edit Permission
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/permission'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit Permission')
    @slot('panelBody')

        {{ Form::model($permissions, array('url' => array('admin/permission', $permissions->id),'method'=>'PUT')) }}

             @include('admin.permission.create-edit-common',['submitButtonName'=>'Update'])

        {!! Form::close() !!}

    @endslot
    @endcomponent

@endsection
