@extends('pages.home')

@section('page-content')
    @section('content')
        @if (session('success'))
            @response(['response' => session('success')])
                @slot('extra')
                    <div class="alert alert-info m-0 size-12 py-4">
                        Your order has been saved for a review. <br>
                        You will be notified once it has been approved.
                        <div class="size-14 bold pt-2">Thank you!</div>
                    </div>
                    <hr class="my-1">
                    <a href="" class="btn btn-primary w-100">{{ __('Ok') }}</a>
                @endslot
            @endresponse
        @else
            @content(['header' => 'Order Category', 'classes' => 'col-lg-7'])
                @slot('pagecontent') 
                    <div class="bg-lighter primary-color px-4 py-3 size-13">
                        <strong style="font-size: 18px">Attention <i class="fa fa-exclamation"></i></strong> <br>   
                        To ease our order placing process, we have categorized orders into three.<br>        
                        We recommend you read through the list of our services carefully
                        and select your order type accordingly. <a  href="{{ route('services') }}" class="btn-link bold">{{ __('See our sevices') }}</a>
                    </div>
                    <div class="row no-gutters mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="order-btn-wrap">
                                <a href="{{ route('new', ['type' => 'practical'])  }}" class="btn btn-outline-primary animate-page" role="button">{{ __('Practical') }} <br> {{ __('Research') }}</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="order-btn-wrap">
                                <a href="{{ route('new', ['type' => 'educational']) }}" class="btn btn-outline-primary animate-page" role="button">{{ __('Educational') }} <br> {{ __('Services') }}</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="order-btn-wrap">
                                <a href="{{ route('new', ['type' => 'empirical']) }}" class="btn btn-outline-primary animate-page" role="button">{{ __('Empirical') }} <br> {{ __('Data/Information') }}</a>
                            </div>
                        </div>
                    </div>          
                @endslot
            @endcontent
        @endif
    @endsection
@endsection