@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Luxury Travel Club
@stop
    
@section('subheader_search')
    <div class="m-subheader-search">
        <h2 class="m-subheader-search__title">
    		Discover Ultra Luxury Experiences Worldwide 
    	</h2>
    	<form class="m-form reservation-form" action="{{URL::to('search')}}" method="get" id="reservationForm" name="reservationform">
    		<div class="m-grid m-grid--ver-desktop m-grid--desktop">
    			<div class="m-grid__item m-grid__item--middle">
    				<div class="m-input-icon m-input-icon--fixed m-input-icon--right">
    					<input type="text" name="s" data-action="auto-suggestion" class="form-control" placeholder="Enter your hotel or destination"/>
    				</div>
    				<div class="m-input-icon m-input-icon--fixed-large m-input-icon--fixed-md m-input-icon--right search-cal-top">
    					<div class="calendarbox">
                    	   <div class="row">
                                <div id="t-topbar-picker" class="col-xs-12 col-md-12 t-datepicker">
                                    <div class="t-check-in"></div>
                                    <div class="t-check-out"></div>
                                </div>
                    	   </div>
                    	</div>
    				</div>
                    <div class="m-input-icon m-input-icon--fixed-small m-input-icon--fixed-md m-input-icon--right">
    					<input name="adult" type="number" class="form-control " placeholder="Adult children">
    				</div>
                    <div class="m-input-icon m-input-icon--fixed-small m-input-icon--fixed-md m-input-icon--right">
    					
                        <?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
                        <select name='currencyOption' class="form-control form-control-height">
                            <option value="EUR">Currency</option>
                            @foreach($currencyList as $currencyCode => $currencyName)
                
                                <option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
                            </option>
                
                            @endforeach                
                        </select>
                        
    				</div>
    			</div>
    			<div class="m-grid__item m-grid__item--middle search-btn-top-margin">
    				<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
    				<button type="submit" class="btn m-btn--pill m-subheader-search__submit-btn">
    					Search Hotels
    				</button>
    			</div>
    		</div>
    	</form>
    </div>
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
@stop

@section('content')    
<div class="parent_hotel_name">
    <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title">
					Discerning Traveller
				</h3>
			</div>
		</div>
	</div>

    <!-- Second Row -->
	<div class="row">
		<div class="col-sm-12 col-md-4 col-xl-4">
			
            @if(!empty($blogs))
                <div id="b2cblog_carousel" class="rad-carousel">
                     
                    <ol class="carousel-indicators">
                        @foreach($blogs as $key => $blog_row)
                        <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                        @endforeach
                    </ol>
                     
                    <!-- Carousel items -->
                    <div class="rad-carousel-inner">
                    @foreach($blogs as $key => $blog_row)    
                    <?php 
                        $final_url = '#';
                        $ext_url = trim($blog_row->external_link);
                        if(strlen($ext_url)>0){                        
                            if(strpos($ext_url, 'http://') !== 0 && strpos($ext_url, 'https://') !== 0 ) {
                              $final_url = 'http://' . $ext_url;
                            } else {
                              $final_url = $ext_url;
                            }  
                        }                       
                    ?>
                    <div class="item {{($key == 0)? 'active' : ''}}">
                    	<div class="row">
                        <div class="col-md-12">
                            <a href="{{$final_url}}" class="thumbnail" target="_blank">                                
                                <img src="{{url('/uploads/article_imgs/'.$blog_row->featured_image)}}" alt="{{$blog_row->title_pos_1}}" style="max-width:100%;">
                                <div class="dash_img_overlay"></div>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <div class="heading">
                                <a href="#">{{$blog_row->title_pos_1}}</a>
                            </div>
                        </div>   
                                    	  
                        <div class="col-md-12">
                            <div class="blog-desc">
                                <p>{{str_limit(strip_tags($blog_row->description_pos_1), 255)}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="{{$final_url}}" class="blog-readmore">Continue Reading</a>
                        </div>                              
                    	</div><!--.row-->
                    </div><!--.item-->
                    @endforeach 
                     
                    </div><!--.carousel-inner-->
                      <!--<a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
                      <a data-slide="next" href="#Carousel" class="right carousel-control">></a> -->
                </div><!--.Carousel-->
            @endif
            
            <!--begin:: Widgets/Announcements 2-->
			<?php /* <div class="m-portlet m--bg-danger m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							
						</div>
					</div>							
				</div>
				<div class="m-portlet__body">
					<!--begin::Widget 7-->
					<div class="m-widget7 m-widget7--skin-dark">								
						<div class="m-widget7__user">
							<div class="m-widget7__user-img m--align-center">
								{!! SiteHelpers::avatarProfile(80,80,'') !!}
                                <h5>{{ Session::get('fid') }}</h5>
							</div>
							<div class="m-widget7__info">
								<span class="m-widget7__username">
								    {{ Session::get('fid') }}	
								</span>
							</div>
						</div>
                        <div class="m-widget7__desc">
							Welcome to the emporium Voyage World. 
Emporium Voyage is a prestige organisation seeking to serve your every need. Navigate through your dashboard and connect with your account execitive with any questions you may have.
						</div>
						<div class="m-widget7__button">
							<a class="m-btn m-btn--pill btn btn-accent" href="{{URL::to('user/profile')}}" role="button">
								GO TO MY PROFILE
							</a>
						</div>
					</div>
					<!--end::Widget 7-->
				</div>
			</div>
			<!--end:: Widgets/Announcements 2-->
		    */ ?>  
            
            
		</div>
        <div class="col-sm-12 col-md-8 col-xl-8">
            @if(!empty($pageslider))
            <div id="Carousel" class="carousel slide">
                 
                <ol class="carousel-indicators">
                    @foreach($pageslider as $key => $slider_row)
                    <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                    @endforeach
                </ol>
                 
                <!-- Carousel items -->
                <div class="carousel-inner">
                @foreach($pageslider as $key => $slider_row)    
                <div class="item {{($key == 0)? 'active' : ''}}">
                	<div class="row">
                	  <div class="col-md-12">
                        <a href="{{$slider_row->slider_link}}" class="thumbnail">                            
                            <div class="b2c-banner-text">{{$slider_row->slider_title}}</div>
                            <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}" style="max-width:100%;">
                        </a>
                      </div>                	  
                	</div><!--.row-->
                </div><!--.item-->
                @endforeach 
                 
                </div><!--.carousel-inner-->
                  <a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
                  <a data-slide="next" href="#Carousel" class="right carousel-control">></a>
            </div><!--.Carousel-->
            @endif
            <?php /* @if(!empty($pageslider))
                <section class="sliderSection termConditionSlider">
                    <div id="restaurantSlider" class="carousel" data-ride="carousel">
                    <!-- Indicators -->
                    <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($pageslider as $key => $slider_row)
                              <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
                                <div class="carousel-caption">
                                  <a href="{{$slider_row->slider_link}}">
                                  <h1>{{$slider_row->slider_title}}</h1>
                                  <h4>{{$slider_row->slider_description}}</h4>    
                                  </a>                  
                                </div>
                              </div>
                            @endforeach
                        </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
                      <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
                    </a>
                    <a class="right carousel-control" href="#restaurantSlider" data-slide="next">
                      <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
                    </a>
                    </div>
                    <span class="scrollNextDiv"><a class="scrollpage" href="#membershpipStepSec">Scroll Down</a></span>
                </section>
            @endif */ ?>
        </div>
	               
                				
	</div>
</div>

<!-- Second Row -->
<div class="parent_my preferences">           
    <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					My Reservations
				</h3>
			</div>
		</div>
	</div> 
   
    <div class="row">
		
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
        		<div class="m-portlet__head m-portlet__head--fit bg-color">
        			<div class="m-portlet__head-caption">
        				<div class="m-portlet__head-title">
        					<h3 class="m-portlet__head-text m--font-light font-white">
        						My Reservations
        					</h3>
        				</div>
        			</div>
                    <?php 
                        
                        $latest_reservation = \DB::table('tb_reservations')->where('client_id', $logged_user->id)->orderBy('id', 'DESC')->first();
                        $arrival_day = '';
                        $arrival_month = '';
                        $arrival_year = '';
                        $departure_day = '';
                        $departure_month = '';
                        $departure_year = '';
                        if(count($latest_reservation)>0){
                            $arrival = $latest_reservation->checkin_date;
                            $arrival_day = date('j', strtotime($arrival));
                            $arrival_month = date('M', strtotime($arrival));
                            $arrival_year = date('Y', strtotime($arrival));
                            $departure = $latest_reservation->checkout_date;
                            $departure_day = date('j', strtotime($departure));
                            $departure_month = date('M', strtotime($departure));
                            $departure_year = date('Y', strtotime($departure));
                            
                            $obj_properties = \DB::table('tb_properties')->where('id', $latest_reservation->property_id)->orderBy('id', 'DESC')->first(); 
                            //print_r($obj_properties);
                            $reserved_rooms = \DB::table('td_reserved_rooms')->join('tb_properties_category_types', 'td_reserved_rooms.type_id', '=', 'tb_properties_category_types.id' )->where('reservation_id', $latest_reservation->id)->get(); 
                            //print_r($reserved_rooms);
                            $total_price = 0;
                            $reservation_price = $latest_reservation->price;                            
                            /*if(!empty($reserved_rooms)){
                                foreach($reserved_rooms as $room){
                                    $total_price += ($latest_reservation->number_of_nights * $reservation_price);
                                }
                            }*/
                            $total_price = $latest_reservation->total_price;
                            //$commission_due = $total_price * ($obj_properties->commission / 100);
                            $commission_due = $latest_reservation->total_commission;
                            $grand_total = $commission_due + $total_price;
                            $room_type_id = '';
                            $room_type = '';
                            if(!empty($reserved_rooms)){
                                $room_type= $reserved_rooms[0]->category_name;
                                
                                $room_type_id= $reserved_rooms[0]->type_id;
                            }
                            $category = \DB::table('tb_properties_category_types')->where('id', $latest_reservation->type_id)->where('status', 0)->where('show_on_booking', 1)->first();
                            
                            $category_image = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $category->property_id)->where('tb_properties_images.category_id', $latest_reservation->type_id)->where('tb_properties_images.type', 'Rooms Images')->orderBy('tb_container_files.file_sort_num', 'asc')->first();
                            
                            $imgsrc = $container->getThumbpath($category_image->folder_id);
                            
                            $img = $imgsrc.'/'.$category_image->file_name;
                            $book_again = '';
                            if($room_type_id!=''){
                                $book_again = 'book-property/'.$obj_properties->property_slug.'?property='.$obj_properties->id.'&roomType='.$room_type_id.'&arrive=&departure=&booking_adults=1&booking_children=0';
                            }
                        }
                        
                    ?>
        			<div class="m-portlet__head-tools">
        				<ul class="m-portlet__nav">
        					<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
        						<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light a_white">
        							2018
        						</a>
        						<div class="m-dropdown__wrapper" style="display: none;">
        							<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        							<div class="m-dropdown__inner">
        								<div class="m-dropdown__body">
        									<div class="m-dropdown__content">
        										<ul class="m-nav">
        											<li class="m-nav__section m-nav__section--first">
        												<span class="m-nav__section-text">
        													Reports
        												</span>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-share"></i>
        													<span class="m-nav__link-text">
        														Activity
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-chat-1"></i>
        													<span class="m-nav__link-text">
        														Messages
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-info"></i>
        													<span class="m-nav__link-text">
        														FAQ
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
        													<span class="m-nav__link-text">
        														Support
        													</span>
        												</a>
        											</li>
        										</ul>
        									</div>
        								</div>
        							</div>
        						</div>
        					</li>
        				</ul>
        			</div>
        		</div>
        		<div class="m-portlet__body">
        			<div class="m-widget28">
        				
                        <?php if(isset($latest_reservation) && !empty($latest_reservation)){ ?>
                        <div class="m-widget28__pic m-portlet-fit--sides" style="background: url('{{$img}}'); background-size: cover;">
                            <div class="overlay"></div>
                        </div>
        				<div class="m-widget28__container">
        					<!-- begin::Nav pills -->
        					<ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Book Again</div>
        							<a class="nav-link a_white dash-res-view" href="{{ Url::to($book_again) }}">
        								View
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Arrival</div>
        							<a class="nav-link a_white" data-toggle="pill" href="#menu21">
        								<span class="day_size_big">{{$arrival_day}}</span> {{$arrival_month}} {{$arrival_year}}
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Departure</div>
        							<a class="nav-link a_white" data-toggle="pill" href="#menu31">
        								<span class="day_size_big">{{$departure_day}}</span> {{$departure_month}} {{$departure_year}}
        							</a>
        						</li>
        					</ul>
        					<!-- end::Nav pills --> 
                            <!-- begin::Tab Content -->
                            <?php if(!empty($obj_properties)){ ?>
        					<div class="m-widget28__tab tab-content">
        						<div id="menu11" class="m-widget28__tab-container tab-pane active">
        							<div class="m-widget28__tab-items">                                        
        								<div class="m-widget28__tab-item">
        									<span>
        										Hotel Name
        									</span>
        									<span>
        										{{ $obj_properties->property_name }} / {{ $room_type }}
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Booking Confirmation Number
        									</span>
        									<span>
        										DL-<?php echo date('d.m.y', strtotime($latest_reservation->created_date)); ?>-{{ $latest_reservation->id }}
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Total Charges
        									</span>
        									<span>
        										&euro;{{ $grand_total }}
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Hotel Terms
        									</span>
        									<span>
        										<a href="#" data-toggle="modal" data-target="#hotel_term_popup"> Show hotel terms</a> 
        									</span>
                                            <a href="{{Url::to('traveller/bookings')}}" id="show_more">Show More</a>
        								</div>
        							</div>
        						</div>
        					</div>
                            <?php } ?>
                        </div>
        					<!-- end::Tab Content -->
                            <?php } else { ?>
                                <div class="m-widget28__pic m-portlet-fit--sides" style="background: url('https://emporium-voyage.com/images/hotel_reservation.jpg'); background-size: cover;">
                                    <div class="overlay"></div>
                                </div>
                				<div class="m-widget28__container">    
            					<!-- begin::Nav pills -->
            					<ul class="m-widget28__nav-items nav nav-pills nav-fill ul_width" role="tablist">
            						<li class="m-widget28__nav-item nav-item">
                                        <div class="top-heading">Book Again</div>
            							<a href="{{Url::to('/')}}" class="nav-link a_white dash-res-view">
            								View
            							</a>
            						</li>
            					</ul>
            					<!-- end::Nav pills --> 
                                <!-- begin::Tab Content -->
                                
            					<div class="m-widget28__tab tab-content">
            						<div id="menu11" class="m-widget28__tab-container tab-pane active">
            							<div class="m-widget28__tab-items">                                        
            								<div class="m-widget28__tab-item">
            									<span>
            										
            									</span>
            									<span>
            										
            									</span>
            								</div>
            								<div class="m-widget28__tab-item">
            									<span>
            										
            									</span>
            									<span>
            										
            									</span>
            								</div>
            								<div class="m-widget28__tab-item">
            									<span>
            										
            									</span>
            									<span>
            										
            									</span>
            								</div>
            								
            							</div>
            						</div>
            					</div>
                                                            
                            </div>
                            <?php } ?>
        				
        			</div>
        		</div>
         	</div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
        		<div class="m-portlet__head m-portlet__head--fit bg-color">
        			<div class="m-portlet__head-caption">
        				<div class="m-portlet__head-title">
        					<h3 class="m-portlet__head-text m--font-light font-white">
        						Event Reservations
        					</h3>
        				</div>
        			</div>
        			<div class="m-portlet__head-tools">
        				<ul class="m-portlet__nav">
        					<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
        						<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light">
        							2018
        						</a>
        						<div class="m-dropdown__wrapper" style="display: none;">
        							<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        							<div class="m-dropdown__inner">
        								<div class="m-dropdown__body">
        									<div class="m-dropdown__content">
        										<ul class="m-nav">
        											<li class="m-nav__section m-nav__section--first">
        												<span class="m-nav__section-text">
        													Reports
        												</span>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-share"></i>
        													<span class="m-nav__link-text">
        														Activity
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-chat-1"></i>
        													<span class="m-nav__link-text">
        														Messages
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-info"></i>
        													<span class="m-nav__link-text">
        														FAQ
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
        													<span class="m-nav__link-text">
        														Support
        													</span>
        												</a>
        											</li>
        										</ul>
        									</div>
        								</div>
        							</div>
        						</div>
        					</li>
        				</ul>
        			</div>
        		</div>
        		<div class="m-portlet__body">
        			<div class="m-widget28">
        				<div class="m-widget28__pic m-portlet-fit--sides" style="background: url('{{Url::to('images/event_reservation.jpg')}}'); background-size: cover;"></div>
        				<div class="m-widget28__container">
                        
        					<!-- begin::Nav pills -->
        					<ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Book Again</div>
        							<a class="nav-link a_white dash-res-view" data-toggle="pill" href="#menu11">
        								View
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Start Date</div>
        							<a class="nav-link" data-toggle="pill" href="#menu21">
        								<span class="day_size_big">15</span> Aug 2018
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">End Date</div>
        							<a class="nav-link" data-toggle="pill" href="#menu31">
        								<span class="day_size_big">25</span> Aug 2018
        							</a>
        						</li>
        					</ul>
        					<!-- end::Nav pills --> 
                            <!-- begin::Tab Content -->
        					<div class="m-widget28__tab tab-content">
        						<div id="menu11" class="m-widget28__tab-container tab-pane active">
        							<div class="m-widget28__tab-items">                                        
        								<div class="m-widget28__tab-item">
        									<span>
        										Event Name
        									</span>
        									<span>
        										Studio Munich / Room Name
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Booking Confirmation Number
        									</span>
        									<span>
        										D330-1234562546
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Total Charges
        									</span>
        									<span>
        										USD 1,250.000
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Event Terms
        									</span>
        									<span>
        										Show Event Terms 
        									</span>
                                            
                                            <a href="#" id="show_more_event_terms">Show More</a>
        								</div>
        							</div>
        						</div>
        					</div>
        					<!-- end::Tab Content -->
                            
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text m--font-light">
								My Preferences
							</h3>
						</div>
					</div>
					<div class="m-portlet__head-tools" style="display: none;">
						<ul class="m-portlet__nav">
							<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
								<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
									<i class="fa fa-genderless m--font-light"></i>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav">
													<li class="m-nav__section m-nav__section--first">
														<span class="m-nav__section-text">
															Quick Actions
														</span>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-share"></i>
															<span class="m-nav__link-text">
																Activity
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-chat-1"></i>
															<span class="m-nav__link-text">
																Messages
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-info"></i>
															<span class="m-nav__link-text">
																FAQ
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-lifebuoy"></i>
															<span class="m-nav__link-text">
																Support
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
															Cancel
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="m-portlet__body">
					<div class="m-widget17">
						<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
							<div class="m-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
								<canvas id="m_chart_activities" width="325" height="216" class="chartjs-render-monitor" style="display: block; width: 325px; height: 216px;"></canvas>
							</div>
						</div>
						<div class="m-widget17__stats">
							<div class="m-widget17__items m-widget17__items-col1">
								<div class="m-widget17__item">
									<span class="m-widget17__icon">
										
									</span>
									<span class="m-widget17__subtitle">
										<a href="#" class="cls_preferences_1" >Preferences 1</a>
									</span>
									<span class="m-widget17__desc">
										
									</span>
								</div>
							</div>
							<div class="m-widget17__items m-widget17__items-col2">
								<div class="m-widget17__item">
                                    <span class="m-widget17__icon">
										
									</span>
                                    <span class="m-widget17__subtitle" style="text-align: center;">
    									   <i class="la la-plus"></i>
									</span>  
                                    <span class="m-widget17__desc">
                                    </span>                                  
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
        
    </div>
