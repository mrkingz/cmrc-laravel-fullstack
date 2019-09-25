@extends('layouts.app')

@section('navbar')
    @include('partials._header')
@endsection

@section('content')
    <div class="flex-center position-ref full-height p-0 m-0">
        {{--  @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home bbbb</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        @endif  --}}

        {{--  <div class="content">
            <div class="title m-b-md">
                Laravel 
            </div>
        </div>  --}}
        @yield('page-content')

    </div>
@endsection

