@extends('pages.home')

@section('page-content')
    @section('content')
        @content(['header' => 'New resource', 'classes' => 'col-lg-7'])
            @slot('pagecontent') 

                @yield('resource-content')

            @endslot
        @endcontent
    @endsection
@endsection