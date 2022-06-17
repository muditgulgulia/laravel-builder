@extends('layouts.admin.layout')

@section('title') Users List @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'User','levelOneLink'=>'/','levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allUsers as $user)
                    <tr id="user{{$user->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->user_name}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary"
                                   title="Edit user"
                                   href="{{ url('admin/user').'/'.$user->id .'/edit'}}">
                                </a>
                            </span>
                            <span> | </span>

                            <span>
                                <a class="fa fa-remove text-danger row-delete"
                                     title="Remove user"
                                     data-title="user"
                                     data-href="{{ url('admin/user').'/'.$user->id .'?_token='.csrf_token() }}">
                                </a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-plus text-success"
                                   title="Attach roles"
                                   href="{{ url('admin/user').'/'.$user->id }}"></a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-circle text-{{$user->active ? 'danger' : 'success'}}"
                                   title="{{$user->active ? 'Activated' : 'Deactivated'}} user"
                                   href="{{ url('admin/user/active').'/'.$user->active.'/'.$user->id .'&_token='.csrf_token() }}">
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
    @include('layouts.default.datatable-js',['buttons'=>"'copy','csv','excel','pdf','print'",'dom'=>'Bfrtip'])
@stop