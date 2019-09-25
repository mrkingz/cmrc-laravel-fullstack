@extends('partials._new-resource')

@section('resource-content')
    <div class="bg-lighter primary-color px-4 py-3 size-13">
        <form class="p-4" action="{{ route('resources.type') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="type">{{ __('Select resource type to upload') }}</label>
                <select id="type" class="form-control form-control-sm size-11 px-0 col-lg-5 col-md-5 col-sm-12 {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                    <option value="">Select resource category</option>
                    <option value="article">Article</option>
                    <option value="audio">Audio</option>
                    <option value="video">Video</option>
                </select> 
                
                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('type') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-sm">
                    {{ __('Continue') }}
                </button>
            </div>
        </form>
    </div>
@endsection