</div>
<!-- End Row -->    

<!-- Third Row -->   

<div class="parent_reservation_ans_distribution">
   <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					My Settings
				</h3>
			</div>
		</div>
	</div> 
    
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xl-12">
            
            <div class="row" style="margin: 0px;">
                <div class="trav-dash-setting-box1">
                    <a href="{{ URL::to('user/profile') }}">
                        <i class="grid_icon flaticon-profile-1"></i>																	
            			<span class="grid_link-text">
            				My Profile
            			</span>
            		</a>
                </div>
                <div class="trav-dash-setting-box2">
                    <a href="{{ URL::to('user/preferences')}}">
            			<i class="grid_icon flaticon-interface-6"></i>																	
            			<span class="grid_link-text">
            				My Preferences
            			</span>
            		</a>
                </div>
                <div class="trav-dash-setting-box3">
                    <a href="{{ URL::to('user/settings') }}">
                        <i class="grid_icon flaticon-settings-1"></i>																	
            			<span class="grid_link-text">
            				Account Settings
            			</span>
            		</a>
                </div>
                <div class="trav-dash-setting-box4">
                    <a href="{{ URL::to('user/invite')}}">
            			<i class="grid_icon flaticon-mail-1"></i>																	
            			<span class="grid_link-text">
            				Guest Invitations
            			</span>
            		</a>
                </div>
                <div class="trav-dash-setting-box5">
                    <a href="#" id="dash_communication">
            			<i class="grid_icon flaticon-computer"></i>																	
            			<span class="grid_link-text">
            				Communication
            			</span>
            		</a>
                </div>
                <div class="trav-dash-setting-box6">
                    <a href="{{ URL::to('user/companion')}}">
            			<i class="grid_icon flaticon-users"></i>																	
            			<span class="grid_link-text">
            				Companions
            			</span>
            		</a>
                </div>                
                <div class="trav-dash-setting-box7">
                    <a href="{{URL::to('user/security')}}" id="dash_communication">
            			<i class="grid_icon flaticon-lock-1"></i>																	
            			<span class="grid_link-text">
            				Security &amp; Privacy
            			</span>
            		</a>
                </div>
                <div class="trav-dash-setting-box8">
                    <a href="{{ URL::to('traveller/invoices')}}">
            			<i class="grid_icon flaticon-diagram"></i>																	
            			<span class="grid_link-text">
            				Billings &amp; Contracts
            			</span>
            		</a>
                </div>     
                
            </div>
        </div>
    </div>
</div>

<!-- End Third Row -->

<!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="hotel_term_popup" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="viewModalLabel">
    					Hotel Terms
    				</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        <ul>
                            <li>
                                I have read the <a href="{{Url::to('privacy-policy')}}">Privacy Policy</a>. <span class="font-italic">I agree that my personal data will be collected and stored electronically and used electronically to make this reservation with emporium-voyage and the respective partner hotel.</span>
                                <div class="m--clearfix"></div>
                                <span class="font-italic" style="clear: both;">Note: You may revoke your consent at any time by e-mail to <a href="mailto:info@emporium-voyage.com">info@emporium-voyage.com</a> or from your settings section in your account admin.</span>
                            </li>
                            <li>
                                <span class="font-italic">I agree to receive booking confirmations via email or phone and acknowledge that i can change my communication methods from my personal account preferences.</span>
                            </li>
                            <li>
                                <span class="font-italic">I agree to the emporium-voyage&trade;  <a href="{{Url::to('terms-and-conditions')}}">terms and conditions</a> pertaining to the reservation.</span>
                            </li>
                        </ul>
                    </div>                				
    			</div>
    			<div class="modal-footer">  
                    <button type="button" class="btn btn-secondary" id="viewclosebtn" data-dismiss="modal">Close</button>                    
    			</div>
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up--> 

@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/css/custom.css') }}" rel="stylesheet">
    <style>
        .bg-color{
            background: rgba(0,0,0,.3);  
        }
        .font-white{
            color: #ffffff !important;
        }
        .pad-margin-left{
            padding: 0px;
            margin-left: 15px;
        }
    .carousel {
  position: relative;
}

.carousel-inner {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.carousel-inner > .item {
  position: relative;
  display: none;
  -webkit-transition: 0.6s ease-in-out left;
          transition: 0.6s ease-in-out left;
}

.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
  display: block;
  height: auto;
  max-width: 100%;
  line-height: 1;
}

.carousel-inner > .active,
.carousel-inner > .next,
.carousel-inner > .prev {
  display: block;
}

.carousel-inner > .active {
  left: 0;
}

.carousel-inner > .next,
.carousel-inner > .prev {
  position: absolute;
  top: 0;
  width: 100%;
}

.carousel-inner > .next {
  left: 100%;
}

.carousel-inner > .prev {
  left: -100%;
}

.carousel-inner > .next.left,
.carousel-inner > .prev.right {
  left: 0;
}

.carousel-inner > .active.left {
  left: -100%;
}

.carousel-inner > .active.right {
  left: 100%;
}

.carousel-control {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 15%;
  font-size: 20px;
  color: #ffffff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  opacity: 0.5;
  filter: alpha(opacity=50);
}

.carousel-control.left {
  background-image: -webkit-gradient(linear, 0 top, 100% top, from(rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.0001)));
  background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.5) 0), color-stop(rgba(0, 0, 0, 0.0001) 100%));
  background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
}

.carousel-control.right {
  right: 0;
  left: auto;
  background-image: -webkit-gradient(linear, 0 top, 100% top, from(rgba(0, 0, 0, 0.0001)), to(rgba(0, 0, 0, 0.5)));
  background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.0001) 0), color-stop(rgba(0, 0, 0, 0.5) 100%));
  background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
}

