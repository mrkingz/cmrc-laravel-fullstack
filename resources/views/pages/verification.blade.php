@extends('pages.home')

@section('content')
    @content(['header' => 'Phone verification', 'classes' => 'col-lg-7'])
        @slot('pagecontent')
            <div class="bg-light d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12">
                    <div class="primary-color size-12 mb-3">
                        @alert(['type' => 'info', 'classes' => 'm-0 mt-3'])
                            @slot('content')
                            {{ dd(session('order')) }}
                                We would like to verify your phone number. 
                                Please enter the verification code we have just sent to 
                                @php
                                    $phone = session('order.data.phone'); 
                                @endphp
                                <strong >
                                    {{  __(substr_replace($phone, "***", -4) . $phone[strlen($phone) - 1 ])  }}
                                </strong><br>
                                <hr class="my-2">
                                <form action="{{ route('order.resend', Auth::id()) }}" method="POST">
                                    <span style="color: darkred">
                                    Code expires after {{ config('app.expires') }} minutes</span><br>
                                    If not received after {{ config('app.expires') }} minutes 
                
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-link btn-sm btn-sm size-12"> {{ __('Resend') }}</button>
                                 </form>
                            @endslot
                        @endalert
                    </div>
                    <form class="size-14 mb-3" action=" {{ route('order.store', ['type' => $type]) }}" method="POST" aria-label="{{ __('Change Password') }}">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="code">{{ __('Verification code') }}</label>
                            <input id="code" type="text" class="form-control form-control-sm col-lg-7 col-md-7 col-sm-12 {{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" placeholder="Verification code">
                                
                            @if ($errors->has('code'))
                                <span class="invalid-feedback" style="font-weight: normal" role="alert">
                                    {{ $errors->first('code') }}
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary">
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endslot
    @endcontent
@endsection