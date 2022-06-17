@extends('layouts.admin.layout')

@section('title')
    Edit User
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/role'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit User')
    @slot('panelBody')

        {{ Form::model($roleList, array('url' => array('admin/role', $roleList->id),'method'=>'PUT')) }}

            @include('admin.role.create-edit-common',['submitButtonName'=>'Update'])

        {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection
