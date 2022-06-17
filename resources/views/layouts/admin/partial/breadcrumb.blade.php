<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <div class="breadcrumb">
                <div class="active"><a href="{{ url('admin') }}">Dashboard</a>
                    @if($levelOne != null)
                        >>  @if($levelOneLink != null)
                            <a href="{{ url($levelOneLink) }}">{{$levelOne}}</a>
                        @else
                            <strong>  {{$levelOne}} </strong>
                        @endif
                    @endif
                    @if($levelTwo != null)
                        >>  @if($levelTwoLink != null)
                            <a href="{{ url($levelTwoLink) }}">{{$levelTwo}}</a>
                        @else
                            <strong>  {{$levelTwo}} </strong>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>