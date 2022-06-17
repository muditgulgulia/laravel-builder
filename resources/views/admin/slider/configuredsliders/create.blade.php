@extends('layouts.admin.layout')
@section('title')
    Configure slider
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Configure Slider','levelOneLink'=>url('admin/slider'),'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Configure Slider')
    @slot('panelBody')

    {!! Form::open(['url'=> 'admin/slider/addconfiguredslider', 'class' => '','id'=>'fileupload',' method'=>'POST','enctype'=>'multipart/form-data', 'data-ng-app'=>'demo', 'data-ng-controller'=>'DemoFileUploadController','data-file-upload'=>'options','data-ng-class'=>"{'fileupload-processing': processing() || loadingFiles}"] ) !!}
    @include('admin.slider.configuredsliders.create-edit-common',['submitButtonName'=>'save'])

    {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection
