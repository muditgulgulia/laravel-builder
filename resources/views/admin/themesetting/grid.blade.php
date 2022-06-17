@extends('layouts.admin.layout')

@section('title') Theme setting @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Theme setting','levelOneLink'=>url('admin/theme'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    <div class="row">
        <div class="col-lg-12">
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Selected Theme</th>
                    <th>Breadcrumb</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($themes as $theme)
                    <tr class="theme{{$theme->id}}">
                        <td>{{$serialNumberCount++}}</td>
                        <td>{{$theme->selected_theme}}</td>
                        <td>{{$theme->breadcrumb ? 'Enable' : 'Disable'}}</td>
                        <td>
                            <span>
                                <a class="fa fa-pencil text-primary"
                                   title="Edit"
                                   href="{{ url('admin/theme').'/'.$theme->id .'/edit'}}"></a>
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