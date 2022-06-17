@extends('layouts.admin.layout')

@section('title')
    Edit Module
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/module'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit Module')
    @slot('panelBody')

        {{ Form::model($module, array('url' => array('admin/module', $module->id),'method'=>'PUT')) }}

             @include('admin.module.create-edit-common',['submitButtonName'=>'Update'])

        {!! Form::close() !!}

    @endslot
    @endcomponent

@endsection
