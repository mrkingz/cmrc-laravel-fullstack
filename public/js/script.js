
/***********************************************
 * Global variables
 ***********************************************/
    /**
     * Determine the current state of a file input
     */
    let hasFile = false, orderUploader, verURL;

$(document).ready(function() {

    if (document.getElementById('order-fine-uploader') !== null) {
        orderUploader = new qq.FineUploader({
            element: document.getElementById('order-fine-uploader'),
            template: 'upload-template',
            button: document.getElementById('browse-file'),
            listElement: document.getElementById('list-element'),
            autoUpload: false,
            debug: true,

            // request: {
            //     //endpoint: '/order/verification'
            //     params: {
            //         uploadId: Date.now()
            //     }
            // },
            
            form: {
                interceptSubmit: false
            },

            messages: {
                typeError: 'Invalid extension detected in file, {file}.',
            },

            validation: {
                allowedExtensions: ['doc', 'docx', 'pdf', 'odt'],
            },

            callbacks: {
                onError: function(id, name, errorReason, xhr) {
                    $('.validation-error').html(
                        `<div class="alert alert-danger py-2 size-12 text-center shake animated message">${errorReason}</div>`
                    );
                },

                onCancel: function(id, name) {               
                    $('div.qq-uploader').attr({'qq-drop-area-text': 'Or drag \'n\' drop files here'})
                    $('.message').addClass('zoomOut animated faster').fadeOut(500);
                },

                onComplete: function(id, name, responseJSON, xhr) {
                    if ((id + 1) === this.getUploads().length) {
                        verURL = responseJSON.url;
                    }
                },

                onAllComplete: function(uploadedFiles, failedFiles) {

                    if(uploadedFiles.length === this.getUploads().length) {
                        window.location.href = verURL;
                    }
                },

                onSubmitted: function(id, name) {
                    $('div.qq-uploader').attr({'qq-drop-area-text': 'Or drag \'n\' drop files here'})
                    $('.message').addClass('zoomOut animated faster').fadeOut(500);
                },

                onUpload: function(id, name) {
                    this.setParams({
                        currentItem: id + 1,
                        uploadCount: this.getUploads().length
                    });
                    $(`input[name="note"]`).val($(`#note`).html())
                },
            }
        });
    } else { 
        new qq.FineUploader({
            element: document.getElementById('fine-uploader-manual-trigger'),
            template: 'upload-template',
            button: document.getElementById('browse-file'),
            listElement: document.getElementById('list-element'),
            autoUpload: false,
            debug: true,
            multiple: false,

            messages: {
                typeError: 'Invalid extension detected in file, {file}.',
            },

            validation: {
                allowedExtensions: ['doc', 'docx', 'pdf', 'odt'],
                itemLimit: 1
            },

            callbacks: {
                onError: function(id, name, errorReason, xhr) {
                    $('.validation-error').html(
                        `<div class="alert alert-danger py-2 size-12 text-center shake animated message">${errorReason}</div>`
                    );

                    this.setItemLimit(this.getUploads().length - 1);
                },

                onCancel: function(id, name) {               
                    $('div.qq-uploader').attr({'qq-drop-area-text': 'Or drag \'n\' drop file here'})
                    $('.message').addClass('zoomOut animated faster').fadeOut(500);
                    this.setItemLimit(0);
                },

                onComplete: function(id, name, responseJSON, xhr) {
                    location.reload();
                },

                onSubmitted: function(id, name) {
                    $('div.qq-uploader').attr({'qq-drop-area-text': 'Or drag \'n\' drop file here'})
                    $('.message').addClass('zoomOut animated faster').fadeOut(500);
                },

                onUpload: function(id, name) {
                    $(`input[name="intro"]`).val($(`#intro`).html())
                },
            }
        });
    }

    $('input').prop({'autocomplete': 'off'});
    $('div[placeholder]').html('')
    $('div.qq-uploader').css({
        'min-height': '100px',
        'padding': '0',
        'line-height': '0.25',
        'overflow': 'hidden'
    })

    $('input, .form-control, .btn, select, .editable-div').not('.resend, #browse-file, #submit').on('click keypress change', function(e) {
        $('.message').addClass('zoomOut animated faster').fadeOut(500);
        $(e.target).removeClass('is-invalid');
    })

    $('input[type="file"]').on('change', function(e) {
        if ($(e.target).val())
            $(e.target).css({'color': 'rgba(0, 0, 0, 0.8)'});
    })

    // $('a.animate-page').on('click', function(e) {
    //     redirect = $(this).prop('href');

    //     if ( typeof redirect !== '' ) {
    //         e.preventDefault();
    //         $.when($('div.zoomIn').addClass('zoomOut animate')).done(function() {
    //             window.location.href = redirect;
    //         });
    //     }
    // })

    submitForm = function(e, field) {
        $(`input[name="${field}"]`).val($(`#${field}`).html());
        $('form').submit();
    }


    /**
     * Determine if the current selected file input is empty
     */
    checkFile = function(e) {
        hasFile = e.target.files.length > 0;
    }

    /**
     * Append a new file input
     */
    addFile = function(e) {
        const elem = $(e.target);

        if (! hasFile ) {
            elem.parents('.file-div:last').after(function() { 
                return `<div class="file-div d-flex justify-content-between">
                            <input type="file" class="m-0 p-0" onclick="checkFile(event)" onchange="addFile(event)" name="files[]">
                            <button class="clear-file btn-sm" onclick="clearFile(event)" title="Remove file">&times;</button>
                        </div>`; 
            });

            // Chenge the color of the file input and display the remove button
            // is associated with the file input
            elem.css({'color': 'rgba(0, 0, 0, 0.8)'})
            .siblings('button').show();

        } 
        // If this file input is not empty and cancel is selected, then remove it
        else if ( hasFile && e.target.files.length === 0) {
            elem.siblings('button').trigger('click');
        }

        hasFile = false;
    }

    /**
     * Toggle the display publication photo attachement option
     */
    chooseDisplay = function(e) {
        if ($(e.target).val().trim() !== '') {
            $('.choose-display').removeClass('hide zoomOut animated').fadeIn()
        } else {
            $.when($('.choose-display').addClass('zoomOut animated')).done(function() {
                $('.choose-display').fadeOut(500);   
            });
        }
    }

    chooseOption = function(e) {
        element = $('.title');
        if (Number($(e.target).val()) === 1) {
            $('label#title, #display div:eq(0)').removeClass('hide');
        } else {
            $('label#title, #display div:eq(0)').addClass('hide')
        }

        $('input[name="display"]').prop({'checked':false});
    }

    /**
     * Remove a file input
     */
    clearFile = function(e) {
        e.preventDefault();
        $(e.target).parents('.file-div').remove();
    }

    toggleUploader = function() {
        isChecked = $('#control-checkbox').is(':checked');
        if (! isChecked) {
            $('button.submit').replaceWith(`<button id="submit" class="btn btn-primary submit">Submit</button>`);
            qq(document.getElementById('submit')).attach('click', function(e) {
                e.preventDefault()
                orderUploader.uploadStoredFiles();
            })
        } else {
            $('button.submit').replaceWith(`<button class="btn btn-primary submit" onclick="submitForm(event, 'note')">Submit</button>`);
        }

        $('#control-checkbox').prop({'checked': ! isChecked})
    }

    /**
     * Remove a publication section
     */
    preview = function(e) {
        e.preventDefault();

        let classes = 'show zoomIn animated',
            publication = $('.publication-wrapper'),
            review = $('.preview'),
            display = $('input[name="display"]:checked').val();

        if ($(e.target).html().trim() === 'Preview') {

            if (isEmpty($('div.editable-div').text()) || isEmpty($('input#title').val())) {

                errorMessage('Please fill out all required fields!');
            } else {
                if (uploadedFile(display)) {
                    if (! $('input[name="display"]').is(':checked')) {
                        errorMessage('Choose how you want file displayed');

                        return;
                    }
                }

                $('blockquote.content').html($('div.editable-div').html().trim());

                if ($('input[name="option"]:checked').val() == '1')
                    $('label#title').html($('input#title').val().trim());

                $.when(publication.removeClass(classes).addClass('hide')).done(function() {
                    $(e.target).html('Edit');
                    review.addClass(classes)
                });
            }
        } else {
            $.when(review.removeClass(classes).addClass('hide')).done(function() {
                $(e.target).html('Preview');
                publication.addClass(classes);
                $('div.editable-div').focus();
                $('div.display-file').empty();
            })
        }
    }


    // Set the Options for "Bloodhound" suggestion engine
    // var engine = new Bloodhound({
    //     remote: {
    //         url: '/find?q=%QUERY%',
    //         wildcard: '%QUERY%'
    //     },
    //     datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
    //     queryTokenizer: Bloodhound.tokenizers.whitespace
    // });

    // let result = new Bloodhound({
    //     remote: {
    //         url: '/publication/find/%QUERY%',
    //         wildcard: '%QUERY%'
    //     },
    //     datumTokenizer: Bloodhound.tokenizers.whitespace('query'),
    //     queryTokenizer: Bloodhound.tokenizers.whitespace
    // })

    // uploadedFile = function(display) {
    //     let file = $('input[type="file"]').prop('files')[0];
    //     let reader = new FileReader();

    //     if (typeof file == 'object') {
    //         reader.onloadend = function() {
    //             $('div.' +display).append(function() {
    //                 return `<img class="img-thumbnail image" src="${reader.result}" alt="append">`;
    //             })
    //         }

    //         reader.readAsDataURL(file)

    //         return true;
    //     }

    //     return false;
    // }

    // $(".typeahead").typeahead({
    //     hint: true,
    //     highlight: true,
    //     minLength: 1
    // }, {
    //     source: result.ttAdapter(),

    //     // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
    //     name: 'usersList',

    //     // the key from the array we want to display (name,id,email,etc...)
    //     templates: {
    //         empty: [
    //             '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
    //         ],
    //         header: [
    //             '<ul class="list-group search-results-dropdown"></ul>'
    //         ],
    //         suggestion: function (data) {
    //             return `<li class="list-group-item"> ${data['title']} </li>`;
    //             //'<a href="' + data.id + '" class="list-group-item">' + data.title + '</a>'
    //         }
    //     }
    // });

    // $("input#title").typeahead({
    //     source: function(query, process) {
    //          $.ajax({
    //             url: `/publication/find/${query}`,
    //             method: 'GET',
    //             data: {query: query},
    //             dataType: 'JSON',
    //             success: function(data) {
    //                 process($.map(data, function(item) {
    //                     return item;
    //                 }));
    //             }
    //         })
    //     }
    // });

    // $('.typeahead.input-sm').siblings('input.tt-hint').addClass('hint-small');
    // $('.typeahead.input-lg').siblings('input.tt-hint').addClass('hint-large');
})