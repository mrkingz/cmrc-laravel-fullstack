<div class="row justify-content-center">
    <div class="{{ isset($width) ? $width : 'col-lg-6' }}">
        <div class="text-center p-4">
            <div class="success">
                <img class="logo bounce animated" src="{{ asset('storage/success.png') }}" alt="..." /><br>
                {{ __($response) }}
            </div>
            <div class="my-1">
                {{ $extra }}
            </div>
        </div> 
    </div>
</div>