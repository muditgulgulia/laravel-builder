<div class="col-lg-12">
    <div class=" ">
        <div class="form-group{{ $errors->has('module_name') ? ' has-error' : '' }}">
            {!! Form::label('module_name', 'Module Name', ['class' => 'control-label']) !!}
            <span class="text-danger">*</span>

            {!! Form::text('module_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Module Name e.g. MyNewModel']) !!}
            @if($errors->has('module_name'))
                <span class="text-danger">  {{ $errors->first('module_name') }}   </span>
            @endif
        </div>
    </div>
</div>
<div>
    <div class="col-lg-12">
        <div class=" ">
            <div class="form-group{{ $errors->has('make_migration') ? ' has-error' : '' }}">
                {{ Form::checkbox('make_migration', null, null, ['ng-model' => 'migration_fields_show','ng-click'=>'showMigrations()']) }}
                {!! Form::label('make_migration', 'Make Migration', ['class' => 'control-label']) !!}
                @if($errors->has('make_migration'))
                    <span class="text-danger">  {{ $errors->first('make_migration') }}   </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12" ng-if="migration_fields_show">
        @include('admin.module.add-migration-fields')
    </div>


</div>
    <div class="col-lg-12">
        <div class=" ">
            <div class="form-group{{ $errors->has('make_controller_with_resource') ? ' has-error' : '' }}">
                {{ Form::checkbox('make_controller_with_resource', null, null, ['class' => '']) }}
                {!! Form::label('make_controller_with_resource', 'Make Controller With Resource', ['class' => 'control-label']) !!}
                @if($errors->has('make_controller_with_resource'))
                    <span class="text-danger">  {{ $errors->first('make_controller_with_resource') }}   </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class=" ">
            <div class="form-group">
                {!! Form::label('controller_related_to', 'Controller Related to', ['class' => 'control-label']) !!}

                {{ Form::select('controller_related_to', ['Admin'=>'Admin','Frontend'=>'Frontend'], null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class=" ">
            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                {!! Form::label('active', 'Add Menu', ['class' => 'control-label']) !!}

                {{ Form::select('active', [0=>'Disable',1=>'Enable'], null, ['class' => 'form-control']) }}
                @if($errors->has('active'))
                    <span class="text-danger">  {{ $errors->first('active') }}   </span>
                @endif
            </div>
        </div>
    </div>
{{--<div class="col-lg-6">
    <div class="form-group{{ $errors->has('migration_fields') ? ' has-error' : '' }}">
        {!! Form::label('migration_fields', 'Migration Fields', ['class' => 'control-label']) !!}
        <span class="text-danger">*</span>
        {{ Form::textarea('migration_fields', null, ['class' => 'form-control','placeholder' => 'Enter Module']) }}
        @if($errors->has('migration_fields'))
            <span class="text-danger">  {{ $errors->first('migration_fields') }}   </span>
        @endif
    </div>
</div>--}}
<!-- /.col-lg-6 (nested) -->

    <div class="col-lg-12">
        <button type="submit" class="btn btn-sm btn-success">{{$submitButtonName}}</button>
        {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
        <a href="{{url('admin/module')}}" class="btn btn-sm btn-warning">Cancel</a>
    </div>