.carousel-control:hover,
.carousel-control:focus {
  color: #ffffff;
  text-decoration: none;
  opacity: 0.9;
  filter: alpha(opacity=90);
}

.carousel-control .icon-prev,
.carousel-control .icon-next,
.carousel-control .glyphicon-chevron-left,
.carousel-control .glyphicon-chevron-right {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 5;
  display: inline-block;
}

.carousel-control .icon-prev,
.carousel-control .icon-next {
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
  font-family: serif;
}

.carousel-control .icon-prev:before {
  content: '\2039';
}

.carousel-control .icon-next:before {
  content: '\203a';
}

.carousel-indicators {
  position: absolute;
  bottom: 10px;
  left: 50%;
  z-index: 15;
  width: 60%;
  padding-left: 0;
  margin-left: -30%;
  text-align: center;
  list-style: none;
}

.carousel-indicators li {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 1px;
  text-indent: -999px;
  cursor: pointer;
  border: 1px solid #ffffff;
  border-radius: 10px;
}

.carousel-indicators .active {
  width: 12px;
  height: 12px;
  margin: 0;
  background-color: #ffffff;
}

.carousel-caption {
  position: absolute;
  right: 15%;
  bottom: 20px;
  left: 15%;
  z-index: 10;
  padding-top: 20px;
  padding-bottom: 20px;
  color: #ffffff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
}

.carousel-caption .btn {
  text-shadow: none;
}

.rad-carousel{
        position: relative;
    }
    .rad-carousel-inner {      
      position: relative;
      /*height:680px;*/
      width: 100%;
      overflow: hidden;
    }
    
    .rad-carousel-inner > .item {
      /*position: absolute;
      height:400px;*/
      display: none;
      
    }
    
    .rad-carousel-inner > .item > img,
    .rad-carousel-inner > .item > a > img {
      display: block;
      height: auto;
      max-width: 100%;
      line-height: 1;
    }
    
    .m-content>div:nth-child(even) .row{
        padding: 0px 0px !important;
    }
    .m-content>div:nth-child(even) .row {
        margin: 0px;
    }
    .rad-carousel .carousel-control{
        top: 25% !important;
    }

