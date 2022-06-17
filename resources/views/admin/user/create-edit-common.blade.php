<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name', ['class' => 'control-label ']) !!}
            <span class="text-danger">*</span>

            {!! Form::text('name',null , ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
            @if($errors->has('name'))
                <span class="text-danger">  {{ $errors->first('name') }}   </span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
            {!! Form::label('phone_number', 'Phone No.', ['class' => 'control-label ']) !!}
            <span class="text-danger">*</span>

            {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter name','maxlength'=>12]) !!}
            @if($errors->has('phone_number'))
                <span class="text-danger">  {{ $errors->first('phone_number') }}   </span>
            @endif
        </div>

    </div>
</div>
<!-- /.col-lg-6 (nested) -->
<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email', ['class' => 'control-label ']) !!}
            <span class="text-danger">*</span>

            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
            @if($errors->has('email'))
                <span class="text-danger">  {{ $errors->first('email') }}   </span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">

        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
            {!! Form::label('user_name', 'User Name', ['class' => 'control-label ']) !!}
            <span class="text-danger">*</span>

            {!! Form::text('user_name', null, ['class' => 'form-control', 'placeholder' => 'Enter User Name']) !!}
            @if($errors->has('user_name'))
                <span class="text-danger">  {{ $errors->first('user_name') }}   </span>
            @endif
        </div>
    </div>
</div>