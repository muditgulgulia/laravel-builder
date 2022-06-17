@extends('layouts.admin.layout')

@section('title')
    Edit Blank
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/blank'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit Blank')
    @slot('panelBody')

        {{ Form::model($blank, array('url' => array('admin/blank', $blank->id),'method'=>'PUT')) }}

             @include('admin.blank.create-edit-common',['submitButtonName'=>'Update'])

        {!! Form::close() !!}

    @endslot
    @endcomponent

@endsection
