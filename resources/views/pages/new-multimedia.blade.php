@extends('partials._new-resource')

@section('resource-content')
    <div class="bg-lighte alert-light d-flex justify-content-center mt-1 py-4">
        <div class="col-lg-10 col-md-10 col-sm-12 details">

            <div class="preview pt-4 hide">
                <div class="append display-file"></div>
                <div class="text-center mt-4">
                    <label id="title" class="bold primary-color" style="text-transform: uppercase;"></label>
                </div>
                <div class="between display-file my-4"></div>
                <div class="details">
                    <blockquote class="content size-13"></blockquote>
                </div>
                <div class="prepend display-file"></div>
            </div>

            <form class="pb-4 pt-2 size-14" action="{{ route('resource.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="publication-wrapper">
                    @if ( session('success'))
                        @response(['response' => session('success'), 'width' => 'col-lg-12'])
                            @slot('extra')
                                <div class="alert alert-info m-0 size-12 py-4">
                                    {!! 
                                        __("New $type resource uploaded successfully!<br>To publish, click publication settings")
                                    !!}
                                </div>
                                <hr class="my-1">
                                <div class="row no-gutters publication-sucsess">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="px-1 mb-1">
                                            <a href="" class="btn btn-primary btn-block">{{ __('Publication settings') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="px-1 mb-1">
                                            <a href="" class="btn btn-primary btn-block">{{ __('Publish later') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endslot
                        @endresponse
                    @else

                        @include('partials._required')
                        @if(session('error'))
                            @alert(['type' => 'danger', 'classes' => 'text-center size-12 mb-1 my-2 message'])
                                @slot('content')
                                    {{ __(session('error')) }}
                                    <div>{{ __('Publication not submitted, please try again.') }}</div>
                                @endslot
                            @endalert
                        @endif

                        <div class="form-group">
                            <label for="category">{{ __('Resource type') }}</label>
                            <div id="category" class="input-group">
                                <input type="text" class="form-control form-control-sm bg-white col-lg-6 col-md-6 col-sm-12" readonly aria-label="Recipient's username" name="type" value="{{ __(ucFirst($type)) }}" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <a href="{{ route('resources.create') }}" class="form-control-sm input-group-text px-2 fine-btn animate-page">
                                        {{ __('Change') }}
                                    </a>
                                </div>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="option"> {{ __("How do want $type saved?") }}</label>
                            <div id="option" class="py-2 px-3 mb-2">
                                <div class="form-check">
                                    <input id="save-new" class="form-check-input" onclick="chooseOption(event)" type="radio" name="option"value="1" {{ old('option') === '1' ||  is_null(old('option')) ? 'checked' : ''}}>
                                    <label class="form-check-label normal" for="save-new">
                                        {{ __('Save as new resource') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="add-content" class="form-check-input" onclick="chooseOption(event)" type="radio" name="option" value="2" {{ old('option') === '2' ? 'checked' : ''}}>
                                    <label class="form-check-label normal" for="add-content">
                                        {{ __("Find resource with title and add uploaded files") }}
                                    </label>
                                </div>                                   
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="title">{{ __('Title') }} <span class="required">*</span></label><br>
                            <input id="title" type="text" class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Title" autocomplete="off" autofocus>
                
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="m-0 p-0" for="note"> {{ __('Introduction') }} <span class="required">*</span></label>
                            <div id="note" class="form-control editable-div {{ $errors->has('note') ? ' is-invalid' : '' }}" contentEditable="true" placeholder="Enter any optional note here">
                                {{ old('note') }}
                            </div>
                        
                            @if ($errors->has('note'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('note') }}
                                </span>
                            @endif
                            <input type="hidden" name="note" value=""> 
                        </div>

                        <label for="files-div">{{ __("Upload $type") }} <span class="required">*</span> <span class="normal size-11 hide">{{__("(Valid $type format: jpg, jpeg, png)")}}</span></label>
                        <div class="section bg-light alert">
                            <div class="form-group mb-0">
                                <div id="files-wrap" class="files-wrap p-1">
                                    <div class="file-div d-flex justify-content-between">
                                        <input type="file" class="m-0 p-0" onchange="chooseDisplay(event)" name="file">
                                    </div>
                                </div>
                                
                                @if ($errors->has('file'))
                                    <div class="alert alert-danger size-12 mt-1 mb-0 py-2 message">
                                        {{ $errors->first('file') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group border choose-display alert alert-light mb-0 mt-1">
                                <label for="display">{{ __('How do you want file displayed?') }}</label:for>
                                <div id="display" class="mt-2">
                                    <div class="form-check-inline">
                                        <input id="append" class="form-check-input" type="radio" name="display"value="append" {{ old('display') === 'append' ? 'checked' : ''}}>
                                        <label class="form-check-label normal" for="append">
                                            {{ __('Before title') }}
                                        </label>
                                    </div>                                            
                                    <div class="form-check-inline between-div">
                                        <input id="between" class="form-check-input" type="radio" name="display" value="between" {{ old('display') === 'between' ? 'checked' : ''}}>
                                        <label class="form-check-label normal" for="between">
                                            {{ __('After title') }}
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <input id="prepend" class="form-check-input" type="radio" name="display" value="prepend" {{ old('display') === 'prepend' ? 'checked' : ''}}>
                                        <label class="form-check-label normal" for="prepend">
                                            {{ __('After text') }}
                                        </label>
                                    </div>                                
                                </div>
                            </div>
                        </div>                                                   
                    
                        <hr class="my-2">
                        <div class="validation-error"></div>
                        <div class="form-group pt-1">
                            <button class="btn btn-primary size-12 mx-1" onclick="submitForm(event, 'content');">
                                    {{ __('Submit') }}
                            </button>
                            <button class="btn btn-light primary-color size-12 mx-1" onclick="preview(event)">
                                {{ __('Preview') }}
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection