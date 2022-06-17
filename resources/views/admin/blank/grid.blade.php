@extends('layouts.admin.layout')

@section('title') Blank @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Blank','levelOneLink'=>url('admin/blank'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blanks as $blank)
                    <tr class="blank{{$blank->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$blank->name}}</td>
                        <td>{{$blank->created_at}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary"
                                   title="Edit"
                                   href="{{ url('admin/blank').'/'.$blank->id .'/edit'}}"></a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-remove text-danger row-delete"
                                   title="Remove blank"
                                   data-title="blank"
                                   data-href="{{ url('admin/blank').'/'.$blank->id .'?_token='.csrf_token() }}">
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