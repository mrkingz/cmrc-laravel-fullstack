@extends('pages.home')

@section('page-content')
    @section('content')
        @content(['header' => 'New resource', 'classes' => 'col-lg-7'])
            @slot('pagecontent') 
                <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                    <div class="col-lg-11 col-md-11 col-sm-12 details">
                        <form id="publication-form" class="pb-4 pt-2 size-14" action="{{ route('resource.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="publication-wrapper">
                                @if (session('success'))
                                    @response(['response' => session('success'), 'width' => 'col-lg-10'])
                                        @slot('extra')
                                            <div class="alert alert-info m-0 size-12 py-4">
                                                 {!! __('New resource has been saved successfully!<br> To publish, click publication settings') !!}
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
                                                <div>{{ __('Resource not saved, please try again.') }}</div>
                                            @endslot
                                        @endalert
                                    @endif

                                    <div class="form-group">
                                        <label for="type">{{ __('Resource type') }}</label>
                                        <div class="input-group">
                                            <input id="type" type="text" class="form-control form-control-sm bg-white col-lg-4 col-md-4 col-sm-12" readonly aria-label="Recipient's username" name="type" value="{{ __(ucFirst($type)) }}" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <a href="{{ route('resources.create') }}" class="form-control-sm input-group-text px-2 fine-btn animate-page">
                                                    {{ __('Change') }}
                                                </a>
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
                                        <label class="m-0 p-0" for="publication"> {{ __('Publication') }} <span class="required">*</span></label>
                                        <textarea id="editor" class="form-control {{ $errors->has('publication') ? ' is-invalid' : '' }}" name="publication" rows="0"></textarea>
                                        @if ($errors->has('publication'))
                                            <div class="alert alert-danger py-2 mt-2" role="alert">
                                                {{ $errors->first('publication') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group primary-color section">
                                    <label class="bold mb-0 size-13">{{ __('Select resource access option') }}</label>
                                    <div id="paid-option" class=" alert bg-white border dotted-border pt-2 pb-1 px-3 mb-0">        
                                       <div class="form-check form-check-inline">
                                            <input id="free" class="form-check-input" type="radio" name="paid" value="Free" {{ (is_null(old('paid')) || old('paid') === 'Free') ? 'checked' : ''}}>
                                            <label class="form-check-label size-12" for="free">{{ __('Free resource') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="paid" class="form-check-input " type="radio" name="paid" value="Paid" {{ old('paid') === 'Paid' ? 'checked' : ''}}>
                                            <label class="form-check-label size-12" for="paid">{{ __('Paid resource') }}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr class="my-2">
                                <div class="validation-error"></div>
                                <div class="form-group pt-1">
                                    <button class="btn btn-primary size-12 mx-1">
                                            {{ __('Save resource') }}
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                @include('partials._upload-template')

                @include('partials._processing')

                <script>
                    let isSuccess = true;
                    tinymce.init({
                        selector: 'textarea',
                        height: 300,
                        elementpath: false,
                        branding: false,
                        style_formats_merge: true,
                        paste_data_images: true,
                        automatic_uploads: false,
                        images_reuse_filename: true,
                        images_upload_url: "{{ route('upload') }}",

                        menu: {
                            file: {title: 'File', items: 'newdocument | print'},
                            edit: {title: 'Edit', items: 'undo redo | cut copy paste | highlight pastetext searchreplace selectall'},
                            insert: {title: 'Insert', items: 'link image media | nonbreaking pagebreak anchor | charmap hr | template insertdatetime'},
                            view: {title: 'View', items: 'visualaid visualblocks visualchars  preview fullscreen'},
                            format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
                            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
                            tools: {title: 'Tools', items: 'code'}
                        },
                        
                        plugins: [
                            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                            'searchreplace wordcount visualblocks visualchars code fullscreen',
                            'insertdatetime media nonbreaking save table contextmenu',
                            'template paste textcolor colorpicker textpattern imagetools help lineheight'
                        ],
                        toolbar: 'fontselect | fontsizeselect | lineheightselect | forecolor backcolor | bullist numlist outdent indent | help',
                        lineheight_formats: "8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt",
                        
                        // Here's our custom file picker
                        file_picker_callback: function(callback, value, meta) {
                            let input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            //input.setAttribute('accept', 'image/*');
                            
                            // Note: In modern browsers input[type="file"] is functional without 
                            // even adding it to the DOM, but that might not be the case in some older
                            // or quirky browsers like IE, so you might want to add it to the DOM
                            // just in case, and visually hide it. And do not forget do remove it
                            // once you do not need it anymore.

                            input.onchange = function() {
                                let file = this.files[0];
                                
                                let reader = new FileReader();
                                reader.onload = function () {
                                    // Note: Now we need to register the blob in TinyMCEs image blob registry.                   
                                    let blobid =  file.name.replace(/\.[^/.]+$/, '') + '.' + (new Date()).getTime(),
                                        blobCache =  tinymce.activeEditor.editorUpload.blobCache,
                                        base64 = reader.result.split(',')[1],
                                        blobInfo = blobCache.create(blobid, file, base64);
                                        
                                    blobCache.add(blobInfo);

                                    // call the callback and populate the Title field with the file name
                                    callback(blobInfo.blobUri(), { title: file.name });
                                };

                                reader.readAsDataURL(file);
                            };
                            
                            input.click()  
                        },
                        
                        images_upload_handler : function(blobInfo, success, failure) {
                            var xhr, formData;

                            formData = new FormData();
                            formData.append('file', blobInfo.blob(), blobInfo.filename());
                            formData.append('_token', "{{ Session::token() }}")

                            $.ajax({
                                url: "{{ route('upload') }}",
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: 'POST',
                                success: function (data) {
                                    success(data.location);
                                },

                                error: function(error) {
                                    // alert(JSON.stringify(error));
                                    isSuccess = false;
                                    failure(error);
                                }
                            });
                        },
                    });

                    document.getElementById('publication-form').onsubmit = function(e) {
                        e.preventDefault();

                        let formData = {
                            _token: "{{ Session::token() }}",
                            paid: document.querySelector('input[name="paid"]:checked').value,
                            title: document.getElementById('title').value.trim(),
                        }

                        if (isEmpty(formData.title) || isEmpty(tinymce.get('editor').getContent().trim())) {
                            errorMessage('Please fill out all rquired fields!'); 
                        } else {

                            showProcessing();

                            tinymce.activeEditor.uploadImages(function(success) {
                                formData.publication = tinymce.get('editor').getContent();
                                alert(JSON.stringify(formData));return
                                if (isSuccess) {
                                    ajaxSubmit({
                                        url: "{{ route('resource.store') }}",
                                        data: formData,
                                    });

                                    location.reload();
                                }
                            });
                        }
                    }
                </script>
               
            @endslot
        @endcontent
    @endsection
@endsection