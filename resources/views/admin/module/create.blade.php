@extends('layouts.admin.layout')
@section('title')
    Add New Module
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Module','levelOneLink'=>url('admin/mvc'),'levelTwo'=>'Create','levelTwoLink'=>null])

    @if(\Session::has('makeNewModule'))
        <div class="text-success">
            {{ \Session::get('makeNewModule') }}
        </div>
    @endif
    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Module Creator')
    @slot('panelBody')

    {!! Form::open(['url'=> 'admin/module', 'class' => '','ng-init'=>'migration_fields_show=false,field.default_check=true','ng-app'=>"migration-fields", 'ng-controller'=>"MainCtrl"] ) !!}

    @include('admin.module.create-edit-common',['submitButtonName'=>'save'])

    {!! Form::close() !!}

    @endslot
    @endcomponent


@endsection

@section('js')
    <script src="{{ url('js/angular/app-angular.js') }}"></script>
@endsection