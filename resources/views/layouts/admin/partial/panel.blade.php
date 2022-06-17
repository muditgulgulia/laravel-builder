<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-{{ $class or 'default' }}">
            @if (isset($panelTitle))
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ $panelTitle}}
                    </h3>
                </div>
            @endif

            @if (isset($panelBody))
                <div class="panel-body">
                    <div class="row">
                        {{ $panelBody }}
                    </div>
                </div>
            @endif

            @if (isset($panelFooter))
                <div class="panel-footer">
                    {{ $panelFooter }}
                </div>
            @endif
        </div>
    </div>
</div>