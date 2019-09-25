@extends('pages.home')

@section('content')
    @content(['header' => 'Our services', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12 details">
                    <div class="my-2 text-right">
                        <a href="{{ route(Auth::check() ? 'new' : 'register') }}" class="btn btn-primary btn-sm">{{ __('Place Order') }}</a>
                    </div>
                    <p class="px-0">We provide the following services:</p>
                    <blockquote class="px-4">
                        <ul class="primary-color">
                            <li>
                                <h5 class="bold m-0">Empirical Data and Information</h5>
                                <blockquote class="mx-2 my-0">
                                    <ul>
                                        <li>Providing data for relevant programme content on Nigeria media stations</li> 
                                        <li>Providing data for the following media:
                                            <blockquote class="mx-2 my-0">
                                                <ul class="disc">
                                                    <li>Radio</li>
                                                    <li>Magazines</li>
                                                    <li>Television</li>
                                                    <li>Newspaper</li>
                                                    <li>New media</li>
                                                    <li>Social media</li>
                                                </ul>
                                            </blockquote>
                                        </li>
                                        <li>Media Trends Report</li>   
                                        <li>Media Audience Trends</li>   
                                    </ul>
                                </blockquote>
                            </li> 
                            <li>
                                <h5 class="bold m-0">Practical research</h5>
                                <blockquote class="m-0 py-1">
                                    We conduct research in the following areas:
                                </blockquote>
                                <blockquote class="mx-4 my-0">
                                    <ul class="disc">
                                        <li>Media</li>
                                        <li>Advertising</li>
                                        <li>Marketing</li>
                                        <li>Customer</li>
                                        <li>Product</li>
                                        <li>Survey</li>
                                        <li>Social Development Trends</li>
                                        <li>Public Opinion</li>
                                        <li>Democracy</li>
                                    </ul>
                                </blockquote>
                            </li> 
                            <li>
                                <h5 class="bold m-0">Educational Services</h5>
                                <blockquote class="m-0 py-1">
                                    For clients in Arts, Social Sciences, Education, Humanities, Administration and Management Sciences, 
                                    we offer services in the follwing: 
                                </blockquote> 
                                <blockquote class="mx-4 my-0">
                                    <ul class="disc">
                                        <li>Essays</li>   
                                        <li>Term Papers</li>   
                                        <li>Thesis</li> 
                                        <li>Dissertations</li> 
                                        <li>Assignment</li> 
                                        <li>Data Analysis</li> 
                                        <li>Data Gathering</li> 
                                        <li>Reports</li>
                                        <li>Editing</li>
                                        <li>Speeches</li>
                                        <li>Reviews</li>
                                        <li>Plagiarism</li>
                                        <li>Presentations</li>
                                        <li>Projects</li>
                                        <li>Case Studies</li>
                                        <li>Critical Thinking</li>
                                        <li>Annotated Bibliography</li>
                                        <li>Capstone Projects</li>
                                        <li>Grant Proposals</li>
                                    </ul> 
                                </blockquote>
                            </li>
                        </ul>
                    </ blockquote>
                </div>
            </div>
        @endslot
    @endcontent
@endsection