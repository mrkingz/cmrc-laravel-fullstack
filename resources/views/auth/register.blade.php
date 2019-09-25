@extends('partials._auth')

@section('page-heading', 'Account Registeration')
@section('form')
    <div class="text-center size-12 primary-color">(Register your account to place order)</div>
    <form class="my-2 mx-4" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('Full name') }} </label>
            <input id="name" type="text" class="form-control form-control-sm{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full name" autocomplete="off" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="email">{{ __('E-mail address') }}</label>
            <input id="email" type="email" class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" autocomplete="off" required>

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
        <hr class="my-3">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-primary px-3">
                {{ __('Register')}}
            </button>
            <a class="btn btn-link bold primary-color" href="{{ url('/') }}">
                <i class="fa fa-home"></i> {{ __('Home') }}
            </a> 
        </div>
    </form>
@endsection

@section('socials')
    @include('partials._socials', ['view_type' => 'register'])
@endsection

@section('auth-btn')
    @include('partials._auth-btn', ['view_type' => 'register'])
@endsection
