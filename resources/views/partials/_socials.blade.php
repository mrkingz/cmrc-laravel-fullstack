@php
    $text = $view_type == 'register' ? 'register' : 'log in';
@endphp

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="bg-light pt-4">
            <div class="text-center primary-color">
                {{ __("Or $text with your social accounts") }}
            </div>
            <div class="d-flex justify-content-center pt-3 pb-4 socials shake animated" style="align-items: center">
                <a class="btn" href=""><i class="fa fa-facebook"></i></a>
                {{--  <a class="btn" href=""><i class="fa fa-instagram"></i></a>  --}}
                <a class="btn" href=""><i class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div>