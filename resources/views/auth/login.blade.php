@extends('partials._auth')

@section('page-heading', 'Welcome!')

@section('form')
    <form class="my-2 mx-4" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div class="form-group">
            <label for="email">{{ __('E-mail address') }}</label>
            <input id="email" type="email" class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" autocomplete="off" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="form-group mb-2">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control form-control-sm{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="form-group mb-1 mt-3">
            <div class="d-flex justify-content-between flex-wrap px-1">
                <div class="form-check form-check-inline">
                    <input id="remember" class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label size-12" for="remember">{{ __('Remember me') }}</label>
                </div>
                <a id="forgot" class="btn-link p-0 forgot size-12 normal" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>                       
            </div>
        </div>
        <hr class="mt-0 mb-3">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-primary px-3">
                {{ __('Log in')}}
            </button>
            <a class="p-2 btn-link bold primary-color size-13" href="{{ url('/') }}">
                <i class="fa fa-home"></i> {{ __('Home') }}
            </a> 
        </div>
    </form>
@endsection

@section('socials')
    @include('partials._socials', ['view_type' => 'login'])
@endsection

@section('auth-btn')
    @include('partials._auth-btn', ['view_type' => 'login'])
@endsection