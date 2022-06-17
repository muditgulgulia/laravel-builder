<div class="col-lg-6">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Role Identity', ['class' => 'control-label']) !!}
        <span class="text-danger">*</span>

        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter role identity i.e. admin / employee','required']) !!}
        @if($errors->has('name'))
            <span class="text-danger" >  {{ $errors->first('name') }}   </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
        {!! Form::label('display_name', 'Display Name', ['class' => 'control-label ']) !!}

        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Enter display Name']) !!}
        @if($errors->has('display_name'))
            <span class="text-danger" >  {{ $errors->first('display_name') }}   </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Description', ['class' => 'control-label ']) !!}
        <div>
            {!! Form::text('description',null, ['class' => 'form-control','id' => 'password-confirm', 'placeholder' => 'Enter description']) !!}

        </div>
        @if($errors->has('description'))
            <span class="text-danger" >  {{ $errors->first('description') }}   </span>
        @endif
    </div>
</div>

<div class="col-lg-12">
    <button type="submit" class="btn btn-sm btn-success">{{$submitButtonName}}</button>
    {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
    <a href="{{url('admin/role')}}" class="btn btn-sm btn-warning">Cancel</a>
</div>