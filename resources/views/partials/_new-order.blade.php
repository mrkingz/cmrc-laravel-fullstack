@php
    $formats = [
        'APA', 'Chicago/Turabian', 'MLA', 'Others'
    ];

    $zip_codes = ['+234', '+223'];
@endphp

@section('content')
    @content(['header' => 'Order details', 'classes' => 'col-lg-7'])
        @slot('pagecontent')        
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12">
                    @if(session('error'))
                        @alert(['type' => 'danger', 'classes' => 'text-center size-12 mb-1 my-2 message'])
                            @slot('content')
                                {{ __(session('error')) }}
                                <div>Order not submitted, please try again.</div>
                            @endslot
                        @endalert
                    @endif
                    <form id="qq-form" class="py-3 size-14 order-form" action="{{ route('order.verify') }}" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        @include('partials._required')

                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>
                            <div id="category" class="input-group">
                                <input type="text" class="form-control form-control-sm bg-white col-lg-5 col-md-5 col-sm-12" readonly aria-label="Recipient's username" name="category" value="{{ __(ucFirst($type)) }}" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <a href="{{ route('new') }}" class="form-control-sm input-group-text px-2 fine-btn animate-page">
                                        {{ __('Change') }}
                                    </a>
                                </div>
                            </div> 
                        </div>

                        {{ $extrafields }}

                        <div class="form-group">
                            <label for="title">{{ __('Title') }} <span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Title">
                           
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div> 

                        <div class="form-group">
                            <label for="format">{{ __('Format')}} <span class="required">*</span></label>
                            <select id="format" class="form-control form-control-sm col-lg-4 col-md-4 col-sm-12 {{ $errors->has('format') ? ' is-invalid' : '' }}" name="format" value="{{ old('format') }}">
                                <option value="">{{ __('Select format') }}</option>
                                @for($i = 0; $i < count($formats); $i++) 
                                    <option value="{{ $formats[$i] }}" {{ (! is_null(old('format')) && old('format') == $formats[$i] ? 'selected' : '') }}>{{ $formats[$i] }}</option>   
                                @endfor
                            </select>

                            @if ($errors->has('format'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('format') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title">{{ __('If you select other format above, please specify') }}</label>
                            <input type="text" class="form-control form-control-sm col-lg-8, col-md-8 col-sm-12{{ $errors->has('other_format') ? ' is-invalid' : '' }}" name="other_format" value="{{ old('other_format') }}" placeholder="Specify format here">
                           
                            @if ($errors->has('other_format'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('other_format') }}
                                </span>
                            @endif
                        </div> 

                        <div class="form-group">
                            <label for="pages">{{ __('Minimum number of pages') }} <span class="required">*</span></label>
                            <input type="number" id="pages" class="form-control form-control-sm col-lg-3 col-md-3 col-sm-12 {{ $errors->has('pages') ? ' is-invalid' : '' }}" name="pages" value="{{ old('pages') }}" placeholder="Min pages">
                            
                            @if ($errors->has('pages'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('pages') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">{{ __('Phone number') }} <span class="required">*</span></label>
                            <div id="category" class="input-group">
                                <div class="input-group-prepend">
                                    <select name="zip_code" class="form-control form-control-sm">
                                        @for($i = 0; $i < count($zip_codes); $i++) 
                                            <option value="{{ $zip_codes[$i] }}" {{ (! is_null(old('zip_code')) && old('zip_code') == $zip_codes[$i] ? 'selected' : '') }}>{{ $zip_codes[$i] }}</option>   
                                        @endfor
                                    </select>
                                </div>
                                <input type="text" id="phone" class="form-control form-control-sm col-lg-5 col-md-5 col-sm-12{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('phone') }}
                                    </span>
                                @endif
                            </div>                             
                        </div>
                        
                        <div class="form-group">
                            <label class="m-0" for="note"> {{ __('Any note?') }}</label>
                            <div class="form-control editable-div col-lg-12" id="note" contentEditable="true" placeholder="May include paper structure and/or outline, types and number of references to be used, grading scale or any other requirement."></div>
                            <input type="hidden" name="note" value=""> 
                        </div>
                        <div class="form-group text-righ mt-3 mb-1">
                            <div class="form-check form-check-inline">
                                <input id="upload_option" class="form-check-input" type="checkbox" onclick="toggleUploader()" name="upload_option" {{ old('upload_option') ? 'checked' : '' }}>
                                <label class="form-check-label size-12 normal" for="upload_option">{{ __('Select to uploaad optional file(s)') }}</label>
                            </div>
                        </div>
                        <div>
                            <input id="control-checkbox" type="checkbox" class="hide">
                            <div class="upload-container">
                                <div class="section bg-light alert alert-light">
                                    <div class="form-group mb-0">
                                        <div class="mb-1 d-flex justify-content-start">
                                            <div id="browse-file" class="btn btn-light primary-color btn-sm border" >
                                                {{ __("Browse file") }} 
                                            </div>
                                            <div>
                                                <span class="normal size-11">
                                                    {!! __("<span class='emphasis mx-2'>(Valid format: " . implode(', ', $extentions) . ")</span>") !!}
                                                </span>
                                            </div>
                                        </div>
                                        <div id="files-wrap" class="files-wrap p-1">
                                            <div id="order-fine-uploader"></div>
                                        </div>

                                        <div id="list-element" class="primary-color size-12"></div>
                                        
                                        @if ($errors->has('file'))
                                            <div class="alert alert-danger size-12 mt-1 mb-0 py-2 message">
                                                {{ $errors->first('file') }}
                                            </div>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div>
                        {{--  <div class="section bg-light alert details">
                            <div class="form-group mb-0">
                                <label for="files-div">{{ __('Upload file(s)') }} <span class="normal size-11">(Valid file format: jpg, jpeg, png, docx, pdf, xlsx)</span></label>
                                <div id="files-wrap" class="files-wrap p-1">
                                    <div class="file-div d-flex justify-content-between">
                                        <input type="file" class="m-0 p-0" onclick="checkFile(event)" onchange="addFile(event)" id="customFile" name="files[]">
                                        <button class="clear-file btn-sm" onclick="clearFile(event)" title="Remove file">&times;</button>
                                    </div>
                                </div>
                                
                                @if ($errors->has('files.*'))
                                    <div class="alert alert-danger size-12 mt-1 mb-0 py-2 message">
                                        {{ $errors->first('files.0') }}
                                    </div>
                                @endif
                            </div>
                        </div>  --}}
                    
                        <hr class="mt-1">
                        <div class="validation-error"></div>
                        <div class="form-group">
                            <button class="btn btn-primary submit" onclick="sumbitForm(event, 'note')">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <script type="text/template" id="upload-template">
                <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="{{ __('Or drag \'n\' drop files here') }}">
                    
                    
                    <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                    </div>
                    <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                        <span class="qq-upload-drop-area-text-selector"></span>
                    </div>

                    <span class="qq-drop-processing-selector qq-drop-processing">
                        <span>Processing dropped files...</span>
                        <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                    </span>


                    <div class="qq-upload-list-selector" aria-live="polite" aria-relevant="additions removals">
                        <div class="">
                            <div class="qq-progress-bar-container-selector">
                                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                            </div>

                            <div class="d-flex justify-content-between m-1">
                                <div class="pl-1">
                                    <span class="qq-upload-file-selector"></span>
                                </div>
                                <div>
                                    <span class="qq-upload-size-selector qq-upload-size"></span>
                                    <button type="button" class="qq-upload-cancel-selector clear-file btn-sm py-0 red">
                                        &times;
                                    </button>
                                </div>
                            </div>
                            <span role="status" class="qq-upload-status-text-selector qq-upload-status-text mt-1"></span>
                        </div>
                    </div>
                        <dialog class="qq-alert-dialog-selector">
                        </dialog>

                        <dialog class="qq-confirm-dialog-selector">
                            <div class="qq-dialog-message-selector"></div>
                            <div class="qq-dialog-buttons">
                                <button type="button" class="qq-cancel-button-selector">No</button>
                                <button type="button" class="qq-ok-button-selector">Yes</button>
                            </div>
                        </dialog>

                        <dialog class="qq-prompt-dialog-selector">
                            <div class="qq-dialog-message-selector"></div>
                            <input type="text">
                            <div class="qq-dialog-buttons">
                                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                                <button type="button" class="qq-ok-button-selector">Ok</button>
                            </div>
                        </dialog>
                    </div>
                </script>

        @endslot
    @endcontent
@endsection
