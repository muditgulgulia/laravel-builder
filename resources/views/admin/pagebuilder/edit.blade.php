@extends('layouts.admin.layout')

@section('title')
    Edit Page
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Page','levelOneLink'=>url('admin/page'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit Page')
    @slot('panelBody')

        {{ Form::model($page, array('url' => array('admin/page', $page->id),'method'=>'PUT')) }}

             @include('admin.pagebuilder.create-edit-common',['submitButtonName'=>'Update'])

        {!! Form::close() !!}

    @endslot
    @endcomponent

@endsection
