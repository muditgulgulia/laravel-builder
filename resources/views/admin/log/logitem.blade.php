@extends('layouts.admin.layout')

@section('title') Log @stop
@section('content')
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'All Logs','levelOneLink'=>url('admin/log'),'levelTwo'=>'Grid','levelTwoLink'=>null])

    {{--<a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-angle-double-left"></i> All Logs</a><br><br>--}}
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <h3>{{ \Carbon\Carbon::createFromTimeStamp($log['last_modified'])->formatLocalized('%d %B %Y') }}:</h3>
            <pre>
        <code>
          {{ $log['content'] }}
        </code>
      </pre>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

@endsection
@section('js')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@stop