<script type="text/template" id="upload-template">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="{{ __('Or drag \'n\' drop file here') }}">
        
        
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
