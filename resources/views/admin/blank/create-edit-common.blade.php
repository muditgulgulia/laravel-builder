<div class="col-lg-6">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Blank Name', ['class' => 'control-label']) !!}
        <span class="text-danger">*</span>

        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Blank']) !!}
        @if($errors->has('name'))
            <span class="text-danger" >  {{ $errors->first('name') }}   </span>
        @endif
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}

        {{ Form::select('status', [0=>'Disable',1=>'Enable'], null, ['class' => 'form-control']) }}
        @if($errors->has('status'))
            <span class="text-danger">  {{ $errors->first('status') }}   </span>
        @endif
    </div>
</div>
<!-- /.col-lg-6 (nested) -->

<div class="col-lg-12">
    <button type="submit" class="btn btn-sm btn-success">{{$submitButtonName}}</button>
    {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
    <a href="{{url('admin/blank')}}" class="btn btn-sm btn-warning">Cancel</a>
</div>