@extends('pages.home')

@section('content')
    @content(['header' => 'Testimonials', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12 pt-3">
                    @auth()
                        <div class="text-right">
                            <a href="{{ route('testimony.new') }}" class="btn btn-primary btn-sm">{{ __('New Testimony') }}</a>
                            <hr class="my-2">
                        </div>
                    @endauth
                    <div class="section alert alert-light">
                        @foreach($testimonies as $testimony)
                            <div class="px-4 my-3">
                                <div class="size-13 details">
                                    <blockquote class="italic mb-1"> {{ __('"' . $testimony->testimony . '"') }}</blockquote>
                                    &mdash; <span class="bold primary-color">{{ __($testimony->name) }}</span>
                                </div>
                                <div class="size-14 bold size-12 text-right primary-color"> {{ $testimony->getFormatedDate() }}</div>
                                @if (! $loop->last)
                                    <hr class="my-2 dotted-border"> 
                                @endif  
                            </div>
                        @endforeach
                    </div>
                    <div class="my-1">
                        {{ $testimonies->links() }}
                    </div>
                </div>
            </div>
        @endslot
    @endcontent
@endsection