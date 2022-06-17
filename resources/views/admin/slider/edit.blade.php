@extends('layouts.admin.layout')

@section('title')
    Edit Slider
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Slider','levelOneLink'=>url('admin/slider'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Edit Slider')
    @slot('panelBody')

    {{ Form::model($slider, array('url' => array('admin/slider', $slider->id),'method'=>'PUT')) }}

    @include('admin.slider.create-edit-common',['submitButtonName'=>'Update'])

    {!! Form::close() !!}

    @endslot
    @endcomponent

@endsection
