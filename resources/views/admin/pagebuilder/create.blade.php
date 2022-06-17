@extends('layouts.admin.layout')
@section('title')
    Add Page
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Page','levelOneLink'=>url('admin/page'),'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Page Builder')
    @slot('panelBody')

        {!! Form::open(['url'=> 'admin/page', 'class' => ''] ) !!}

             @include('admin.pagebuilder.create-edit-common',['submitButtonName'=>'save'])

        {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection
