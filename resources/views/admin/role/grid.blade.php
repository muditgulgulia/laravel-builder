@extends('layouts.admin.layout')

@section('title') Roles @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Role','levelOneLink'=>url('admin/role'),'levelTwo'=>'Grid','levelTwoLink'=>null])

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
                @foreach($roles as $role)
                    <tr class="role{{$role->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->display_name}}</td>
                        <td>{{$role->description}}</td>
                        <td>{{$role->created_at}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary" href="{{ url('admin/role').'/'.$role->id .'/edit'}}"></a>
                            </span>
                            <span> | </span>
                            {{--<span>
                                <a class="fa fa-remove text-danger row-delete"
                                     title="Remove role"
                                     data-title="role"
                                     data-href="{{ url('admin/role').'/'.$role->id .'?_token='.csrf_token() }}">
                                </a>
                            </span>
                            <span> | </span>--}}
                            <span>
                                <a class="fa fa-plus text-success"
                                   title="Add or update competence"
                                   href="{{ url('admin/role').'/'.$role->id }}"></a>
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
    @include('layouts.default.datatable-js',['dom'=>'lfrtip'])
@stop