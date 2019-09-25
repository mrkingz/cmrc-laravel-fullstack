@extends('pages.home')

@section('content')
    @content(['header' => 'Blog', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 

        @endslot
    @endcontent
@endsection