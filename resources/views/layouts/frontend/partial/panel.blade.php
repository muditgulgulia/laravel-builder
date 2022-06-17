@extends('layouts.frontend.layout')
@section('title') {!! isset($panelTitle) ? $panelTitle : config('app.name') !!}
@stop
@section('content')
    <div class="col-md-6 col-md-offset-3">
        @if (isset($panelBody))
            <div class="panel-body">
                <div class="row">
                    {{ $panelBody }}
                </div>
            </div>
        @endif

    </div>
@stop
