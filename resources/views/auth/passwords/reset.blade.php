@extends('partials._auth')

@section('page-heading', 'Reset password')

@section('form')
    <form class="my-2 mx-4 pb-4" method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
        @csrf
        @include('partials._required')

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">{{ __('E-mail address') }} <span class="required">*</span></label>
            <input id="email" type="email" class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" autocomplete="off" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="form-group mb-2">
            <label for="password">{{ __('New password') }} <span class="required">*</span></label>
            <input id="password" type="password" class="form-control form-control-sm{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="form-group mb-2">
            <label for="password">{{ __('Confirm password') }} <span class="required">*</span></label>
            <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Confirm password" required>
        </div>
        <hr class="my-3">
        <div class="form-group d-flex justify-content-between pb-2">
            <button class="btn btn-primary px-3"> 
                {{ __('Save')}}
            </button>
        </div>
    </form>
@endsection