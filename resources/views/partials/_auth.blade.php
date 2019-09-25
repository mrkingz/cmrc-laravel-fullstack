@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="auth-wrap pt-4 mt-4">
                <div class="container d-flex justify-content-center py-1">
                    <img class="logo" src="{{ asset('storage/logo.png') }}" alt="..." />
                </div> 
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center primary-color bold my-2">
                            @yield('page-heading')
                        </div>
                        
                        @if(session('info') || session('error') || session('success'))
                            @php 
                                $type;
                                if(session('error'))
                                    $type = 'danger';
                                else
                                    $type = session('info') ? 'info' : 'success';
                            @endphp
                            @alert(['type' => $type, 'classes' => 'text-center size-12 mb-1 mx-4 my-2 message'])
                                @slot('content')
                                    {{ session('info') ?? session('error') ?? session('success') }}
                                @endslot
                            @endalert
                        @endif

                        @yield('form')
                    </div>
                </div>
                
                @yield('socials')
            </div>
            @yield('auth-btn')
        </div>
    </div>
</div>
@endsection
