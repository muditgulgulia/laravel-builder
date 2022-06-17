@extends('layouts.admin.layout')

@section('title')
    Edit Theme
@stop
@section('content')

    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Theme','levelOneLink'=>url('admin/theme'),'levelTwo'=>'Edit','levelTwoLink'=>null])

    {{--create sloat and componet for code optimizatrion--}}
    @component('layouts.admin.partial.panel')
        @slot('panelTitle', 'Edit Theme')
        @slot('panelBody')

            {{ Form::model($theme, array('url' => array('admin/theme', $theme->id),'method'=>'PUT')) }}

            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('selected_theme') ? ' has-error' : '' }}">
                    {!! Form::label('selected_theme', 'Selected Theme', ['class' => 'control-label']) !!}

                    {{ Form::select('selected_theme', $themeOptions, null, ['class' => 'form-control']) }}
                    @if($errors->has('selected_theme'))
                        <span class="text-danger">  {{ $errors->first('selected_theme') }}   </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('navbar_style') ? ' has-error' : '' }}">
                    {!! Form::label('navbar_style', 'Navbar Style', ['class' => 'control-label']) !!}

                    {{ Form::select('navbar_style', ['none'=>'none', 'default'=>'default', 'inverse'=>'inverse'], null, ['class' => 'form-control']) }}
                    @if($errors->has('navbar_style'))
                        <span class="text-danger">  {{ $errors->first('navbar_style') }}   </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('navbar_container_fluid') ? ' has-error' : '' }}">
                    {!! Form::label('navbar_container_fluid', 'Navbar Container Fluid', ['class' => 'control-label']) !!}

                    {{ Form::select('navbar_container_fluid', ['1'=>'Yes','0'=>'No'], null, ['class' => 'form-control']) }}
                    @if($errors->has('navbar_container_fluid'))
                        <span class="text-danger">  {{ $errors->first('navbar_container_fluid') }}   </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('body_container_fluid') ? ' has-error' : '' }}">
                    {!! Form::label('body_container_fluid', 'Body Container Fluid', ['class' => 'control-label']) !!}

                    {{ Form::select('body_container_fluid', ['1'=>'Yes','0'=>'No'], null, ['class' => 'form-control']) }}
                    @if($errors->has('body_container_fluid'))
                        <span class="text-danger">  {{ $errors->first('body_container_fluid') }}   </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('breadcrumb') ? ' has-error' : '' }}">
                    {!! Form::label('breadcrumb', 'Breadcrumb', ['class' => 'control-label']) !!}

                    {{ Form::select('breadcrumb', ['1'=>'Yes','0'=>'No'], null, ['class' => 'form-control']) }}
                    @if($errors->has('breadcrumb'))
                        <span class="text-danger">  {{ $errors->first('breadcrumb') }}   </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <i class="text-warning"> <br> <b>Note:</b> All themes are get it from bootswatch. <br> Please visit <a href="https://bootswatch.com/">https://bootswatch.com/</a> for theme selection.</i>
            </div>

            <div class="col-lg-12">
                <button type="submit" class="btn btn-sm btn-success">Update</button>
                {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
                <a href="{{url('admin/theme')}}" class="btn btn-sm btn-warning">Cancel</a>
            </div>

            {!! Form::close() !!}

        @endslot
    @endcomponent

@endsection
