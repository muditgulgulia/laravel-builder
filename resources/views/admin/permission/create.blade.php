@extends('layouts.admin.layout')
@section('title')
    Add Permission
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Permission','levelOneLink'=>url('admin/permission'),'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Add Permission')
    @slot('panelBody')

        {!! Form::open(['url'=> 'admin/permission', 'class' => ''] ) !!}

             @include('admin.permission.create-edit-common',['submitButtonName'=>'save'])

        {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection
