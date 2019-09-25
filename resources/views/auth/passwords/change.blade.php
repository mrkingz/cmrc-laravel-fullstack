@extends('pages.home')

@section('content')
    @content(['header' => 'Change password', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12">
                    <div class="primary-color my-0">
                        <div class="size-12 my-2 pb-2">
                            Enter your current password below. <br>
                            We will send a password reset link to the e-mail address you registered with
                        </div>
                        @php 
                            $type;
                            if(session('error'))
                                $type = 'danger';
                            else
                                $type = session('success') ? 'success' : '';
                        @endphp
                        @if ($type)
                            @alert(['type' => $type, 'classes' => 'px-0 size-12 my message'])
                                @slot('content')
                                    <p class="mx-4 my-0"> {{ session('success') }} </p>
                                @endslot
                            @endalert
                        @endif
                    </div>
                    <form class="size-14 mb-3" action=" {{ route('password.verify') }}" method="POST" aria-label="{{ __('Change Password') }}">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="current-password">{{ __('Current Password') }}</label>
                            <input id="current-password" type="password" class="form-control form-control-sm col-lg-7 col-md-7 col-sm-12 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Current password">
                                
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" style="font-weight: normal" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endslot
    @endcontent
@endsection