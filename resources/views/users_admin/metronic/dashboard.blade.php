@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
@stop
    
@section('subheader_search')
    <div class="m-subheader-search">
        <h2 class="m-subheader-search__title">
    		Recent Bookings
    		<span class="m-subheader-search__desc">
    			Quick Reservation Search
    		</span>
    	</h2>
    	<form class="m-form">
    		<div class="m-grid m-grid--ver-desktop m-grid--desktop">
    			<div class="m-grid__item m-grid__item--middle">
    				<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
    					<input type="text" class="form-control" placeholder="Booking Number">    					
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
    			</div>
    			<div class="m-grid__item m-grid__item--middle search-btn-top-margin">
    				<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
    				<button type="button" class="btn m-btn--pill m-subheader-search__submit-btn">
    					Search Bookings rrrrr
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
    <!--Begin::Section_portlet-->
    <div class="parent_hotel_name">
        <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title m-subheader__title--separator">
						{{$hotel_name}}
					</h3>
				</div>
			</div>
		</div>
        
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
                            if(strpos($ext_url, 'http://') !== 0) {
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
			</div>
            
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="dashboard-right-top">
                    @if(!empty($pageslider))
                        <div id="b2cdash_carousel" class="carousel slide">
                             
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
                              <!--<a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
                              <a data-slide="next" href="#Carousel" class="right carousel-control">></a>-->
                        </div><!--.Carousel-->
                    @endif
                </div>
                <div class="dashboard-right-bottom">
                    <div class="row" style="margin-left: 0px;">
                        <div class="setting-box-advert1">
                            <a href="{{ URL::to('properties') }}">
                                <i class="grid_icon flaticon-imac"></i>																	
                    			<span class="grid_link-text">
                    				Property Management
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert2">
                            <a href="{{ URL::to('reservations') }}">
                                <i class="grid_icon flaticon-graphic-2"></i>																	
                    			<span class="grid_link-text">
                    				Reservation Management
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert3">
                            <a href="{{ URL::to('hotelcontainer')}}">
                    			<i class="grid_icon flaticon-layers"></i>																	
                    			<span class="grid_link-text">
                    				Digital Media Management & Distribution System
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert4">
                            <a href="{{ URL::to('hotelpackages') }}" id="dash_communication">
                    			<i class="grid_icon flaticon-share"></i>																	
                    			<span class="grid_link-text">
                    				Membership &amp; Support Services
                    			</span>
                    		</a>
                        </div>
                        
                        
                        <div class="setting-box-advert5">
                            <a href="{{URL::to('arrivaldeparture')}}">
                                <i class="grid_icon flaticon-clock-2"></i>																	
                    			<span class="grid_link-text">
                    				Arrivals, Departures &amp; Cancelations
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert6">
                            <a href="{{URL::to('advertising')}}">
                                <i class="grid_icon flaticon-statistics"></i>																	
                    			<span class="grid_link-text">
                    				Advertising
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert7">
                            <a href="{{URL::to('salesreport')}}">
                    			<i class="grid_icon flaticon-graph"></i>																	
                    			<span class="grid_link-text">
                    				Sales Reports
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert8">
                            <a href="{{URL::to('qualityassurances')}}" id="dash_communication">
                    			<i class="grid_icon flaticon-pie-chart"></i>																	
                    			<span class="grid_link-text">
                    				Quality Assurance
                    			</span>
                    		</a>
                        </div>
                        
                    </div>
                </div>
            </div> 
                           		
		</div>
    </div>
	
	<!--End::Section_portlet-->
    <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="agree_model" tabindex="-1" role="dialog" aria-labelledby="agreeModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Privacy & Data Protection
    				</h5>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height" style="padding: 0px; margin-bottom: 0px;">
                        
                        <form class="m-form">
                        <div class="m-portlet__body" style="padding: 0px;">
                            
                            <div class="col-sm-12 col-md-12">
                                <div class="b2c-banner-text">Welcome</div>
               					<img src="{{URL::to('images/hotel_pop_up_terms.jpg')}}" style="width: 100%;" />
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">Welcome to emporium-voyage</h2>
                            </div> 
                            <div class="col-sm-12 col-md-12">                                
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.</p>
                            </div>
                            <div>
                                <hr />
                            </div>
                            <div class="form-group pref-left-pad-10"> 
                                <div class="m-checkbox-list"> 
									<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="agree" id="agree" value="1" />
										I Agree to the Emporium-Voyage Privacy & Data Protection Policy
										<span></span>
									</label>
								</div>
                                <div class="error" id="error" style="display: none;">
                                    Please agree to the Privacy & Data Protection Policy.
                                </div>
                                <span class="m-form__help">
									 I agree that my personal data will be collected and stored and used electronically to help the reservation agents with specialized offers pertaining to my travel preferences. 
Note: You may revoke your consent at any time by e-mail to info@emporium-voyage.com or from your settings section in your account admin.
								</span>                                                                            
                            </div>
                            <div class="form-group pref-left-pad-10">
                                <div class="m-checkbox-list">
									<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="privacy_policy" id="privacy_policy" value="1" />
										<a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Emporium-Voyage Privacy Policy</a>
										<span></span>
									</label>
                                </div>
                                <div class="error" id="privacy_policy_error" style="display: none;">
                                    Please check privacy policy checkbox.
                                </div>
                                <span class="m-form__help">
									I have read and agree to the Emporium-Voyage Privacy Policy.
								</span>
                             </div>            
							 <div class="form-group pref-left-pad-10">
                                <div class="m-checkbox-list">
                                	<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="cookie_policy" id="cookie_policy" value="1" />
										<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
										<span></span>
									</label>
                                </div>
                                <div class="error" id="cookie_policy_error" style="display: none;">
                                    Please check cookie policy checkbox.
                                </div>
                                <span class="m-form__help">
									I have read and agree to the Emporium-Voyage Cookie Policy
								</span>
                             </div>
                        </div>
                        </form>
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-primary" id="contractacceptbtn">Accept</button>
    			</div>
    		</div>
    	</div>
    </div>    
    <!--end: modal pop up-->
    <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="confirm_model" tabindex="-1" role="dialog" aria-labelledby="agreeModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Confirm
    				</h5>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height" style="padding: 0px; margin-bottom: 0px;">
                        
                        <form class="m-form">
                        <div class="m-portlet__body" style="padding: 0px;">
                            <div class="form-group m--align-center">
                                Welcome back !You have not completed the hotel setup yet.
                            </div>
                            <div class="form-group m--align-center">
                                Please continue your Hotel Setup to start taking reservations.
                             </div>            
							 
                        </div>
                        </form>
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-primary" id="yeshotelsetupbtn">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
    			</div>
    		</div>
    	</div>
    </div>    
    <!--end: modal pop up-->  
    <!-- Reservation model -->
    <div class="modal fade" id="reservationsmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
    	<div class="modal-content">
    	  <div class="modal-header">
            <h5 class="modal-title" id="guesttitle">Booked Details</h5>
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	  </div>
          
          <div class="modal-body">
            <div class="m-portlet m-portlet--full-height" style="padding: 0px; margin-bottom: 0px;">
                <form class="m-form">
                    <div class="m-portlet__body" style="padding: 0px;">
                        <div id="bookingdetailbody">
    		
    	                </div>
                    </div>
                </form>
            </div>
          </div>
          
    	  
    	</div>
      </div>
    </div> 
    <!-- End reservation model -->
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/css/custom.css') }}" rel="stylesheet">
    <style>
    	.cursor{cursor:col-resize;}
    	.selectedCell{background:pink;}
        .BookedCell{background:pink; cursor: pointer; }
        .selectedCell span{ cursor: pointer; }
    	.optionbox {
    		-moz-user-select: none;
    		-webkit-user-select: none;
    		-ms-user-select: none;
    		padding: 8px;
    		cursor: pointer;
    		background-color: #eee;
    		border-radius: 3px;
    		border: 1px solid #dadada;
    		line-height: 18px;
    		display: inline-block;
    	}
        .m-content>div:nth-child(even) .row {
            background: none !important;
            padding: 10px 15px;
        }
    </style>
    <style>
    
    .carousel {
      position: relative;
    }
    
    .carousel-inner {
      position: relative;
      width: 100%;
      /*height:400px;*/
      overflow: hidden;
    }
    
    .carousel-inner > .item {      
      /*position: absolute;
      height:400px;*/
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
        /*margin-top: 20px;*/
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
    
    .carousel-control2 {
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
    .carousel-control2.right {
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
    /* t-date picker  */
    .search-cal-top .t-dates{
        background: #eee7e1;
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
    .t-check-in .t-date-info-title{
        left: 38px;
    }
    .t-check-out .t-date-info-title{
        left: 38px;
    }
    @media (max-width:1024px) {    
        .rad-carousel{
            margin-bottom: 30px;
        }
    }
    
/* End */
    </style>
@endsection

{{-- For custom style  --}}
@section('custom_js_script')
    @parent      
    <script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
    <script>
        $(document).ready(function(){
            <?php if($logged_user->i_agree == 0 || $logged_user->privacy_policy == 0 || $logged_user->cookie_policy == 0){ ?>
                    $("#agree_model").modal({backdrop: 'static', keyboard: false}, 'show');
            <?php }else if($logged_user->new_user == 1){ ?>
                    window.location.href = "{{URL::to('whoiam')}}";
            <?php }/*else if($logged_user->hotel_setup_complete == 0){ ?>
                    $("#confirm_model").modal({backdrop: 'static', keyboard: false}, 'show');
            <?php }*/ ?>
            
            $("#yeshotelsetupbtn").click(function(){
                <?php if($logged_user->property_info_setup == 0){ if($pid > 0){ ?>
                        
                        window.location.href = "{{URL::to('properties/update/'.$pid)}}";
                        
                <?php } }else{ ?>
                        window.location.href = "{{URL::to('properties_settings/'.$pid.'/types')}}";
                <?php } ?>
            });
            
            $("#contractacceptbtn").click(function(){
                var error = true;
                var agree = 0;
                var privacy_policy = 0;
                var cookie_policy = 0;
                if($("#agree").is(":checked")){
                    agree = $("#agree").val();
                    $("#error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#error").css("display", "");
                }
                if($("#privacy_policy").is(":checked")){
                    privacy_policy = $("#privacy_policy").val();
                    $("#privacy_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#privacy_policy_error").css("display", "");
                }
                if($("#cookie_policy").is(":checked")){
                    cookie_policy = $("#cookie_policy").val();
                    $("#cookie_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#cookie_policy_error").css("display", "");
                }
                
                
                if(error){ 
                    
                }else{
                    var fdata = new FormData();                
                    fdata.append("_token",$("input[name=_token]").val());                    
                    
                    fdata.append("agree", agree); 
                    fdata.append("privacy_policy", privacy_policy);
                    fdata.append("cookie_policy", cookie_policy);
                    
                    $.ajax({
                        url:"{{URL::to('user/iagree')}}",
                        type:'POST',
                        dataType:'json',
                        contentType: false,
                        processData: false,
                        data:fdata,
                        headers: {
                            'Access-Control-Allow-Origin': '*'
                        },
                        success:function(response){
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                $("#agree_model").modal('hide');
                                window.location.href = "{{URL::to('whoiam')}}";
                            }
                            else{
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
            
            // settings
              var $slider = $('#b2cdash_carousel .carousel-inner'); // class or id of carousel slider
              var $slide = '.item'; // could also use 'img' if you're not using a ul
              var $transition_time = 1000; // 1 second
              var $time_between_slides = 4000; // 4 seconds
            
              function slides(){
                return $slider.find($slide);
              }
            
              slides().fadeOut();
            
              // set active classes
              slides().first().addClass('active');
              slides().first().fadeIn($transition_time);
            
              // auto scroll 
              $interval = setInterval( 
                function(){
                if(slides().length > 1){
                  var $i = $slider.find($slide + '.active').index();
                                      
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut(0);
            
                  if (slides().length == $i + 1) $i = -1; // loop to start
            
                  slides().eq($i + 1).fadeIn($transition_time);
                  slides().eq($i + 1).addClass('active');
                  }
                }
                , $transition_time +  $time_between_slides 
              );
            
            
            $("#b2cdash_carousel .left").click(function(){
                var $i = $slider.find($slide + '.active').index();
                if($i - 1 >= 0){ 
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);                  
                  slides().eq($i - 1).fadeIn($transition_time);
                  slides().eq($i - 1).addClass('active');
                }
            });
            
            $("#b2cdash_carousel .right").click(function(){
                var $i = $slider.find($slide + '.active').index();
                if($i + 1 < slides().length){ 
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);
                  slides().eq($i + 1).fadeIn($transition_time);
                  slides().eq($i + 1).addClass('active');
                }
            });
            
            
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
            arrival_depart();
            $(".m_tab1_content").click(function(){
                $(".m_tab1_content").removeClass('active');
                $(this).addClass('active');
                arrival_depart();
            });
            function arrival_depart(){
                //$obj = $(".m_tab1_content.active");
                var reportfor = $(".m_tab1_content.active").attr('data-reportfor');
                var arrival_departure = $("#dd_arrival_departure").val();
                //console.log($obj);
                $.ajax({
                    url:"{{URL::to('user_arrival_departure')}}",
                    type:'POST',
                    dataType:'json',
                    data:{'reportfor':reportfor, 'arrival_departure':arrival_departure}, 
                    beforeSend: function() {
                      $("#table_data").html('<tr class="m--align-center"><td colspan="5"><div class="m-loader m-loader--brand"></div></td></tr>');
                    },                   
                    success:function(response){
                        var html = '';
                        $("#table_data").html('');
                        if(response.status == 'success'){
                            
                            var reservations = response.reservations;
                            if(reservations.length > 0){
                                $.each(reservations, function(key, val){
                                    console.log(val);
                                     
                                    html += '<tr><td>'+val.first_name+' '+val.last_name+'</td><td class="m--align-center">'+val.total_adults+'</td><td class="m--align-center">'+val.total_child+'</td><td class="m--align-right m--font-brand">'+val.checkin_date+'</td><td class="m--align-right m--font-brand">'+val.checkout_date+'</td></tr>';													
								});	
                                			
                            }else{
                                html += '<tr class="m--align-center"><td colspan="5">Currently no record found</td></tr>';													
								
                            }
                            $("#table_data").html(html);
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });
            }
            
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
            
        }); 
        
        
        
    </script>
@endsection
@section('script')
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
