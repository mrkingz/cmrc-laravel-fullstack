@extends('pages.home')

@section('content')
    @content(['header' => 'About us', 'classes' => 'col-lg-7'])
        @slot('pagecontent') 
            <div class="bg-lighter d-flex justify-content-center mt-1 py-4">
                <div class="col-lg-11 col-md-11 col-sm-12 details pt-4">
                    <blockquote class="px-4">
                        <ul class="primary-color">
                            <li>
                                <h4 class="bold m-0">Who we are</h4>
                                <blockquote class="px-0">
                                    <strong class="lead">Communication and Media Research Center </strong> 
                                    is a pioneered research based site in Nigeria that provides excellent
                                    research  services  for media and communication in the country 
                                    established in 2018.  
                                    It is a private firm own and operated by professional and seasoned 
                                    personnel’s from the field of Communication, Media, Advertising,
                                    marketing, Public relations and humanities. 
                                </blockquote>
                            </li>
                        </ul>
                        <ul class="primary-color">
                            <li>
                                <h5 class="bold my-0">Our Mission</h5>
                                <blockquote class="px-0">
                                    Setting-up of communication and media research site in 2018; 
                                    design to provide 
                                    the services of practical and educational research in Nigeria. 
                                    The center main objective is to carry out research for media organizations,
                                    advertisers, co-corporations, government, non-governmental organizations, 
                                    institutions and private individuals on issues related to audience
                                    measurement, market and consumer surveys, advertiser, contemporary 
                                    issues in the media,
                                    social, political and economic issues, public opinion survey etc. 
                                    This site will focus on practical quantitative and qualitative research. 
                                    The aim is to promote Research and Development for improved media environment,
                                    democracy, business corporations and individual enterprises,
                                    and contribute in finding solution to myriad of societal challenges.  
                                </blockquote>
                            </li>
                        </ul>
                        <ul class="primary-color">
                            <li>
                                <h5 class="bold my-0">Our Objectives </h5>
                                <span class="my-0 size-13">Our objectives cut accross the following areas:</span>
                                <blockquote>
                                    <ul class="disc primary-color">
                                        <li>
                                            <b>Empirical Data and Information:</b>
                                            <blockquote>
                                                To provide  information on relevant  issues in governance, democracy,
                                                environment, 	economic  and social issues in Nigeria.  
                                                The aim is to promote Research and Development for improved media
                                                environment,
                                                democracy, business corporations, individuals enterprise and 
                                                contribute in finding solution to myriad of societal challenges.  
                                            </blockquote>
                                        </li>
                                        <li>
                                            <b>Practical Research: </b>
                                            <blockquote>
                                                To carry out research for media organizations, advertisers, 
                                                co-corporations, government, non-governmental organizations, 
                                                institutions and private individuals on issues related to audience 
                                                measurement, market and consumer surveys, 
                                                advertiser, contemporary issues in the media, social, political and 
                                                economic issues, public opinion survey etc.
                                            </blockquote>
                                        </li>
                                        <li>
                                            <b>Educational Services:</b> 
                                            <blockquote>
                                                Offer a high quality writing service. We are dedicated to providing
                                                customized, authentic papers to our clients around the globe.  
                                                Delivering quality write-ups is what we love, and we take 
                                                pride in what we have achieved so far. 
                                            </blockquote>
                                        </li>   
                                    </ul> 
                                </blockquote>
                            </li>
                        </ul>
                    </blockquote>
                </div>
            </div>
        @endslot
    @endcontent
@endsection