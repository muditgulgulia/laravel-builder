@extends('layouts.admin.layout')
@section('title')
    Add slider
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Slider','levelOneLink'=>url('admin/slider'),'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'slider')
    @slot('panelBody')

    {!! Form::open(['url'=> 'admin/slider', 'class' => ''] ) !!}

    @include('admin.slider.create-edit-common',['submitButtonName'=>'save'])

    {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection
