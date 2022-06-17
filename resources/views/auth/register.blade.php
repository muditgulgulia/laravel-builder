@component('layouts.frontend.partial.panel')
    @slot('panelTitle', 'Register')
    @slot('panelBody')
        <form class="form-horizonta" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <fieldset>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input value="{{ old('name') }}" class="form-control" placeholder="Name" name="name" type="name"
                           autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input value="{{ old('email') }}" class="form-control" placeholder="E-mail" name="email"
                           type="email"
                           autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" id="password-confirm"
                           name="password_confirmation"
                           type="password" value="">
                </div>

                <div class=" btn-block">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-sm btn-success">Register</button>
                        <a href="{{url('login')}}" class="btn btn-sm btn-success">Login</a>
                    </div>
                </div>
            </fieldset>
        </form>
    @endslot
@endcomponent