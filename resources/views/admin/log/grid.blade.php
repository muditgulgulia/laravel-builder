@extends('layouts.admin.layout')

@section('title') Log @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Log','levelOneLink'=>url('admin/log'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Last Modified</th>
                    <th class="text-right">Size</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $k => $log)
                    <tr>
                        <td scope="row">{{ $k+1 }}</td>
                        <td>{{ $log['last_modified'] }}</td>
                        <td>{{ $log['last_modified'] }}</td>
                        <td class="text-right">{{ round((int)$log['file_size']/1048576, 2).' MB' }}</td>
                        <td>
                           <span>
                               <a class="fa fa-eye"
                                  href="{{ url(config('backpack.base.route_prefix', 'admin').'/log/'.$log['file_name']) }}"> </a>
                           </span>
                            {{--<i class="fa fa-eye"></i> Preview</a>--}}
                            <span> | </span>
                            <span>
                                <a class="fa fa-cloud-download"
                                   href="{{ url(config('backpack.base.route_prefix', 'admin').'/log/downloads/'.$log['file_name']) }}">
                                {{--<i class="fa fa-cloud-download"></i>--}}
                            </a>
                            </span>
                            <span> | </span>
                            <a class="fa fa-remove text-danger row-delete"
                               title="Remove log"
                               data-title="log"
                               data-href="{{ url('admin/log').'/'.$log['file_name'] .'?_token='.csrf_token() }}">
                                {{--<i class="fa fa-trash-o"></i>--}}
                            </a>
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