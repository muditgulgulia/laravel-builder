@extends('layouts.admin.layout')

@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">401</strong> / <small>Unauthorized</small></div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <h2 class="am-text-center am-text-xxxl am-margin-top-lg">401. No permission to operate!</h2>
                <p class="am-text-center"><a href="{{ Session()->get('previousUrl') }}">Click here to return</a></p>
        <pre class="page-404">
          .----.
       _.'__    `.
   .--($)($$)---/#\
 .' @          /###\
 :         ,   #####
  `-..__.-' _.-\###/
        `;_:    `"'
      .'"""""`.
     /,  ya ,\\
    //  401!  \\
    `-._______.-'
    ___`. | .'___
   (______|______)
        </pre>
            </div>
        </div>
    </div>
    <!-- content end -->


<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

@stop
