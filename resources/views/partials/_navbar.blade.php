
    <nav class="navbar navbar-expand-md navbar-light navbar-style pb-0">
        <div class="container">
            <a id="navbar-brand" class="navbar-brand bold" href="{{ url('/') }}">
               <i class="fa fa-home"></i> {{ config('app.name', '') }}
            </a>
            <button class="navbar-toggler px-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon p-0"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto navbar-left">
                    <li class="nav-item">
                        <a class="nav-link animate-page" href="{{ route('about') }}">{{ __('About us') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-page" href="{{ route('services') }}" >{{ __('Our services') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-page" href="{{ route('testimonials') }}">{{ __('Testimonials') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-page" href="{{route('blog') }}">{{ __('Blog') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate-page" href="{{ route('polls') }}">{{ __('Polls') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        @if(! Auth::check() || ! Auth::user()->isAdmin)
                            <a class="nav-link animate-page" href="{{ route('resources') }}">{{ __('Resources') }}</a>
                        @else
                            <a id="navbarDropdown" class="nav-link" href="" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Resources') }} <i class="fa fa-caret-down ml-1"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right py-0 size-12" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item animate-page" href="{{ route('resources.type') }}">{{ __('Upload') }}</a>
                                <div class="dropdown-divider my-0"></div> 
                                <a class="dropdown-item animate-page" href="{{ route('resources') }}">
                                    {{ __('View') }}
                                </a>
                            </div>                         
                        @endif
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown d-flex justify-content-end">
                            <a id="navbarDropdown" class="nav-link size-11 text-right" href="" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-chevron-down"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right py-0 size-12" style="position: absolute;" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item animate-page" href="{{ route('new') }}">
                                    {{ __('New Order') }}
                                </a>
                                <a class="dropdown-item animate-page" href="{{ route('resources.type') }}">
                                    {{ __('Upload Resource') }}
                                </a>
                                <div class="dropdown-divider my-0"></div> 
                                <a class="dropdown-item animate-page" href="{{ route('password.form') }}">
                                    {{ __('Change password') }}
                                </a>
                                <div class="dropdown-divider my-0"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Log out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>