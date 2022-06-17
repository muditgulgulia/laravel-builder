{{--<div class="col-lg-12">--}}
<div class="col-lg-6">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title', 'Page Title', ['class' => 'control-label']) !!}
        <span class="text-danger">*</span>

        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter page title']) !!}
        @if($errors->has('title'))
            <span class="text-danger">  {{ $errors->first('title') }}   </span>
        @endif
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        {!! Form::label('slug', 'Page Slug', ['class' => 'control-label']) !!}
        <span class="text-danger">*</span>

        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Enter page slug']) !!}
        @if($errors->has('slug'))
            <span class="text-danger">  {{ $errors->first('slug') }}   </span>
        @endif
    </div>
</div>
{{--</div>--}}

<div class="col-lg-12">
    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        {!! Form::label('content', 'Page Content', ['class' => 'control-label']) !!}
        <span class="text-danger">*</span>

        {{ Form::textarea('content', null, ['class' => 'form-control ckeditor']) }}
        @if($errors->has('content'))
            <span class="text-danger">  {{ $errors->first('content') }}   </span>
        @endif
    </div>
</div>

<div class="col-lg-6">
    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
        {!! Form::label('active', 'Page Status', ['class' => 'control-label']) !!}

        {{ Form::select('active', [0=>'Disable',1=>'Enable'], null, ['class' => 'form-control']) }}
        @if($errors->has('active'))
            <span class="text-danger">  {{ $errors->first('active') }}   </span>
        @endif
    </div>
</div>

<div class="col-lg-6">
    <div class="form-group{{ $errors->has('menu_option') ? ' has-error' : '' }}">
        {!! Form::label('menu_option', 'Set Menu', ['class' => 'control-label']) !!}

        {{ Form::select('menu_option', ['none'=>'None','header'=>'On Header','footer'=>'On Footer','both'=>'Both'], null, ['class' => 'form-control']) }}
        @if($errors->has('menu_option'))
            <span class="text-danger">  {{ $errors->first('active') }}   </span>
        @endif
    </div>
</div>

<div class="col-lg-12">
    <button type="submit" class="btn btn-sm btn-success">{{$submitButtonName}}</button>
    {!! Form::reset('Reset', ['class' => 'btn btn-sm btn-warning']) !!}
    <a href="{{url('admin/blank')}}" class="btn btn-sm btn-warning">Cancel</a>
</div>