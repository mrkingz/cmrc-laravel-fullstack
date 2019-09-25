@extends('pages.home')

@section('content')
    @content(['header' => 'Resources', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12">
                    <div class="row">
                        <div class="col-12 pt-3">
                            <form action="">
                                    <div class="form-group mb-0 d-flex">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <select class="form-control form-control-sm size-11 px-1" name="sort">
                                                    <option value="ascending" {{ (old('sort') == 'Both' ? 'selected' : '') }}>Both</option>
                                                    <option value="ascending" {{ (old('sort') == 'Free' ? 'selected' : '') }}>Free</option>
                                                    <option value="descending" {{ ( old('sort') == 'Paid' ? 'selected' : '') }}>Paid</option>
                                                </select>
                                            </div>                    
                                            <input type="search" class="form-control form-control-sm" name="search" placeholder="Search resources"/>
                                            <div class="input-group-append">                                
                                                <button class="btn btn-outline-link btn-sm input-group-text primary-color">
                                                <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-12">
                            @if($resources->total() > 0)
                            <div class="resource mb-3 p-2">
                                @foreach($resources as $resource)
                                    <div class="px-2 d-flex justify-content-between">
                                        <a href="{{ route('resource', ['id' => $resource->id]) }}" id="{{ $resource->id }}" class="primary-color size-12 bold"> 
                                            {!! $resource->title !!}
                                        </a>
                                        
                                        @if(Auth::check() && Auth::user()->isAdmin)
                                            <div class="m-0">
                                                <button class="btn btn-link fine-btn btn-sm resource-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    <i class="fa fa-chevron-down size-11"></i>
                                                </button>
                                                <div style="min-width: 5rem;" class="dropdown-menu dropdown-menu-right size-11 p-0" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item px-3" href="">
                                                        <i class="fa fa-edit"></i> {{ __('Edit') }}
                                                    </a>
                                                    <div class="dropdown-divider my-0"></div>
                                                    <a class="dropdown-item px-3" href="">
                                                        <i class="fa fa-shield"></i> {{ __('Unpublish') }}
                                                    </a>
                                                    <div class="dropdown-divider my-0"></div>
                                                    <button class="dropdown-item px-3 delete-resource" value="{{$resource->id }}" onclick="deleteResource(event)">
                                                        <i class="fa fa-trash"></i> {{ __('Delete') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between size-11 mt-1 px-2">
                                        <ul class="list-unstyled mb-0">
                                            <li class="list-inline-item"><span>Access: </span>{{ $resource->paid }}</li>
                                            <li class="list-inline-item"><div class="bar"></div></li>
                                            <li class="list-inline-item"><span>Published date: </span> {{ __($resource->getPublishedDate()) }}</li>
                                        </ul>
                                    </div>
                                    @if (! $loop->last)
                                        <hr class="my-1 dotted-border"> 
                                    @endif  
                                @endforeach
                            </div>  
                            @else
                            <div class="alert alert-danger m-0 py-2 italic size-13">
                                {{ __('Sorry, resource not available...') }}
                            </div>
                            @endif 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $resources->links() }}
                        </div>
                    </div>
                </div>
            </div> 
            
            @modal(['id' => 'confirm', 'size' => 'modal-sm'])
                @slot('modal')
                    <div class="my-0">
                        <div id="title" class="modal-header my-0 px-2 pt-2 pb-1 bold"></div>
                        <div id="message" class="alert alert-warning text-center m-1 py-1 size-12"></div>
                        <div class="text-center py-0 my-2">
                            <button id="cancel" class="btn btn-primary btn-sm size-10" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button class="btn btn-danger btn-sm size-10" id="delete-btn">{{ __('Delete') }}</button>
                        </div>
                    </div>                   
                @endslot
            @endmodal
            
            <script>
                let resourceId;
                const deleteResource = (e) => {
                    resourceId = e.target.value;
                    title = document.getElementById(e.target.value).innerHTML;
                    showConfirm({
                        title: 'Confirm',
                        message: `Are you sure yo want to delete resource <br /> <b> ${title}?</b>`
                    });

                    
                }

                document.getElementById('delete-btn')
                .addEventListener('click', function(e) {
                    
                })
            </script>         
        @endslot
    @endcontent
@endsection