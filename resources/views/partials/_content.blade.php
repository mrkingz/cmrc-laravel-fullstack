<div class="container">
    <div class="row justify-content-center">
        <div class="{{ __($classes . ' pt-4') }}"> 
            @include('partials._page-header', ['page_header' => $header])
            {{ $pagecontent }}
        </div>
    </div>
</div>