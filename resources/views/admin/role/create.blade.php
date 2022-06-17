@extends('layouts.admin.layout')

@section('title')
    Add Role
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/role'),'levelTwo'=>'Create','levelTwoLink'=>null])

    {{--create sloat and componet for code optimization 'layouts/admin/partial/panel'--}}
    @component('layouts.admin.partial.panel')
    @slot('panelTitle', 'Add Role')
    @slot('panelBody')
        {!! Form::open(['url'=> 'admin/role', 'class' => ''] ) !!}

            @include('admin.role.create-edit-common',['submitButtonName'=>'Save'])

        {!! Form::close() !!}
        <!-- /.col-lg-6 (nested) -->
    @endslot
    @endcomponent


@endsection
