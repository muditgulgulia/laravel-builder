<div style="display: none" id="jumbotronDisplay">
    <fieldset data-ng-repeat="field in fields" class="jumbotron">
        <div id="@{{elemnt.id}}">
            <div class="col-lg-6">
                {!! Form::label('field_name', 'Field Name', ['class' => 'control-label']) !!}
                {!! Form::text('field.name', null, ['class' => 'form-control', 'placeholder' => 'Enter Field Name e.g. username, email','ng-model'=>'field.name']) !!}
            </div>
            <div class="col-lg-6">

                {!! Form::label('Data Type', 'Data Type', ['class' => 'control-label']) !!}
                {{ Form::select('field.data_type', ['string'=>'String','text'=>'Text','integer'=>'Integer','date'=>'Date','boolean'=>'Boolean'], null, ['class' => 'form-control','ng-model'=>'field.data_type']) }}

            </div>
            <div class="col-lg-12">
                &nbsp;
            </div>
            <div class="col-lg-6">
                {{ Form::checkbox('field.default_check', null, null, ['class' => '','ng-model' => 'field.default_check','ng-click'=>'showDefaultTableAttribute()']) }}
                {!! Form::label('default', 'Default', ['class' => 'control-label']) !!}
                {!! Form::text('field.default', null, ['class' => 'form-control','ng-model'=>'field.default', 'placeholder' => 'Enter Default Value','ng-if'=>'field.default_check']) !!}

                {{ Form::checkbox('field.nullable', null, null, ['class' => '','ng-model'=>'field.nullable']) }}
                {!! Form::label('nullable', 'Nullable', ['class' => 'control-label']) !!}

                {{ Form::checkbox('field.unique', null, null, ['class' => '','ng-model'=>'field.unique']) }}
                {!! Form::label('unique', 'Unique', ['class' => 'control-label']) !!}

                {{--<input type="text" ng-model="field.name" name="" placeholder="Enter mobile number">--}}
            </div>
            <div class="col-lg-6">
                <button class="btn btn-danger btn-sm  pull-right bottom-right" ng-show="$last" ng-click="removefield()">
                    <span class="fa fa-close"></span></button>
            </div>
        </div>
    </fieldset>

    <span class="btn btn-success" ng-click="addNewfield()">Add fields</span>
<span>
    {{ Form::checkbox('migrate_now', null, null, ['class' => '','ng-model'=>'migrate_now']) }}
    {!! Form::label('migrate_now', 'Migrate Now', ['class' => 'control-label']) !!}

</span>
    <div class="col-lg-12">
        &nbsp;
    </div>

    <div id="fieldsDisplay">
        <input type="hidden" name="allMigrationFields" value=" @{{ fields  }}">
    </div>
</div>