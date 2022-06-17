@extends('layouts.admin.layout')

@section('title') Permission @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Permission','levelOneLink'=>url('admin/permission'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Role identity</th>
                    <th>Role name</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr class="permission{{$permission->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->display_name}}</td>
                        <td>{{$permission->description}}</td>
                        <td>{{$permission->created_at}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary"
                                   href="{{ url('admin/permission').'/'.$permission->id .'/edit'}}"></a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-remove text-danger row-delete"
                                   title="Remove user"
                                   data-title="permission"
                                   data-href="{{ url('admin/permission').'/'.$permission->id .'?_token='.csrf_token() }}">
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