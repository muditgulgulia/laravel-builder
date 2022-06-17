@extends('layouts.admin.layout')
@section('title')
    Add blank page
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'blank page','levelOneLink'=>url('admin/blank'),'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'blank page')
    @slot('panelBody')

        {!! Form::open(['url'=> 'admin/blank', 'class' => ''] ) !!}

             @include('admin.blank.create-edit-common',['submitButtonName'=>'save'])

        {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection
