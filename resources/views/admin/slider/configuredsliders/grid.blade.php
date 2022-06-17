@extends('layouts.admin.layout')

@section('title') Configure Slider @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Add Slider','levelOneLink'=>url('admin/slider/create'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Parent Slider</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($configuredSliders as $slider)
                    <tr class="slider{{$slider->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$slider->slider_id}}</td>
                        <td>{{$slider->created_at}}</td>
                        <td>{{$slider->status ? 'Enable' : 'Disable'}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary"
                                   title="Edit"
                                   href="{{ url('admin/slider').'/'.$slider->id .'/edit'}}"></a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-remove text-danger row-delete"
                                   title="Remove slider"
                                   data-title="slider"
                                   data-href="{{ url('admin/slider').'/'.$slider->id .'?_token='.csrf_token() }}">
                                </a>
                            </span>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
@section('js')
    @include('layouts.default.datatable-js')
@stop