@media screen and (min-width: 768px) {
  .carousel-control .icon-prev,
  .carousel-control .icon-next {
    width: 30px;
    height: 30px;
    margin-top: -15px;
    margin-left: -15px;
    font-size: 30px;
  }
  .carousel-caption {
    right: 20%;
    left: 20%;
    padding-bottom: 30px;
  }
  .carousel-indicators {
    bottom: 20px;
  }
}
    .carousel-control {
        position: absolute;
    }
    .scrollNextDiv {
        position: absolute;
        bottom: 60px;
        left: 61%;
        text-decoration: none;
        text-transform: uppercase;
        animation-fill-mode: none;
        animation-duration: unset;                
    }
    .carousel-caption a{
        text-decoration: none;
    }
    .carousel-caption a{
        text-decoration: none;
    }
    .carousel-caption a h4{        
        color: #ABA07C;
    }
    .m-widget2 .m-widget2__item .m-widget2__desc{
        vertical-align: middle !important;
    }
    .m-task-link{ text-decoration: none; color: #575962;}
    .m-task-link:hover{ text-decoration: none; color: #575962;}
    
    .m-widget7 .m-widget7__user .m-widget7__user-img .m-widget7__img{
        margin-top: 0rem;
    }
    .m-widget7 .m-widget7__user{
        margin-bottom: 2rem;
    }
    .m-widget7 .m-widget7__desc{
        margin-top: 2rem;
        margin-bottom: 3em;
    }
    .m-subheader-search{
        margin-top: 20px;
    }
    .m-widget7 .m-widget7__user .m-widget7__user-img .m-widget7__img{
        width: 4.9rem;
    }
    .m-nav-grid>.m-nav-grid__row>.m-nav-grid__item{
        padding: .75rem .75rem;
    }
    
.carousel {
    margin-bottom: 0;
    /*padding: 0 40px 30px 40px;*/
}
/* The controlsy */
.carousel-control {
	left: 30px;
    height: 40px;
	width: 40px;
    background: none repeat scroll 0 0 #222222;
    border: 4px solid #FFFFFF;
    border-radius: 23px 23px 23px 23px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
}
.carousel-control.right {
	right: 30px;
}
/* The indicators */
.carousel-indicators {
	right: 50%;
	top: auto;
	bottom: -10px;
	margin-right: -19px;
    display: none;
}
/* The colour of the indicators */
.carousel-indicators li {
	background: #cecece;
}
.carousel-indicators .active {
background: #428bca;
}

/* t-date picker  */
.search-cal-top .t-dates{
    background: #f2f2f2;
    color: #898b96;
    padding: 9px 15px;
    height: 39px;
    box-sizing: border-box;
    border: 1px solid #898b96;
    border-radius: 3px;
}
.search-cal-top .t-check-in{
   width: 45% !important;
   margin-right: 17px;
}
.search-cal-top .t-check-out{
   width: 45% !important;
}
.form-control-height{
    height: 39px !important;
}
.ui-widget.ui-widget-content {
    padding: 0px;
    max-width: 350px;
}
/* End */
    </style>
@endsection

{{-- For custom style  --}}
@section('custom_js_script')
    @parent   
    <script type="text/javascript">var BaseURL = '{{ url() }}'; </script>
    <script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom/do_ajax.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom/common.js') }}"></script>
    <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>   
    <script>
        $(document).ready(function(){
            // settings
            var $slider2 = $('#b2cblog_carousel .rad-carousel-inner'); // class or id of carousel slider
            var $slide2 = '.item'; // could also use 'img' if you're not using a ul
            var $transition_time2 = 1000; // 1 second
            var $time_between_slides2 = 4000; // 4 seconds
            
            function slides2(){
            return $slider2.find($slide2);
            }
            
            slides2().fadeOut();
            
            // set active classes
            slides2().first().addClass('active');
            slides2().first().fadeIn($transition_time2);
            
            // auto scroll 
            $interval = setInterval( 
                function(){
                    if(slides2().length > 1){
                      var $i = $slider2.find($slide2 + '.active').index();
                                          
                      slides2().eq($i).removeClass('active');
                      slides2().eq($i).fadeOut(0);
                    
                      if (slides2().length == $i + 1) $i = -1; // loop to start
                    
                      slides2().eq($i + 1).fadeIn($transition_time2);
                      slides2().eq($i + 1).addClass('active');
                      }
                }
                , $transition_time2 +  $time_between_slides2
            );
            
            
            $("#b2cblog_carousel .left").click(function(){
                var $i = $slider2.find($slide2 + '.active').index();
                if($i - 1 >= 0){ 
                  slides2().eq($i).removeClass('active');
                  slides2().eq($i).fadeOut($transition_time2);                  
                  slides2().eq($i - 1).fadeIn($transition_time2);
                  slides2().eq($i - 1).addClass('active');
                }
            });
            
            $("#b2cblog_carousel .right").click(function(){
                var $i = $slider2.find($slide2 + '.active').index();
                if($i + 1 < slides2().length){ 
                  slides2().eq($i).removeClass('active');
                  slides2().eq($i).fadeOut($transition_time2);
                  slides2().eq($i + 1).fadeIn($transition_time2);
                  slides2().eq($i + 1).addClass('active');
                }
            }); 
            
            $("#dash_communication").click(function(){
                $(".m-topbar__nav #m_quick_sidebar_toggle").trigger('click');
                $('#m_quick_sidebar_tabs [href="#m_quick_sidebar_tabs_messenger"]').trigger('click');
            });
            $('#Carousel').carousel({
                interval: 5000
            })
            
            $('#t-topbar-picker').tDatePicker({
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
                'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
            }).on('afterCheckOut',function(e, dateCO) {
                if(((typeof $(this).closest('form').find('[name="adult"]').val()) != 'undefined') && ((typeof $(this).closest('form').find('[name="adult"]').val()) != undefined)){
                    $(this).closest('form').find('[name="adult"]').focus();
                }
            });

            /*$(".cls_preferences_1").click(function(e){
                e.preventDefault();                
                window.location.href = "{{Url::to('user/profile')}}";
                $("#tab_preferences").trigger('click');
            });*/
        });
    </script>
@endsection
@section('script')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
    <script src="{{ asset('metronic/assets/app/js/charts.js') }}"></script>    
@stop