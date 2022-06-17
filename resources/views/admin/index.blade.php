@extends('layouts.admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">I am {{Auth::user()->roles->first()->name}} Dashboard</h1>
        </div>
    </div>

@endsection
