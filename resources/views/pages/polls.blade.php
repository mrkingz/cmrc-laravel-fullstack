@extends('pages.home')

@section('content')
    @content(['header' => 'Polls', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 

        @endslot
    @endcontent
@endsection