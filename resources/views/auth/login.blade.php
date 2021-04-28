@extends('layouts.login')
@section('content')
    <main id="login">
        <div class="login__column">
            <img src="{{url('storage/app-images/phoneImage.png')}}" class="login__phone" />
        </div>
        <div class="login__column">
            <div class="login__box">
                <img src="{{url('storage/app-images/loginLogo.png')}}" class="login__logo" />
                    <form method="POST" action="{{ route('login') }}" class="login__form">
                    @csrf
                    <input id="email" placeholder="E-Email Or Username" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    <input id="password" placeholder="Password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    <div class="remember d-flex my-2">
                        <input id="custom-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <p class="">Remember Me!</p>
                    </div>

                    <input type="submit" value="Log in" />
                </form>
                <span class="login__divider">or</span>
                <a href="#" class="login__link">
                    <i class="fa fa-money"></i>
                    Log in with Facebook
                </a>
                <a class="login__link login__link--small" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>

            </div>
            <div class="login__box">
                <span>Don't have an account?</span> <a href="{{ route('register') }}">Sign up</a>
            </div>
            <div class="login__box--transparent">
                <span>Get the app.</span>
                <div class="login__appstores">
                    <img src="{{ url('storage/app-images/ios.png') }}" class="login__appstore" alt="Apple appstore logo" title="Apple appstore logo" />
                    <img src="{{ url('storage/app-images/android.png') }}" class="login__appstore" alt="Android appstore logo" title="Android appstore logo" />
                </div>
            </div>
        </div>
    </main>
@endsection
