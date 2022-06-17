<div id='loadingmessage'>
    <img src='{{url('images/loader-1.gif')}}' class="loaderimage"/>
</div>
<script src="{{url('panel/data-table/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{url('panel/data-table/js/buttons.flash.min.js')}}" type="text/javascript"></script>
<script src="{{url('panel/data-table/js/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{url('panel/data-table/js/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{url('panel/data-table/js/vfs_fonts.js')}}" type="text/javascript"></script>
<script src="{{url('panel/data-table/js/buttons.html5.min.js')}}" type="text/javascript"></script>
<script src="{{url('panel/data-table/js/buttons.print.min.js')}}" type="text/javascript"></script>
<script>
//    $('#loadingmessage').show();  // show the loader.
    $(document).ready(function () {
        $('#datatable-grid').DataTable({
            dom: '{!! isset($dom) ? $dom : 'lfrtip' !!}',//'lfrtip , Bfrtip'
            buttons: [
                {!! isset($buttons) ? $buttons : '' !!}
            ],
            "pageLength": 10,
            // show pagination only when record greater then 10 record.
            drawCallback: function(settings) {
                var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.toggle(this.api().page.info().pages > 1);
            }

        });
        $('#datatable-grid').show();  // show the loader.
//
        $('#loadingmessage').hide();  // show the loader.
    });
</script>
