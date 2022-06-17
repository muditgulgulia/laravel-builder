<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('slider_name') ? ' has-error' : '' }}">
            {!! Form::label('slider_name', 'Slider Name', ['class' => 'control-label']) !!}
            <span class="text-danger">*</span>

            {!! Form::text('slider_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
            @if($errors->has('slider_name'))
                <span class="text-danger">  {{ $errors->first('slider_name') }}   </span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('style') ? ' has-error' : '' }}">
            {!! Form::label('style', 'Style', ['class' => 'control-label']) !!}

            {!! Form::text('style', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
            @if($errors->has('style'))
                <span class="text-danger">  {{ $errors->first('style') }}   </span>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="col-lg-6">
        <div class="form-group{{ $errors->has('active_class') ? ' has-error' : '' }}">
            {!! Form::label('active_class', 'Class', ['class' => 'control-label']) !!}

            {!! Form::text('active_class', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
            @if($errors->has('active_class'))
                <span class="text-danger">  {{ $errors->first('active_class') }}   </span>
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
</div>
<div class="col-lg-12">
    <i class="text-warning"> <br> <b>Note:</b> All sliders are get it from www.w3schools.com. Please visit <a
                href="https://www.w3schools.com/w3css/w3css_slideshow.asp">www.w3schools.com</a> for slider
        selection.</i>
</div>
<!-- /.col-lg-6 (nested) -->

<div class="col-lg-12">
    <button type="submit" class="btn btn-sm btn-success">{{$submitButtonName}}</button>
    {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
    <a href="{{url('admin/slider')}}" class="btn btn-sm btn-warning">Cancel</a>
</div>