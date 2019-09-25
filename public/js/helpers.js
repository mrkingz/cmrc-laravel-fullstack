
/***********************************************
 * Global functions
 ***********************************************/
let errorMessage = message => {
    $('.validation-error').html(
        `<div class="alert alert-danger py-2 size-12 text-center shake animated message">${message}</div>`
    );
}

let isEmpty = string => {
    return string.trim() === '';
}

let showProcessing = backdrop => {
    $('#processing').modal({ backdrop: backdrop || 'static'});
}

let hideProcessing = () => {
    $('#processing').modal('hide');
}

let showConfirm = (object) => {
    document.getElementById('title').innerHTML = object.title;
    document.getElementById('message').innerHTML = object.message;
    $('#confirm').modal('show');
}

let ajaxSubmit = param => {
    let response = false;

    $.ajax({
        url: param.url,
        data: param.data,
        type: param.method || 'POST',
        dataType: param.dataType || 'JSON',
        
        success: data => {
            if (typeof param.callback === 'function') {
                param.successCallback(data)
            }
            hideProcessing();
            response = true;
        },

        error: error => {
            if (typeof param.errorCallback === 'function') {
                param.errorCallback(error)
            }
            hideProcessing();
        }
    })

    return response;
}