@extends('pages.home')

@section('content')
    @content(['header' => 'New Testimony', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-10 col-md-10 col-sm-12 details">
                    @if(session('error') || session('success'))
                        @php 
                            $type = 'success';
                            if(session('error'))
                                $type = 'danger';
                        @endphp
                        @alert(['type' => $type, 'classes' => 'text-center size-12'])
                            @slot('content')
                                @if (session('success') )
                                    Your testimony has been saved successfully <br/>
                                    We will publish it after review, thank you!
                                @else
                                    Sorry, something went wrong. <br>
                                    Could not save your testimony, try again.
                                @endif
                            @endslot
                        @endalert
                    @endif
                    <form class="py-4 size-14" action="{{ route('testimony.store') }}" method="POST">
                        @csrf
                        @include('partials._required')
                        <div class="form-group">
                            <label for="name">{{ __('Full name') }} <span class="required">*</span></label>
                            <input id="name" type="text" class="form-control form-control-sm  {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full name" autocomplete="off" autofocus>
                
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="m-0" for="testimony"> {{ __('Testimony') }} <span class="required">*</span></label>
                            <div id="testimony" class="form-control editable-div {{ $errors->has('testimony') ? ' is-invalid' : '' }}" contentEditable="true" placeholder="Enter your testimony here">
                                {{ old('testimony') }}
                            </div>
                            @if ($errors->has('testimony'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('testimony') }}
                                </span>
                            @endif
                            <input type="hidden" name="testimony" value=""> 
                        </div>
                        <hr class="my-2">
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="submitForm(event, 'testimony');">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endslot
    @endcontent
@endsection