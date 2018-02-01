
@extends('frontend.layouts.ev.customer')
@section('content')



<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                    <div class="container-fluid">


                    	       <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a  type="button" class="btn btn-default btn-circle cursor" disabled="disabled">3</a>
                                        <p>Step 3</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">4</a>
                                        <p>Step 4</p>
                                    </div>
                                </div>
                            </div>
                        <div class="row equalize sm-equalize-auto">
                            <div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
							@if (!empty($packages))
								<ul class="image-slider">
									{{--*/ $k=1; $tottyp = count($packages); /*--}}
									@foreach($packages as $key=>$package)
									<li class="{{($k==1) ? 'active' : ''}}">
                                        <a href="#">
                                            <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="height:580px; width: 100%;">
                                        </a>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="image-slider-btns-bg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="slider-sec-side-text-bg">
                                                            <div class="slider-side-sec-alignment">
                                                                <div class="expeience-small-text">Hotel Marketing Packages</div>
                                                                <div class="slider-side-text-tittle">{{$package->package_title}}</div>
                                                                <div class="slider-side-description-text">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img class="slider-next-image-btn img-responsive" src="http://www.emporium-voyage.com/uploads/properties_subtab_imgs/69726129-32146277.jpg" alt="">
                                                                <a href="#" style="margin-left:100px;" rel="{{$package->id}}" class="book-button open-show_more-page hotel-btn ClickButton">Show More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
									{{--*/ $k++; /*--}}
												
									@endforeach

                                </ul>
                                <div class="clearfix"></div>
                                <div class=" editorial-images-count images-count">1 / {{$tottyp}}</div>
                                <div class="editorial-image-slider-btns image-slider-btns">
                                    <a class="editorial-image-slider-previous-btn image-slider-previous-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt="">
                                    </a>
                                    <a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt="">
                                    </a>
                                </div>
								@endif
                            </div>
                        </div>
                    </div>
                </section>



@endsection


@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">

@endsection

@section('script')

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection