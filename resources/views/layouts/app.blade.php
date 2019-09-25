<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon.ico') }}">
        <meta name="theme-color" content="#ffffff">   

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/helpers.js') }}"></script>

        <script src="{{ asset('js/vendor/typeahead.bundle.js') }}"></script>
        <script src="{{ asset('js/vendor/fine-uploader/fine-uploader.js') }}"></script>
        <script src="{{ asset('js/vendor/tinymce/tinymce.min.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fine-uploader/fine-uploader-new.css') }}" rel="stylesheet">
    </head>
    <body>
        @yield('navbar')
        <div id="app" class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onscroll = () => { 
                if(document.documentElement.scrollTop > document.getElementById('brand-div').clientHeight - 10) {
                    document.querySelector('nav').classList.add("fixed-top")
                } else {
                    document.querySelector('nav').classList.remove("fixed-top");
                }
            }
        </script>

        @include('partials._footer')
    </body>
</html>
