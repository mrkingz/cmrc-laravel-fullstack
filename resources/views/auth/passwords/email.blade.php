@extends('partials._auth')

@section('page-heading', 'Password Recovery')

@section('form')
     <form class="my-2 mx-4" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
        @csrf
        @alert(['type' => session('status') ? 'success' : 'info', 'classes' => 'text-center my-2 size-12'])
            @slot('content')
                @if (!session('status'))
                    Enter the email address you registered with <br>
                    A password reset link will be sent to you
                @else
                    {{ session('status') }}
                @endif
            @endslot
        @endalert
        <div class="form-group">
            <label for="email">{{ __('E-mail address') }}</label>
            <input id="email" type="email" class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" autocomplete="off" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <hr class="mt-0 mb-3">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-primary px-3">
                {{ __('Continue')}}
            </button>
            <a class="p-2 btn-link bold primary-color size-13" href="{{ url('login') }}">
                {{ __('Log in') }}
            </a> 
        </div>
    </form>
@endsection

@section('socials')
    @include('partials._socials', ['view_type' => 'login'])
@endsection

