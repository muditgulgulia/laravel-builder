<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jBox/1.3.3/jBox.min.js"></script>
<!-- jBox JavaScript -->
<script src="{{ url('dist/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ url('dist/js/load-image.all.min.js') }}"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ url('dist/js/sb-admin-2.js') }}"></script>
<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('panel/data-table/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>

<!-- all javaScript work related to project dynamically-->
<script src="{{ url('js/partial-js.js') }}"></script>

<script>
    $(document).ready(function() {
        $('input:not([type=hidden]):first').focus();

        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    })

    //$('form input:first').siblings('input[type!="hidden"]:first').hide();
    //$('form:first *:input[type!=hidden]:first').focus();
</script>
<!-- blueimp Gallery script -->
<script src="{{ url('dist/js/jquery.blueimp-gallery.min.js') }}"></script>
<script src="{{ url('js/angular/angular.js') }}"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ url('dist/js/jquery.iframe-transport.js') }}"></script>
<!-- The basic File Upload plugin -->
<script src="{{ url('dist/js/jquery.fileupload.js') }}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ url('dist/js/jquery.fileupload-process.js') }}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ url('dist/js/jquery.fileupload-image.js') }}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ url('dist/js/jquery.fileupload-validate.js') }}"></script>
<!-- The File Upload Angular JS module -->
<script src="{{ url('dist/js/jquery.fileupload-angular.js') }}"></script>
<!-- The main application script -->
<script src="{{ url('dist/js/app.js') }}"></script>
