@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'PDP Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')

    @if(!empty($propertyDetail))
        @if (array_key_exists('propimage', $propertyDetail))
            @if(!empty($propertyDetail['propimage']))
                <!-- Restaurant slider starts here -->
                <section class="luxuryHotelSlider">
                    <div id="myCarousel" class="carousel" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($propertyDetail['propimage'] as $propimg)

                                @if(file_exists($propertyDetail['propimage_containerpath'].$propimg->file_name))
                                {{--*/ $thactualsize = getimagesize($propertyDetail['propimage_containerpath'].$propimg->file_name); /*--}}
                                        @if($thactualsize[0]>$thactualsize[1])
                                            <div class="item {{($propertyDetail['propimage'][0]==$propimg) ? 'active' : ''}}">
                                                <img src="{{$propertyDetail['propimage_thumbpath'].$propimg->file_name}}"
                                                     alt="{{$propertyDetail['data']->property_name}}">
                                                <div class="carousel-caption">
                                                    <h1>{{$propertyDetail['data']->property_name}}</h1>
                                                    <p>{{ $propertyDetail['data']->property_usp }}</p>
                                                </div>
                                            </div>
                                        @endif
                                @endif
                               
                            @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
                        </a>
                    </div>
                    <span class="scrollNextDivHotel"><a href="#hotelInfo">Scroll Down</a></span>
                </section>
            @endif
        @endif


        <!-- HAM YARD HOTEL -->
        <setion id="hotelInfo" class="HamYardHotelSection">
            <div class="HamYardHotelInner HamYardHotelInnerfirst">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <h2>{{$propertyDetail['data']->detail_section1_title}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section1_description_box1) !!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rightPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section1_description_box2) !!}</p>
                                <a class="viewRooms scrollpage" href="#roomsSuit">View Rooms</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </setion>
        <!-- HAM YARD HOTEL -->
        <setion class="HamYardHotelSection">
            <div class="HamYardHotelInner HamYardHotelInnersecond">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <h2>{!! nl2br($propertyDetail['data']->detail_section2_title) !!}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section2_description_box1)!!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rightPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section2_description_box2) !!}</p>
                                <div class="image-showcase-below-big-text">{{$propertyDetail['data']->assign_detail_city}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </setion>
        
        <!-- MEMBERSHIP SECTION -->
        <setion class="HamYardHotelSection" id="cont_connoiss">
            <div class="HamYardHotelInner HamYardHotelInnerthird">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <h2>CONNOISSEUR OF LUXURY</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <p>Whatever your heart desires, we make it happen! Our par excellence, tailored concierge services ensure that the vision of all our customers is realized and they enjoy nothing less than the vacation of their dreams.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rightPaddingSec">
                                <p>We make immense pride in our dense network of luxury associates who help make our members experiences exceptional whereever of contracts ensures that our members get the very best life has to offer -no matter where they are in the world.</p>  
                                <div>
                                    <div class="colMembershipType">                                        
                                        <div class="dropdown show">
                                              <a class="btnMembershipType dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Our Memberships
                                              </a>
                                            
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Lifestyle</a>
                                                <a class="dropdown-item" href="#">Bespoke</a>
                                                <a class="dropdown-item" href="#">Dedicated</a>
                                              </div>
                                        </div>
                                    </div>
                                    <!--<div class="colMembershipType">
                                        <a class="btnMembershipTypeJoin" href="#roomsSuit">Join The Club</a>
                                    </div> -->   
                                </div>                         
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </setion>
        
        
        <div class="row member-type-pad" id="cont_packages" style="display: none;">
            @if(!empty($packages))                        
            {{--*/ $k=1; /*--}} 
			<div id="mem-accordion" class="panel-group">
                @foreach($packages as $key=>$package)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="click0" data-toggle="collapse" data-parent="#mem-accordion" href="#collapse_{{$k}}">{{$package->package_title}}</a>
                        </h4>
                    </div>
                    <div id="collapse_{{$k}}" class="panel-collapse collapse <?php echo ($k==1) ? 'in' : '' ?>">
                        <div class="panel-body magin-top-30">
                            <div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                @if($package->package_image!='')
                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                @endif
                                </div>
                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                    <div class="row">
                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                            <p>{!! nl2br($package->package_description) !!}</p>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                  
                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>                
                                    <div class="row" style="margin-top: 10px;">
                                                                                                                             
                                        <div class="col-lg-12 m--align-right">
                                            <div>                                                                        
                                                <a class="btnMembershipTypeJoin" href="javascript:void(0);">Join The Club</a>
                                            </div>
                                        </div>
                                       
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--*/ $k++;  /*--}}
                @endforeach				
            </div>
            @endif
        </div>
               
        
        @if (array_key_exists('typedata', $propertyDetail))
            <!-- hotel slider 1 -->
            @foreach($propertyDetail['typedata'] as $type)
                @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                    {{--*/ $totimg = count($propertyDetail['roomimgs'][$type->id]['imgs']); $divd2 = round($totimg/2); /*--}}
                    <section id="roomsSuit" class="roomSuitSlider">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6 noPadding">
                                    <div id="left{{$type->id}}" class="carousel slide leftSlider terraceSuiteSlider"
                                         data-ride="carousel">
                                        <div class="carousel-inner">
                                            @for($rimg1=0; $rimg1 < $divd2; $rimg1++)
                                                <div class="item {{ ($rimg1==0) ? 'active' : '' }}">
                                                    <a href="javascript:void(0);" class="galleryImgBtn" rel="{{$type->id}}">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
                                                </div>
                                            @endfor

                                            @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                                                <div class="item">
                                                    <a href="javascript:void(0);" class="galleryImgBtn" rel="{{$type->id}}">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{ $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name }}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
                                                </div>
                                            @endfor
                                        </div>
                                        <a class="left carousel-control left01" href="#left{{$type->id}}"
                                           data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#left{{$type->id}}" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3 noPadding">
                                    <div class="sliderContent">
                                        <h3>{{$type->category_name}}</h3>
                                        <p>{{(strlen($type->room_desc) > 100) ? substr($type->room_desc,0,100).'...':$type->room_desc}}</p>
                                        <button class="btn btn-default moreButtonPopup" type="button" rel="{{$type->id}}">More</button>
                                        <button class="btn btn-default" type="button" onclick="choose_room_type('{{$type->id}}');">Book Now</button>
                                        
                                        @if($type->price!='')
                                            <button class="btn btn-default"
                                                    type="button"> {{($currency->content!='') ? $currency->content : '$'}} {{ isset(\Auth::user()->id) ? $type->price : 'Login to view'}} </button>
                                        @endif
                                        
                                        <div class="sliderArrow">
                                            <a href="javascript:void(0);" class="prevClick"><i
                                                        class="fa fa-angle-left"></i></a>
                                            <a href="javascript:void(0);" class="nextClick"><i
                                                        class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 noPadding hidden-xs">
                                    <div id="right{{$type->id}}" class="carousel slide rightSlider terraceSuiteSlider"
                                         data-ride="carousel">
                                        <div class="carousel-inner">
                                            @for($rimg1=0; $rimg1 < $divd2; $rimg1++)
                                                <div class="item {{ ($rimg1==1) ? 'active' : '' }}">
                                                    <a href="javascript:void(0);" class="galleryImgBtn" rel="{{$type->id}}">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
                                                </div>
                                            @endfor

                                            @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                                                <div class="item @if($totimg<3) active @endif">
                                                    <a href="javascript:void(0);" class="galleryImgBtn" rel="{{$type->id}}">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{ $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name }}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
                                                </div>
                                            @endfor
                                        </div>
                                        <a class="left carousel-control left01" href="#right{{$type->id}}"
                                           data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#right{{$type->id}}" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach
        @endif

        <!-- Design and Architecture section -->
        @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
            <section id="design-architecture">
                <div class="container">
                    <figure class="design-image">
                        @if($propertyDetail['data']->architecture_image!='')
                            <img src="{{url('uploads/properties_subtab_imgs/'.$propertyDetail['data']->architecture_image)}}"
                                 alt="Design & Architecture" class="img-responsive"/>
                        @else
                            <img class="architecture-sec-top-img" src="{{url('sximo/assets/images/Architecture-&-Design.png')}}" alt=""/>
                        @endif
                    </figure>
                    <div class="content-box">
                        <div class="quote-small-box">
                            <p>{{$propertyDetail['data']->architecture_title}}</p>
                        </div>
                        <h2>Architecture & Design</h2>
                        <p>{{$propertyDetail['data']->architecture_desciription}}</p>
                    </div>
                </div>
            </section>
        @endif
        <!-- Design and Architecture section End -->

        @if (array_key_exists('typedata', $propertyDetail))
            <!-- terrace suit slider sec -->
            <div class="HamYardHotelSection">
                <div class="container">
                    <div id="HamYardHotelSlider" class="carousel slide HamYardHotelSlider" data-ride="carousel">
                        <div class="carousel-inner">
                            {{--*/ $k=1; /*--}}
                            @foreach($propertyDetail['typedata'] as $key=>$type)
                                @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                    <div style="background-image: url('{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}');"
                                         class="item {{($k==1) ? 'active' : ''}}">
                                        <div class="carousalCaption">
                                            <h3>Experience {{$propertyDetail['data']->property_name}}</h3>
                                            <h2>{{$type->category_name}}</h2>
                                            <p>{{(strlen($type->room_desc) > 300) ? substr($type->room_desc,0,300).'...':$type->room_desc}}</p>
                                        </div>
                                    </div>
                                    {{--*/ $k++; /*--}}
                                @endif
                            @endforeach
                        </div>
                        <div class="HamYardHotelSliderOptions">
                            <div class="terraceSuitindicator">
                                <div class="terraceSuitarrow">
                                    <div class="terraceSuitCounter">
                                        <p></p>
                                        <div class="num"></div>
                                    </div>
                                    <a class="left left1 carousel-control" href="#HamYardHotelSlider" data-slide="prev">
                                        <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}"
                                             alt="icon">
                                    </a>
                                    <a class="right carousel-control" href="#HamYardHotelSlider" data-slide="next">
                                        <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}"
                                             alt="icon">
                                    </a>
                                </div>
                                <ol class="carousel-indicators">
                                    {{--*/ $kn=0; /*--}}
                                    @foreach($propertyDetail['typedata'] as $key=>$type)
                                        @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                            <li data-target="#HamYardHotelSlider" data-slide-to="{{$kn}}"
                                                class="{{($kn==0) ? 'active' : ''}}"><img
                                                        src="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}"
                                                        alt="Image">

<div rel="{{$type->id}}" name="{{$type->category_name}}" class="showMoreSec" style="display:inline-block;">
                                    <button type="button" class="btn buttonDefault">SHOW MORE</button>
                                </div>

                                                    </li>

                                            {{--*/ $kn++; /*--}}
                                        @endif
                                    @endforeach
                                </ol>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- terrace suit slider sec end -->

        @if($propertyDetail['data']->video_title!='')
            <!-- Video Section starts here -->
            <section id="video" class="videoSection">
            @if($propertyDetail['data']->video_type=="upload")
                {{--*/  $videolink = url('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_video);
                $video_banner = ($propertyDetail['data']->video_image!='')? url('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_image): url('sximo/images/mp4.png');
                /*--}}
                <!-- <iframe src="https://www.youtube.com/embed/yAoLSRbwxL8" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                    <video id="videoPoster" controls poster="{{$video_banner}}">
                        <source src="{{$videolink}}" type="video/mp4">
                    </video>
                @elseif($propertyDetail['data']->video_type=="link")
                    {{--*/ $vlink = explode('/',$propertyDetail['data']->video_link); $vimeoid = end($vlink); /*--}}
                    @if($propertyDetail['data']->video_link_type=="youtube")
                        {{--*/  $videolink = "https://www.youtube.com/embed/".$vimeoid; /*--}}
                        <iframe width="100%" height="680px;" src="{{$videolink}}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @elseif($propertyDetail['data']->video_link_type=="vimeo")
                        {{--*/  $videolink = "https://player.vimeo.com/video/".$vimeoid; /*--}}
                        <iframe width="100%" height="680px;" src="{{$videolink}}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @endif

                @endif
            </section>
            <!-- Video Section END here -->
        @endif


        <section id="bookHotel" class="hotelSearchDateSection">
            <div class="HamYardHotelInner HamYardHotelInnerfooter">
                <div class="hotelSearchDateInnerContent text-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="hotelPopupHeadings">
                                    <!--<h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>-->
                                    <h2>Connoisseurs of Luxury Lifestyle</h2>
                                    <p class="planner-text">Emporium Collection provides a bespoke service that offers an extensive collection of some of the most exquisite and exclusive suites & experiences around the world.</p>
                                    <!--<p>With over 300 posh properties, elite spas and exquisite yachts huddled in its
                                        cocoon, Emporium Voyage ensure the ultimate luxury experience</p> -->
                                </div>
                            </div>
                        </div>
                        <form class="detail-page-booking-form"
                              action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get">
                            <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}"/>
                            <input type="hidden" name="roomType" id="roomType" value=""/>
                            <div class="row">
                                <ul class="hotelBorderList">
                                    
                                    <li style="width: 45%;" class="center-calendarbox">
                                        <div id="t-middel-picker" class="t-datepicker">
                                            <div class="t-date-divide">
                                                <h3>Arrival</h3>
                                                <div class="t-check-in"></div>
                                            </div>
                                            <div class="t-date-divide">
                                                <h3>Departure</h3>
                                                <div class="t-check-out"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <!--<li>
                                        <h3>Arrival</h3>
                                        <div class="form-group">
                                            <input name="arrive" id="reservationdate-1" class="form-control datefield reservationdate" type="text" readonly required>
                                            <div class="input-group-icon"><i class="fa fa-calander"></i></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h3>Departure</h3>
                                        <div class="form-group">
                                            <input name="departure" id="reservationdate-2" class="form-control datefield reservationdate" type="text" readonly required>
                                            <div class="input-group-icon"><i class="fa fa-calander"></i></div>
                                        </div>
                                    </li>-->
                                    
                                    <!-- <li style="width: 45%;" class="middle-calendarbox">
                                        <div id="t-middel-picker" class="t-datepicker">
                                            <div class="t-check-in"></div>
                                            <div class="t-check-out"></div>
                                        </div>
                                    </li> -->
                                    <li>
                                        <h3>Adults</h3>
                                        <select name="booking_adults">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </li>
                                    <li>
                                        <h3>Children</h3>
                                        <select name="booking_children">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </li>
                                </ul>
                                <div class="text-center hotelBookNowButton">
                                    <button type="submit" class="btn">BOOK NOW</button>
                                </div>
                                <div class="hotelCancelBooking text-center">
                                    <a href="javascript:void(0);">View, Modify or Cancel your Booking</a>
                                </div>
                                <ul class="hotelBookingFooter">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Join the worlds leading luxury club</span>
                                        </a>
                                        <a href="javascript:void(0);" class="enjoy_exclusive_member">
                                            <h6>Enjoy exclusive members only benefits</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>View or Modify Reserveration</span>
                                        </a>
                                        <a href="javascript:void(0);" class="login_hotel_pms">
                                            <h6>Login to Hotel PMS</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Spa Treatment</span>
                                            <h6>Book</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                    </form>
                </div>
            </div>
            </div>
        </section>

        @if($propertyDetail['data']->assign_detail_city!='')
            @if(!empty($relatedgridpropertiesArr))
                <section id="luxury-hotel-selection">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2 class="heading" style="text-transform: uppercase;">view our selection of "related" luxury hotels in
                                    IN {{$propertyDetail['data']->assign_detail_city}}</h2>
                            </div>
                        </div>
                       <div class="grid dsp-flex">
    


@if($relatedgridpropertiesArr)

        @foreach($relatedgridpropertiesArr as $props)
          
            
                                  <div class="col-md-3 col-sm-6 col-xs-12 grid-item">
                                    <div class="row">
                                       <div class="gridinner">
                                        <div class="image">
                                                 <a class="showhide" href="{{ url($props['data']->property_slug)}}" rel="bookmark" style="">{{ $props['data']->property_name}}   </a>
                                        <a href="{{ url($props['data']->property_slug)}}" title="{{ $props['data']->property_name}}">
                                              <img src="{{ URL::to('propertyimagebyid/'.$props['data']->id)}}" class="img-responsive" alt="{{ $props['data']->property_name}}" title="{{ $props['data']->property_name}}">
                                          
                                        </a>

                                       </div>
                                        <div class="gridtext">
                                          <h5 class="entry-title">
                                              <a href="{{ url($props['data']->property_slug)}}" rel="bookmark" style="">{{ $props['data']->property_name}}   </a>
                                              <a href="{{ url($props['data']->property_slug)}}"><i class="fa fa-shopping-cart"></i></a>
                                          </h5>
                                           <p>  {{ $props['data']->property_usp}}</p>
                                              <a class="read-more-link" href="{{ url($props['data']->property_slug)}}" title="discover">discover</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                 
                 
      @endforeach 
@endif

     
  </div>  
		      
		      
		      
                    </div>
                </section>
            @endif
        @endif
        <!-- Selection of Luxury Hotels end -->
        <!-- Instagram Gallery Section -->
        @if($propertyDetail['data']->social_instagram!='')
            <section id="instagram-section">
                <div class="col-sm-12 text-center">
                    <h2 class="heading">GET SOCIAL</h2>
                </div>
                <section id="instagran" class="sections-instagram">
                    <div class="full-width">
                        <div data-is data-is-api="{{ url('runInsta')}}"
                             data-is-source="{{(!empty($propertyDetail) && $propertyDetail['data']->social_instagram!='')? $propertyDetail['data']->social_instagram : '@socialdesignlocations777' }}"
                             data-is-rows="2" data-is-limit="0" data-is-columns="5"></div>
                    </div>
                </section>
            </section>
        @endif
    @endif
	
	
	<!-- gallery Img Popup -->
	<div class="galleryImgPopup fullWidthPopup">
	  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
	  <div class="searchDateInnerContent text-center">
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-xs-12 text-center">
				  <div class="gallyPopupHeader">
					  <a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage" class="img-responsive mCS_img_loaded"></a>
				  </div>
			  </div>
			  <div class="col-md-2 col-sm-3">
				  <div class="galleryPopupLeftSide">
					  <h1><a href="javascript:void(0);">New Hotel</a></h1>
					  <div class="popupHotelDetail text-center">
						  <h3>Hotel Zoo Berlin</h3>
						  <p>New York City</p>
						  <p>United States</p>
						  <a class="btn" href="javascript:void(0);">View Hotel</a>
					  </div>
					  <a class="bootomViewNextBtn" href="javascript:void(0);">View All Hotel DOI</a>
				  </div>
			  </div>
			  <div class="col-md-10 col-sm-9 galleryImgdata">
				  
			  </div>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Show More Popup -->
	<div class="showMorePopup fullWidthPopup">
	  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-4 col-md-6">
				  
			  </div>
			  <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
				<div class="showMoreContent">
				  
				</div>
			  </div>
		  </div>
		</div>
	</div>
    <!-- Show Login Popup -->
	<div class="showLoginPopup fullWidthPopup">
	  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-4 col-md-6">
				  
			  </div>
			  <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
				<div class="showLoginContent">
				    Please Login to book  
				</div>
			  </div>
		  </div>
		</div>
	</div>
@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')
    @include('frontend.themes.emporium.layouts.sections.pdp_right_iconbar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    
@endsection


{{-- For Include Top Bar --}}
@section('top_search_bar')
    @include('frontend.themes.emporium.layouts.sections.pdp_top_search_bar')
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.pdp_sidebar')
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    <link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
    @if(!empty($propertyDetail))
        @if( array_key_exists('propimage', $propertyDetail))
            <style>
                .magin-top-30{
                    margin-top: 30px;
                }
                .HamYardHotelInnerfirst {
                    background-image: url('{{ $propertyDetail['propimage_thumbpath'].$propertyDetail['propimage'][1]->file_name}}');
                }
				
				.HamYardHotelInnersecond {
                    background-image: url('{{ $propertyDetail['propimage_thumbpath'].$propertyDetail['propimage'][2]->file_name}}');
                }
                
				.HamYardHotelInnerthird {
                    background-image: url('{{URL::to("images/connoiser-bg.jpg")}}');
                    padding-top: 100px !important;
                }
                
				.HamYardHotelInnerfooter {
                    background-image: url('{{ $propertyDetail['propimage_thumbpath'].$propertyDetail['propimage'][3]->file_name}}') !important;
                }
                .center-calendarbox .fa.fa-calendar{
                    float: left;
                }
                .center-calendarbox span{ color: #fff !important; display: inline !important; }
                .t-day{ color: #000 !important; }
                
                .t-date-divide{
                    float: left;
                    width: 50%;
                }
                .center-calendarbox .t-check-in, .center-calendarbox .t-check-out{
                    width: 98% !important;
                    margin-top: 16px;
                    margin-bottom: 40px;
                }
                .hotelBorderList .t-dates{
                    background-color: transparent !important;
                }
                .hotelBorderList .t-datepicker-day{
                    color: #000 !important;
                }
                .hotelBorderList .t-arrow-top{
                    top: 65px;
                }
                .dropdown-menu{
                    left: 17px;
                    top: -27px;
                    min-width: 143px !important;                    
                    background-color: #000;
                    border: 1px solid #fff;   
                }
                .dropdown-item {
                    display: block;
                    width: 100%;
                    padding: .25rem 1.5rem;
                    clear: both;
                    font-weight: 400;
                    color: #fff;
                    text-align: inherit;
                    white-space: nowrap;
                    background-color: transparent;
                    border: 0;
                }
                .btnMembershipType::after {
                    display: inline-block;
                    width: 0;
                    height: 0;
                    margin-left: .255em;
                    vertical-align: .255em;
                    content: "";
                    border-top: 0;
                    border-right: .3em solid transparent;
                    border-bottom: .3em solid;
                    border-left: .3em solid transparent;
                }
                .dropdown-item:hover, .dropdown-item:focus{
                    color: #fff;
                }
                <!-- Start Modal popup -->
                #showMemberLoginPopup .modal-dialog{
                    width: 700px !important;
                }
                #showMemberLoginPopup .modal-header{
                    border: 0px;        
                    padding:0px !important;
                }
                #showMemberLoginPopup .modal-content{
                    background: #252525 !important;        
                    min-height: 300px;
                }
                #showMemberLoginPopup .modal-content .popup-title{
                    color: #fff !important;
                    padding: 0px;
                    margin-top: 0px;
                    font-family: DomaineDisplay;
                }
                #showMemberLoginPopup .modal-content p{
                    color: #fff !important;        
                }
                #showMemberLoginPopup .modal-content h6{
                    color: #fff !important;        
                }
                #showMemberLoginPopup .btnMembershipTypeJoin{
                    margin-top: 25px;
                    float: none;
                    width: 90%;
                    /*margin: 0px auto;*/
                    text-align: center;
                    display: block;
                    cursor: pointer;
                }
                .btnMembershipTypeBack {
                    border: 1px solid #fff;
                    border-radius: 0px;
                    color: #fff;
                    font-size: 12px;
                    padding: 12px 20px;
                    text-transform: uppercase;
                    /*margin-left: 10px;*/
                    float: left;
                    text-decoration: none;
                    /*margin-top: 93px;*/
                    margin-top: 25px;
                    cursor: pointer;
                }
                .btnMembershipTypeBack:hover, .btnMembershipTypeBack:focus {
                    color:#fff;
                }
                .modal-backdrop{background-color:#252525 !important}
                .modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}
                .modal-backdrop.in{filter:alpha(opacity=95);opacity:.95}
                
                @media (max-width:1199px){
                    #showMemberLoginPopup .modal-dialog{
                        width:auto !important;
                    }
                    .btnMembershipTypeBack{
                        width: 100%;
                        text-align: center;
                    }
                }
                <!-- End Modal popup -->
            </style>
        @endif
    @endif
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<!-- instagram -->
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
        var logined = true;
        <?php
            if(isset(\Auth::user()->id)){
        ?>
                logined = false;    
        <?php
            }
        ?>
        $(document).ready(function () {
            
            $(".btnMembershipType").click(function(e){
                e.preventDefault();
                $("#cont_connoiss").css('display', 'none')
                $("#cont_packages").css('display', '');        
            });
            
            $(".btnMembershipTypeJoin").click(function(e){
                e.preventDefault();
                $(".clicktologin").trigger("click");
                $(".signInPopupButton").trigger('click');
            });
            
            $(".login_hotel_pms").click(function(){
                $(".clicktologin").trigger("click");
            });
            $(".enjoy_exclusive_member").click(function(){
                var left  = ($(window).width()/2)-(500/2);
                var top   = ($(window).height()/2)-(450/2);
                newwindow=window.open("https://emporium-lifestyle.com",'name','height=500,width=450,top=100, left='+left+'');
                if (window.focus) {newwindow.focus()}
                return false;
            });
            
            var chk_date = new Date(); 
            
            var chk_out_date = new Date();
            
            
            
            $('#t-middel-picker').tDatePicker({
                'numCalendar':'2',
                'autoClose':true,
                'durationArrowTop':'200',
                'formatDate':'mm-dd-yyyy',
                'titleCheckIn':'Arrival',
                'titleCheckOut':'Departure',
                'inputNameCheckIn':'arrive',
                'inputNameCheckOut':'departure',
                'titleDateRange':'days',
                'titleDateRanges':'days',
                'iconDate':'<i class="fa fa-calendar"></i>',
                'limitDateRanges':'365',
                'dateCheckIn':chk_date,
                'dateCheckOut':chk_out_date,
                //'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                //'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
            });
        });
        
        $(document).on('click', '.galleryImgBtn', function () {
			var params = $.extend({}, doAjax_params_default);
			params['url'] = BaseURL + '/getpropertyroomimages/' + $(this).attr('rel');
			params['successCallbackFunction'] = renderRoomimages;
			doAjax(params);

		});
		
		function renderRoomimages(data) {
			$('.galleryImgdata').html('');
			var imagesPro = '';
			var im=0;
			var di=0;
			var lngimg = Math.round((data.image.length)/3);
			imagesPro += '<div class="row">';
			$(data.image).each(function (i, val) {
				var clsact = '';
				imagesPro += '<div class="col-sm-6 col-xs-6 col-md-4 col-lg-4">';
				imagesPro += '<div class="popupHetelImage"><img src="' + val.imgsrc + '" alt="Image"></div>';
				imagesPro += '</div>';
				if(di==lngimg)
				{
					di=0;
					imagesPro += ' </div>';
					imagesPro += '<div class="row">';
				}
				im++;
				di++;
			});
			imagesPro += ' </div>';
			$('.galleryImgdata').html(imagesPro);
			$('.galleryImgPopup').addClass('openPopup');
		}
		
		$(document).on('click', '.showMoreSec, .moreButtonPopup', function () {
			$('.showMorePopup').css("background-image", "");
			$('.showMoreContent').html('');
			var params = $.extend({}, doAjax_params_default);
			params['url'] = BaseURL + '/getpropertytypedetail/' + $(this).attr('rel');
			params['successCallbackFunction'] = renderRoomdetails;
			doAjax(params);

		});
		
		function renderRoomdetails(data) {
            console.log(data)
			var rimg = data.roomimgs.imgsrc;
			$('.showMorePopup').css("background-image", "url('" + rimg + "')");
			var imagesPro = '';
			imagesPro += '<h1>' + data.typedata.category_name + '</h1>';
			imagesPro += '<p>' + data.amenities.amenities_eng.replace(/\n/g, "<br />") + '</p>';
			imagesPro += '<p>' + data.typedata.room_desc + '</p>';
            
            
    			imagesPro += '<div class="shoMoreButtonSection">';
    			if (data.typedata.price != '')
    			{
    				imagesPro += '<h2>';
    				imagesPro += (data.currency.content != '') ? data.currency.content : '$';
    				imagesPro += (logined) ? 'Login to view' : data.typedata.price;
    				imagesPro += '</h2>';
    			}
    			imagesPro += '<a href="javascript:void(0);" onclick="choose_room_type(' + data.typedata.id + ');" class="button">Book</a>';
    			imagesPro += '</div>';
            
            
			$('.showMoreContent').html(imagesPro);
			$('.showMorePopup').addClass('openPopup');
		}
		
		function choose_room_type(type)
		{
            if(logined){
                show_modal_content('lifestyle-collection');
                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                //$("#showLoginPopup").modal();
            }else{
    			$('#roomType').val('');
    			if (type != '' && type > 0)
    			{
    				$('#roomType').val(type);
    				$(".detail-page-booking-form").trigger("submit");
    			}
            }
		}
        
        function show_modal_content(memtype){
            $.ajax({
                url:'{{URL::to("membershiptype/popup")}}',
                type: "POST",
                data: {memtype:memtype},
                dataType: "json",
                success: function (data, textStatus, jqXHR) {
                    var popupHtml = '';
                    if (data.status == 'success') {
                        var obj = data.mem_package;
                        popupHtml += '<div class="row">';
                        
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<img class="img-responsive object-fit-size" src="{{URL::to("uploads/category_imgs")}}/'+obj.category_image+'" style="width: 100%;">';
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<h2 class="popup-title">'+obj.category_name+'</h2>';
                                popupHtml += '<p>'+(obj.category_description).replace(/\n/g,"<br>")+'</p>';
                                //popupHtml += '<h6>{!! isset($currency->content)?$currency->content:"&euro;" !!}'+obj.package_price+'</h6>';
                                
                                str_mem = '';
                                if(memtype=="dedicated-collection"){
                                    str_mem = 'Dedicated';
                                    str_mem2 = 'dedicated';
                                }else if(memtype=="bespoke-collection"){
                                    str_mem = 'Bespoke';
                                    str_mem2 = 'bespoke';
                                }else if(memtype=="lifestyle-collection"){
                                    str_mem = 'Lifestyle';
                                    str_mem2 = 'lifestyle';
                                }
                                popupHtml += '<a class="btnMembershipTypeJoin" href="{{URL::to("memberships")}}?type='+str_mem2+'">View Membership Benefits</a>';
                                popupHtml += '<a class="btnMembershipTypeJoin" id="loginasa">Login as a '+str_mem+' Member</a>';
                                
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">';
                                popupHtml += '<a class="btnMembershipTypeBack" onclick="window.history.back();">Back</a>';
                            popupHtml += '</div>';
                            //popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6  col-xs-12">';
                                
                            //popupHtml += '</div>';
                        popupHtml += '</div>';
                    }
                    $(".mem-modal-popup").html(popupHtml);
                }
            });
        }
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection
