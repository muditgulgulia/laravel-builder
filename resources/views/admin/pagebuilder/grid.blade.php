@extends('layouts.admin.layout')

@section('title') Pages @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Pages','levelOneLink'=>url('admin/page'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Active</th>
                    <th>Created Date</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr class="page{{$page->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->slug}}</td>
                        <td>{{$page->active ? 'Enable' : 'Disable'}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary"
                                   title="Edit page"
                                   href="{{ url('admin/page').'/'.$page->id .'/edit'}}"></a>
                            </span>
                            <span> | </span>
                            <span>
                                <a class="fa fa-remove text-danger row-delete"
                                   title="Remove page"
                                   data-title="page"
                                   data-href="{{ url('admin/page').'/'.$page->id .'?_token='.csrf_token() }}">
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