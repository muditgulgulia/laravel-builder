@extends('layouts.admin.layout')

@section('title') Module @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Module','levelOneLink'=>url('admin/module'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($modules as $module)
                    <tr class="module{{$module->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$module->module_name}}</td>
                        <td>{{$module->created_at}}</td>
                        <td>{{$module->active ? 'Enable' : 'Disable'}}</td>
                        <td>

                            <span>
                                <a class="fa fa-circle text-{{$module->active ? 'danger' : 'success'}}"
                                   title="{{$module->active ? 'Activated' : 'Deactivated'}} Module"
                                   href="{{ url('admin/module/active').'/'.$module->active.'/'.$module->id .'&_token='.csrf_token() }}">
                                </a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-remove text-danger row-delete"
                                   title="Remove module"
                                   data-title="module"
                                   data-href="{{ url('admin/module').'/'.$module->id .'?_token='.csrf_token() }}">
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