@component('layouts.frontend.partial.panel')
    @slot('panelTitle', 'Login')
    @slot('panelBody')
        <form class="form-horizonta" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <fieldset>
{{--                {{dd($errors)}}--}}
                @if($errors->has('userActivation'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('userActivation') }}</strong>
                    </span>
                @endif
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input value="{{ old('email') }}" class="form-control" placeholder="E-mail" name="email"
                           type="email" autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input class="form-control" placeholder="Password" name="password" type="password"
                           value="">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"
                               value="Remember Me">Remember Me
                    </label>

                </div>
                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_CAPTCHA_KEY')}}"></div>
                <!-- Change this to a button or input when using this as a form -->
                <div class=" btn-block">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-sm btn-success">Login</button>
                        <a href="{{url('register')}}" class="btn btn-sm btn-success">Register</a>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>
    @endslot
@endcomponent