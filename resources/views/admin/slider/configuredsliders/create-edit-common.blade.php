<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('slider_id') ? ' has-error' : '' }}">
            {!! Form::label('slider_id', 'Select Slider', ['class' => 'control-label']) !!}
            <span class="text-danger">*</span>

            {{ Form::select('slider_id', $sliderList, null, ['class' => 'form-control']) }}
            {{--            {!! Form::text('slider_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}--}}
            @if($errors->has('slider_name'))
                <span class="text-danger">  {{ $errors->first('slider_name') }}   </span>
            @endif
        </div>
    </div>
</div>
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button" ng-class="{disabled: disabled}">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple ng-disabled="disabled">
                </span>
            <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start upload</span>
            </button>
            <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
            </button>
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="col-lg-5 fade" data-ng-class="{in: active()}">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" data-file-upload-progress="progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table class="table table-striped files ng-cloak">
        <tr data-ng-repeat="file in queue" data-ng-class="{'processing': file.$processing()}">
            <td data-ng-switch data-on="!!file.thumbnailUrl">
                <div class="preview" data-ng-switch-when="true">
                    <a data-ng-href="{{'file.url'}}" title="{{'file.name'}}" download="{{'file.name'}}" data-gallery><img data-ng-src="{{'file.thumbnailUrl'}}" alt=""></a>
                </div>
                <div class="preview" data-ng-switch-default data-file-upload-preview='file'></div>
            </td>
            <td>
            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                    {!! Form::label('caption', 'Caption', ['class' => 'control-label']) !!}
                    <span class="text-danger">*</span>

                    {!! Form::text('sliderimg[caption][]', null, ['class' => 'form-control', 'placeholder' => 'Enter Caption']) !!}
                    @if($errors->has('caption'))
                        <span class="text-danger">  {{ $errors->first('caption') }}   </span>
                    @endif
                </div>
            </div>
            </td>
            <td>
                <div class="col-lg-8">
                    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                        {!! Form::label('position', 'Select Position', ['class' => 'control-label']) !!}
                        <span class="text-danger">*</span>

                        {{ Form::select('sliderimg[position][]', $captionPosition, null, ['class' => 'form-control']) }}
                        @if($errors->has('position'))
                            <span class="text-danger">  {{ $errors->first('position') }}   </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="sliderimg[imagename][]" value="">
            </td>
            <td>
                <p class="name" data-ng-switch data-on="!!file.url">
                        <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                            <a data-ng-switch-when="true" data-ng-href="{{'file.url'}}" title="{{'file.name'}}" download="{{'file.name'}}" data-gallery>{{'file.name'}}</a>
                            <a data-ng-switch-default data-ng-href="{{'file.url'}}" title="{{'file.name'}}" download="{{'file.name'}}">{{'file.name'}}</a>
                        </span>
                    <span data-ng-switch-default>{{'file.name'}}</span>
                </p>
                <strong data-ng-show="'file.error'" class="error text-danger">{{'file.error'}}</strong>
            </td>
            <td>
                <p class="size">{{'file.size | formatFileSize'}}</p>
                <div class="progress progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-file-upload-progress="file.$progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
            </td>
            <td>
                <!--<button type="button" class="btn btn-primary start" data-ng-click="file.$submit()" data-ng-hide="!'file.$submit || options.autoUpload'" data-ng-disabled="file.$state() == 'pending' || file.$state() == 'rejected'">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>-->
                <button type="button" class="btn btn-warning cancel" data-ng-click="'file.$cancel()'" data-ng-hide="!'file.$cancel'">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
                <button data-ng-controller="FileDestroyController" type="button" class="btn btn-danger destroy" data-ng-click="'file.$destroy()'" data-ng-hide="'!file.$destroy'">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
            </td>
        </tr>
    </table>

<br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Demo Notes</h3>
    </div>
    <div class="panel-body">
        <ul>
            <li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
            <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
            <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
            <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
            <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
            <li>Built with the <a href="http://getbootstrap.com/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
        </ul>
    </div>
</div>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}

            {{ Form::select('status', [0=>'Disable',1=>'Enable'], null, ['class' => 'form-control']) }}
            @if($errors->has('status'))
                <span class="text-danger">  {{ $errors->first('status') }}   </span>
            @endif
        </div>
    </div>
</div>
<!-- /.col-lg-6 (nested) -->

<div class="col-lg-12">
    <button type="submit" class="btn btn-sm btn-success">{{$submitButtonName}}</button>
    {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
    <a href="{{url('admin/slider')}}" class="btn btn-sm btn-warning">Cancel</a>
</div>