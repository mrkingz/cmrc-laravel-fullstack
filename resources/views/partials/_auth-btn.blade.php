@php
    if($view_type == 'register') {
        $text = "Already";
        $btn = "Log in";
        $route_name = "login";
    } else  {
        $btn = "Register";
        $text = "Don't";
        $route_name = "register";
    }    
@endphp
<div class="d-flex justify-content-end mt-2">
    <span class="pt-2 size-13"> {{ __("$text have account?") }}</span>
    <a href="{{ route($route_name) }}" class="btn-link bold primary-color size-13 p-2">
        {{ __($btn)}}
    </a>
</div>