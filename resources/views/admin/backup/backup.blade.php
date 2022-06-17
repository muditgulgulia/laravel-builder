@extends('layouts.admin.layout')

@section('title') Backup @stop
@section('css')
    @include('layouts.default.datatable-css')
@stop
@section('content')
    {{--breadcrumb--}}
    @include('layouts.admin.partial.breadcrumb',['levelOne'=>'Backup','levelOneLink'=>url('admin/backup'),'levelTwo'=>'Grid','levelTwoLink'=>null])
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <button id="create-new-backup-button" href="{{url('admin/backup/create') }}"
                    class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i
                            class="fa fa-plus"></i> Create a new backup</span></button>
            <br>
            <h3>Existing Backups</h3>
            <table id="datatable-grid" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>location</th>
                    <th>date</th>
                    <th class="text-right">file size</th>
                    <th class="text-right">actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($backups as $k => $b)
                    <tr>
                        <th scope="row">{{ $k+1 }}</th>
                        <td>{{ $b['disk'] }}</td>
                        <td>{{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}</td>
                        <td class="text-right">{{ round((int)$b['file_size']/1048576, 2).' MB' }}</td>
                        <td class="text-right">
                            @if ($b['download'])
                                <a class="btn btn-xs btn-default"
                                   href="{{ url(config('backpack.base.route_prefix', 'admin').'/backup/download/') }}?disk={{ $b['disk'] }}&path={{ urlencode($b['file_path']) }}&file_name={{ urlencode($b['file_name']) }}"><i
                                            class="fa fa-cloud-download"></i> download</a>
                            @endif
                            <a class="btn btn-xs btn-danger" data-button-type="delete"
                               href="{{ url(config('backpack.base.route_prefix', 'admin').'/backup/delete/'.$b['file_name']) }}?disk={{ $b['disk'] }}"><i
                                        class="fa fa-trash-o"></i> delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

@endsection

@section('js')
    <!-- Ladda Buttons (loading buttons) -->
    <script src="{{ asset('/ladda/spin.js') }}"></script>
    <script src="{{ asset('/ladda/ladda.js') }}"></script>

    <script>
        jQuery(document).ready(function ($) {
            // capture the Create new backup button
            $("#create-new-backup-button").click(function (e) {
                e.preventDefault();
                var create_backup_url = $(this).attr('href');
                // Create a new instance of ladda for the specified button
                var l = Ladda.create(document.querySelector('#create-new-backup-button'));
                // Start loading
                l.start();
                // Will display a progress bar for 10% of the button width
                l.setProgress(0.3);
                setTimeout(function () {
                    l.setProgress(0.6);
                }, 2000);
                // do the backup through ajax
                $.ajax({
                    url: create_backup_url + '?_token={{csrf_token()}}',
                    type: 'GET',
                    success: function (result) {
                        console.log(result);
                        l.setProgress(0.9);
                        // Show an alert with the result
                        if (result.indexOf('failed') >= 0) {
                            alert('warning')
                        }
                        else {
                            alert('success');
                        }
                        // Stop loading
                        l.setProgress(1);
                        l.stop();
                        // refresh the page to show the new file
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (result) {
                        console.log(result);
                        l.setProgress(0.9);
                        // Show an alert with the result
                        alert('create error message');
                        // Stop loading
                        l.stop();
                    }
                });
            });
            // capture the delete button
            $("[data-button-type=delete]").click(function (e) {
                e.preventDefault();
                var delete_button = $(this);
                var delete_url = $(this).attr('href');
                if (confirm("delete confirm") == true) {
                    $.ajax({
                        url: delete_url,
                        type: 'DELETE',
                        success: function (result) {
                            // Show an alert with the result
                            // new PNotify({
                            //     title: "delete confirmation title",
                            //     text: "delete confirmation message",
                            //     type: "success"
                            // });
                            alert('delete confirmation message');
                            // delete the row from the table
                            delete_button.parentsUntil('tr').parent().remove();
                        },
                        error: function (result) {
                            // Show an alert with the result
                            // new PNotify({
                            //     title: "delete error title",
                            //     text: "delete error message",
                            //     type: "warning"
                            // });
                            alert('delete error message');
                        }
                    });
                } else {
                    alert('delete cancel message info');
                    // new PNotify({
                    //     title: "delete cancel title",
                    //     text: "delete cancel message",
                    //     type: "info"
                    // });
                }
            });
        });
    </script>
@endsection