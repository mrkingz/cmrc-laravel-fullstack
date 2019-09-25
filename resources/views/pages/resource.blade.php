@extends('pages.home')

@section('content')
    @content(['header' => 'Resource', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            <div class="bg-lighter d-flex justify-content-center mt-1 py-3">
                <div class="col-lg-11 col-md-11 col-sm-12">
                    <div class="my-2 text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-link btn-sm">{{ __('Back') }}</a>
                    </div>   
                    <div class="text-center resource py-4 px-3">
                        <h5 class="primary-color mt-3">{{ __($resource->title) }}</h4>
                        <hr class="my-1">
                        <blockquote class="details mt-3">{!! __($resource->publication) !!}</blockquote>
                    </div> 
                    <hr class="mt-3 hide">
                    <div class="d-flex justify-content-between border-top mt-3">
                        <ul class="list-unstyled">
                            <li class="list-inline-item"></li>
                        </ul>
                    </div>             
                </div>
            </div>
        @endslot
    @endcontent
@endsection