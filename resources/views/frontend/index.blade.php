@extends('layouts.frontend.layout')
@section('title') {{isset($slug) ? ucwords($slug) : config('app.name')}}
@stop
@section('content')

    @if(!isset($slug))
        <div class="jumbotron">
            @include('frontend.pages.default')
        </div>
    @else
        @foreach($pages as $page)
                @if(isset($slug) && $slug == $page->slug)
                    <div class="jumbotron">
                        {!! $page->content !!}
                    </div>
            @endif
        @endforeach
    @endif

@endsection