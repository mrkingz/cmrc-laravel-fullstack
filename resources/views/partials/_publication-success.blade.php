@if (session('publication'))
    @response(['response' => session('publication.success'), 'width' => 'col-lg-6'])
        @slot('extra')
            <div class="alert alert-info m-0 size-12 py-4">
                Your order has been saved for a review. <br>
                You will be notified once it has been approved.
                <div class="size-14 bold pt-2">Thank you!</div>
            </div>
        @endslot
    @endresponse
@endif