@modal(['id' => 'processing', 'size' => 'modal-sm'])
    @slot('modal')
        <div class="d-flex justify-content-center mt-2">
            <img class="processing" src="{{ asset('/storage/loading.gif') }}" alt="Loading..."/>
        </div>
        <div class="text-center primary-color size-14 mb-2">Please wait...</div>
    @endslot
@endmodal