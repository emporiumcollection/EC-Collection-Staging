<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> {{ $pageTitle}} | {{ CNF_APPNAME }}</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

        <!--Style Includes-->
        
        <!-- AIC css add -->
        
        <link href="{{ asset('sximo/assets/css/menu41e7.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/responsive.custom41e7.css')}}" rel="stylesheet" type="text/css"/>
        
        <link href="{{ asset('sximo/assets/css/style-ai.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/homepage41e7.css')}}" rel="stylesheet" type="text/css"/>
        <!-- AIc css end-->

        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}" rel="stylesheet">
        <link href="{{ asset('sximo/assets/css/test-res.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/sticky-nav.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery2.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/uikit.js')}}"></script>
        
        <!--AIC sidebar js -->
<!--        <script src="{{ asset('sximo/assets/js/jquery_1.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/custm.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/TweenMax.min41e7.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/menu41e7.js')}}" type="text/javascript"></script>-->

        <!--JS Includes-->

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/sticky-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/active-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/html2canvas.js')}}" type="text/javascript"></script>
       

        <!--Filters Grid Page-->
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/cities-filter.css')}}" rel="stylesheet" type="text/css"/>
<!--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
		
		
           @if(isset($_GET['ref']) && $_GET['ref']=='oc' )
            <?php $thumbnail = asset('sximo/assets/images/our_collection.png'); ?>
           @elseif(isset($_GET['ref']) && $_GET['ref']=='syd' )
            <?php $thumbnail =  asset('sximo/assets/images/select_your_destination.png'); ?>
           @elseif(isset($_GET['ref']) && $_GET['ref']=='sye' )
             <?php $thumbnail = asset('sximo/assets/images/selec_your_exprince.png'); ?>
           @elseif(isset($_GET['ref']) && $_GET['ref']=='sbd' )
            <?php $thumbnail = asset('sximo/assets/images/search_by.png'); ?>
           @else
            <?php $thumbnail = asset('sximo/assets/images/search_by.png'); ?>
           @endif 
         @if(isset($_GET['ref']))
        <script>
            jQuery(document).ready(function($) {
               // $("#back_button_page").tooltip({ content: '<img src="{{$thumbnail}}"/>' });
                $(document).on('click','#back_button_page',function(){
                    location.href = "{{url('/')}}?ref={{$_GET['ref']}}";
                    return fasle;
                });
            });
        </script>
        @endif
        <style>
            .FltRgt { 
                float:right; cursor:pointer; 
            }
            .FltLft {
                float:left;
            }
            .MrgTop5 {
                margin-top:5px !important; 
            }
            .carticon {
                float:right; margin-left:5px;
            }
        </style>
        <style>
            .sidenavpost .bh-search-input
            {
                padding-left: 0px !important;
            }

            .sidenavpost .tt-menu
            {
                left: 0% !important;
                color:#fff !important;
            }

            .sidenavpost a
            {
                padding: 0 !important;
                font-size: 14px !important;
            }
            .sidenavpost .closebtn
            {
                font-size: 36px !important;
            }
            #yachts-refine-search-filter input, .black-submit-btn {
                background-color: transparent;
                border: 1px solid #505050;
                padding: 5px;
                text-align: center;
                width: 100%;
            }
            .filter-by-price > select {
                background-color: #dadad5;
                border: 1px solid #333;
                margin-right: 5px;
                width: calc(50% - 7px);
            }
            .filter-by-price > select option {
                padding: 10px 5px;
            }
            .filter-fw-select {
                background-color: #2e2e2e;
                border: 1px solid #5f5f5f;
                border-radius: 0;
                color: #fff;
                width: 100%;
            }
            .filter-fw-select > option {
                min-height: 26px;
                padding: 5px;
            }
            .current-page-heading {
                font-family: serif;
                font-size: 18px;
                font-style: italic;
                color: #000;
            }
            .uk-slideshow:first-child .ai-uk-animation .bh-slideshow-thumbnail-split-preview {
                animation-duration: 0.8s;
                display: none;
            }
            .bh-slideshow-thumbnail-split-preview::after {
                background: transparent none repeat scroll 0 0;
            }
        </style>
        <style>
            .sidenavpost .bh-search-input
            {
                padding-left: 0px !important;
            }

            .sidenavpost .tt-menu
            {
                left: 0% !important;
                color:#fff !important;
            }

            .sidenavpost a
            {
                padding: 0 !important;
                font-size: 14px !important;
            }
            .sidenavpost .closebtn
            {
                font-size: 36px !important;
            }
            .black-submit-btn {
                background-color: transparent;
                border: 1px solid #505050;
                padding: 5px;
                text-align: center;
                width: 100%;
            }

            .slick-prev, .slick-next {
                color: #fff;
                height: auto;
                padding: 0;
                position: absolute;
                width: 20px;
            }
            /*            .top-slick-filtes {
                            width: 80%;
                        }*/
            .slick-prev::before, .slick-next::before {
                color: #fff;
                font-size: 26px;
                font-weight: bold;
                line-height: 1;
                opacity: unset;
            }
            .top-nav-cities-filter .slick-prev, .slick-next {
                background-color: #322e2e;
                height: 100%;
                width: 80px;
            }
            .top-nav-cities-filter .slick-prev, .slick-next:hover, .top-nav-cities-filter .slick-prev, .slick-next:focus, .top-nav-cities-filter .slick-prev, .slick-next:active {
                background-color: #322e2e;
            }
            /*            .top-slick-filtes .slick-next {
                            right: -85px;
                        }
                        .top-slick-filtes .slick-prev {
                            left: -85px;
                        }
                        .top-slick-filtes .slick-prev.slick-arrow.slick-disabled, .top-slick-filtes .slick-next.slick-arrow.slick-disabled  {
                            background-color: #aaa9a9;
                        }*/
            #cityfilters .slick-slide {
                height: auto;
                    background: #1e2023;
            }
            .row.go-back-button-container{margin-left: 0; margin-right: 0;}
            .overlay-text {
                background: rgba(0, 0, 0, 0.68) none repeat scroll 0 0;
                bottom: 0;
                display: none;
                padding: 30px 10px;
                position: absolute;
                text-align: center;
                top: 0;
                width: 100%;
            }
            .overlay-text .yacts-tittle-text, .overlay-text-frezeed .yacts-tittle-text{
                font-family: serif;
                border-bottom: 3px solid #f3bc3a;
                color: #fff;
                overflow-wrap: break-word;
                font-size: 20px;
                font-style: normal;
                font-style: italic;
            }
            .yacths-des-text {
                color: #fff;
                font-size: 18px;
                margin: 0;
            }
            .yacths-des-text-align {
                margin-top: 4px;
            }
            .yacths-des-text span {
                padding: 0px 5px;
            }
            .cat_product_medium1:hover .overlay-text {
                display: block;
            }
            .cat_product_medium1:hover .overlay-text-frezeed {
                display: none;
            }
            .overlay-text-frezeed {
                background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0;
                bottom: 0;
                left: 0;
                padding-top: 88px;
                position: absolute;
                right: 0;
                text-align: center;
                top: 0;
            }
            .overlay-text-frezeed .yacts-tittle-text {
                border: medium none;
                font-size: 16px;
            }
            .overlay-text-frezeed .yacths-des-text.yacths-des-text-align {
                font-size: 14px;
                margin-top: 2px;
            }
            .cat_product_medium1:hover .ai-grid-page-node-pic-box {
                transform: scale(1.06);
                transition: all 0.2s ease-out 0s;
            }
            .cat_product_medium1 {
                overflow: hidden;
            }
            .hotel .overlay-text-frezeed {
                display: none;
            }
            .hotel .overlay-text .yacts-tittle-text, .overlay-text-frezeed .yacts-tittle-text {
                border-bottom: medium none;
                font-size: 17px;
            }
            .hotel .yacths-des-text {
                font-size: 14px;
            }
            .hotel .grid-box-main .yacts-overlay-text{
                display: none;
            }
            .yachts .grid-box-main .hotel-overlay-text{
                display: none;
            }
            .hotel .overlay-text {
                padding: 37px 10px 20px;
            }
            .cat_product_medium1 .pictureBox.gridPicture {
                position: relative !important;
            }
            .cat_product_medium1 .ai-grid-page-node-pic-box {
                position: relative !important;
            }
            .ai-grid-tiitles a {
                color: #000 !important;
                font-size: 18px;
            }
            .ai-view-hotels-tittle a {
                background: transparent url("../../../uploads/images/arrow_right_black.png") no-repeat scroll right 5px;
                clear: left;
                float: left;
                font-family: serif;
                font-size: 14px;
                padding: 0 7px 0 0;
            }
            .ai-view-hotels-tittle a {
                color: #9b9b9b;
            }
            .ai-grid-tiitles h2 {
                color: #000;
                font-family: serif;
                font-size: 17px;
                font-style: italic;
                height: auto;
                margin-bottom: 0;
                margin-top: 10px;
            }
            .ai-grid-tiitles h2:hover, .ai-grid-tiitles h2:focus, .ai-grid-tiitles h2:active {
                color: #000;
                font-family: serif;
                font-size: 17px;
                font-style: italic;
                height: auto;
                margin-bottom: 0;
                margin-top: 10px;
            }
            .productData {
                min-height: 250px;
            }
            .ai-grid-page-node-pic-box  img {
                max-height: 165px !important;
                min-height: 165px !important;
                object-fit: cover;
                object-position: 0 center;
                vertical-align: middle;
                width: 100%;
            }
            .ai-view-hotels-tittle a:hover, .ai-view-hotels-tittle a:focus, .ai-view-hotels-tittle a:active {
                color: #000 !important;
            }
            .cat_product_medium1:hover  .textButton.arrowButton.MrgTop5.ai-filter-hotel-price-style{
                display: none;
            }
            .video-bg {
                height: 100%;
                width: 100%;
            }
            @media screen and (min-width: 1800px){
                .ai-grid-page-node-pic-box  img {
                    max-height: 250px !important;
                    min-height: 250px !important;
                }
            }
			
			img.propovericons {
				position: absolute;
				top: 5px;
				right: 10px;
				z-index: 100;
				max-height: 80px !important;
				width: 80px !important;
				min-height: 80px !important;
			}
                        .ai_active_filter .node-btn {
                            text-decoration: underline;
                        }
                        
                        /* AIC HK 30-12-2017*/
            .FloatFilter {
                float: right;
            }
            
            /* AIC Harman email sidebar css */
            
        .site-aside {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            overflow-x: visible;
            z-index: 1028;
    }
        .contact-aside {
	border-radius: 2px;
	transition: .5s;
	position: fixed;
	top: 228px;
	left: calc(100% - 43px);
	width: 340px;
	background: #272727;
	color: #fff;
	font-size: 15px;
	right: 0;
        }
        .contact-aside ul {
            padding: 7px 0px 0px 0px;;
            list-style: none;
        }
        .contact-aside li {
	padding: 6px 0px 6px 9px;
	margin: 0px 0px 1px 0px;
        }
        .contact-aside li a {
            margin-left: 0;
        }
        .contact-aside [class*="icon-"] {
            display: inline-block;
            width: 24px;
            text-align: center;
            margin-right: 4px;
            float: right;
        }
        .contact-aside li + li {
            border-top: 1px solid #4A4A4A;
        }
        .contact-aside .icon-mail {
            position: relative;
            top: 2px;
        }
        .contact-aside.active {
            left: calc(100% - 290px);
            background: #1e2023 !important;
            color: #fff !important;
        }
        
        .asideIclass {
            float: left;
            margin-top: 3px;
            margin-right: 13px;
            margin-left: 8px;
            color: #ABA07C;
        }
        
        .emporium-voyage-Menu {
	color: #c7ab84;
	margin-top: 3px;
	margin-left: 30px;
	opacity: 1;
	box-shadow: none;
	font-size: 20px;
    }
    
    #block-system-main-menu .block-inner {
    background: rgba(37, 37, 37, 0.9);
    }
    
    .close {
	font-size: 21px;
	font-weight: 700;
	line-height: 1;
	color: #000;
	text-shadow:0px;
	opacity: 1;
    }
    header {
	position: fixed;
	top: 64px;
	z-index: 9999;
	right: 0;
	left: 95.20%;
    }
    
    /* go back buttons */
    
    .show-login-forms-btn {
	display: inline-block;
	padding: 0px 0px;
	text-align: center;
	vertical-align: text-top;
	width: 0%;
    }
    .node-btn:active {
	text-decoration: underline !important;
    }
    .post-filter-inputs:hover, .post-filter-inputs:active, .post-filter-inputs:focus {
	background-color: #393939;
	border-left: 4px solid #a1a39c;
	color: white !important;
	transition: all 0.3s ease 0s;
        text-decoration: underline;
    }
    
        
         /* sidebar css */
        </style>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110391807-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-110391807-1');
		</script>
    </head>
    <body id="main" class="hotel">
        
        
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header>
                        
                        <!-- back and lock button -->
                       
				<div class="logo-padding-left editorial-logo-align">
					<!--<div>
						<a href="#" title="Add to Favorites" class="book-button" onclick="add_to_lightbox(40281, 164);"><i class="fa fa-plus " aria-hidden="true" ></i> Add</a>
					</div>-->
<!--					<div class="go-back-button-container">
						<button class="go-back-button" onclick="goBack()">Go Back</button>
						<div class="previous-page-screen-short-container">
															<img src="http://www.emporium-voyage.com/sximo/previous_page_image/7b58aa5e612660d887cb8569a5685109.jpg">
													</div>
					</div>-->
				</div>
                											<div class="hotel-next-previous-outer">
							<div class="previous-btn previous-next-pannel"> 
								  <img class="img-responsive next-hotel-arrow" src="http://www.emporium-voyage.com/sximo/assets/images/editorial-left-arrow.png" alt="">
								<a href="http://www.emporium-voyage.com/standart-hotel-moscow">
									<div class="next-hotel-show-pannel">
										<img class="img-responsive" src="http://www.emporium-voyage.com/uploads/property_imgs_thumbs/front_property_4565_15531396286-46934943356.jpg" alt="">
										<div class="next-hotel-tittle">
											<h2>StandArt Hotel Moscow</h2>
										</div>
									</div>
								</a>
							</div>
						</div>
																<div class="hotel-next-previous-outer">
							<div class="next-hotel-btn previous-next-pannel"> 
								<img class="img-responsive next-hotel-arrow" src="http://www.emporium-voyage.com/sximo/assets/images/editorial-right-arrow.png" alt="">
								<a href="http://www.emporium-voyage.com/the-mira-hong-kong">
									<div class="next-hotel-show-pannel">
										<img class="img-responsive" src="http://www.emporium-voyage.com/uploads/property_imgs_thumbs/front_property_4612_THE MIRA HONG KONG (2).jpg" alt="">
										<div class="next-hotel-tittle">
											<h2>The Mira Hong Kong</h2>
										</div>
									</div>
								</a>
							</div>
						</div>  
                        <!-- back and lock buttton end -->
                        
                         <!-- start sidebar -->
                            
                            <div class="region region-sidebar-first sidebar">
                                <div class="region-inner clearfix">
                                    <div id="block-ledunfly-menu-link" class="block block-ledunfly no-title odd first block-count-4 block-region-sidebar-first block-menu-link" ><div class="block-inner clearfix">  
<!--                                            <div class="block-content content"><i class="fa fa-bars emporium-voyage-Menu" aria-hidden="true"></i></div>-->
                                        </div>
                                    </div>
<!--                                    <div id="block-ledunfly-menu-logo" class="block block-ledunfly no-title even block-count-5 block-region-sidebar-first block-menu-logo" ><div class="block-inner clearfix">  

                                            <div class="block-content content"><a href="index.html" title="Five Seas Hotel"><div class="menu-logo"></div></a></div>
                                        </div>
                                    </div>-->
                                    <div id="block-system-main-menu" class="block block-system block-menu no-title odd block-count-6 block-region-sidebar-first block-main-menu" role="navigation">
                                        <div class="block-inner clearfix">
                                            <div class="block-content content" class="block-content content">
                                                <!-- Start Popup Menu -->
                                                <?php 
                                                    $popup      = SiteHelpers::menus( 'popup' ,'all'); 
                                                     
                                                ?>
                                            <ul class="menusk clearfix">
                                                @foreach ($popup as $keyMenu=>$menu)
                                                  <li class="{{($keyMenu==0)?'first':''}} {{(count($menu['childs']) > 0)?'expanded':''}}  menu-depth-1 menu-item-{{$menu['menu_id']}}">
                                                    <a href="<?php echo ($menu['menu_type'] =='external')? URL::to($menu['url']) : URL::to($menu['module']); ?>">{{$menu['menu_name']}}</a>
                                                    @if(count($menu['childs']) > 0)
                                                        <ul class="menusk1 clearfix">
                                                            @foreach ($menu['childs'] as $keyMenu2=>$menu2)
                                                             <li class="{{($keyMenu2==0)?'first':''}} {{(count($menu2['childs']) > 0)?'expanded':''}}  leaf menu-depth-2 menu-item-{{$menu['menu_id']}}">
                                                                    <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu2['menu_name']}}</a>
                                                                @if(count($menu2['childs']) > 0)
                                                                <ul class="menusk1 clearfix">
                                                                    @foreach($menu2['childs'] as $keyMenu3=>$menu3)
                                                                        <li class="{{($keyMenu3==0)?'first':''}} leaf menu-depth-3 menu-item-{{$menu['menu_id']}}">
                                                                            <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu3['menu_name']}}</a>
                                                                        </li>   
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>                           
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach

                                             <!-- Start Popup 2 Menu -->   
                                             <?php 
                                                     
                                                    $popup2      = SiteHelpers::menus( 'popup_2' ,'all'); 
                                                ?> 
                                            @foreach ($popup2 as $key2Menu=>$menu)
                                                  <li class="leaf little {{($key2Menu==0)?'little-first':''}}  {{(count($menu['childs']) > 0)?'expanded':''}}  menu-depth-1 menu-item-{{$menu['menu_id']}}">
                                                    <a href="<?php echo ($menu['menu_type'] =='external')? URL::to($menu['url']) : URL::to($menu['module']); ?>">{{$menu['menu_name']}}</a>
                                                    @if(count($menu['childs']) > 0)
                                                        <ul class="menusk1 clearfix">
                                                            @foreach ($menu['childs'] as $key2Menu2=>$menu2)
                                                             <li class="leaf little {{($key2Menu2==0)?'little-first':''}} {{(count($menu2['childs']) > 0)?'expanded':''}}  leaf menu-depth-2 menu-item-{{$menu['menu_id']}}">
                                                                    <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu2['menu_name']}}</a>
                                                                @if(count($menu2['childs']) > 0)
                                                                <ul class="menusk1 clearfix">
                                                                    @foreach($menu2['childs'] as $key2Menu3=>$menu3)
                                                                        <li class="leaf little {{($key2Menu3==0)?'little-first':''}} menu-depth-3 menu-item-{{$menu['menu_id']}}">
                                                                            <a href="<?php echo ($menu3['menu_type'] =='external')? URL::to($menu3['url']) : URL::to($menu3['module']); ?>">{{$menu3['menu_name']}}</a>
                                                                        </li>   
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>                           
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach

                                        </ul>   <!-- Comment Static menu -->
                                                <!--
                                                <ul class="menusk clearfix">
                                                    <li class="first expanded menu-depth-1 menu-item-989">
                                                        <a href="#">Sleep</a>
                                                        <ul class="menusk1 clearfix">
                                                            <li class="first leaf menu-depth-2 menu-item-990">
                                                                <a href="#">Suite Présidentielle</a>
                                                            </li>
                                                            <li class="leaf menu-depth-2 menu-item-991">
                                                                <a href="#">Suite Terrasse</a>
                                                            </li>
                                                            <li class="leaf menu-depth-2 menu-item-992">
                                                                <a href="#">Top Of Five</a>
                                                            </li>
                                                            <li class="leaf menu-depth-2 menu-item-993">
                                                                <a href="#">Suites So Suite</a>
                                                            </li>
                                                            <li class="leaf menu-depth-2 menu-item-994">
                                                                <a href="#">Junior Suites</a>
                                                            </li>
                                                            <li class="leaf menu-depth-2 menu-item-1051">
                                                                <a href="#">Chambres Executive</a>
                                                            </li>
                                                            <li class="leaf menu-depth-2 menu-item-995">
                                                                <a href="#">Chambres Deluxe</a>
                                                            </li>
                                                            <li class="last leaf menu-depth-2 menu-item-1007">
                                                                <a href="#">Services</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="expanded menu-depth-1 menu-item-996">
                                                        <a href="#">Savour</a>
                                                        <ul class="menusk1 clearfix">
                                                    <li class="first leaf menu-depth-2 menu-item-998">
                                                        <a href="#">Le Roof</a>
                                                    </li><li class="leaf menu-depth-2 menu-item-999">
                                                        <a href="#">Le Bar</a>
                                                    </li>
                                                    <li class="last leaf menu-depth-2 menu-item-1135">
                                                        <a href="#">Le Brunch</a>
                                                    </li>
                                                        </ul>
                                                    </li>
                                                    <li class="expanded menu-depth-1 menu-item-1000">
                                                        <a href="#">Relax</a>
                                                        <ul class="menusk1 clearfix">
                                                            <li class="first leaf menu-depth-2 menu-item-1001">
                                                                <a href="#">Spa</a>
                                                            </li><li class="leaf menu-depth-2 menu-item-1002">
                                                                <a href="#">Terrasse piscine</a>
                                                            </li>
                                                            <li class="last leaf menu-depth-2 menu-item-1003">
                                                                <a href="#">Plage privée</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="expanded menu-depth-1 menu-item-1004">
                                                        <a href="#">Discover</a>
                                                        <ul class="menusk1 clearfix">
                                                            <li class="first leaf menu-depth-2 menu-item-1005">
                                                                <a href="#">Cannes</a></li>
                                                            <li class="last leaf menu-depth-2 menu-item-1006">
                                                                <a href="#">Activités</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="leaf menu-depth-1 menu-item-1013">
                                                        <a href="#">News</a>
                                                    </li>
                                                    <li class="expanded menu-depth-1 menu-item-1123">
                                                        <a href="#">Offres</a>
                                                        <ul class="menusk1 clearfix">
                                                            <li class="first leaf menu-depth-2 menu-item-1014">
                                                                <a href="#">Offres Sleep</a>
                                                            </li><li class="last leaf menu-depth-2 menu-item-1125">
                                                                <a href="#">Offres Relax</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="leaf menu-depth-1 menu-item-1015">
                                                        <a href="#">Gift box</a>
                                                    </li>
                                                    <li class="leaf menu-depth-1 menu-item-1009">
                                                        <a href="#">Events</a>
                                                    </li>
                                                    <li class="leaf little little-first menu-depth-1 menu-item-1139">
                                                        <a href="#" class="little little-first">Carrières</a>
                                                    </li>
                                                    <li class="leaf little menu-depth-1 menu-item-1010">
                                                        <a href="#" class="little">Plan &amp; Accès</a>
                                                    </li>
                                                    <li class="leaf little menu-depth-1 menu-item-1092">
                                                        <a href="#" class="little">Mentions légales</a>
                                                    </li><li class="last leaf little menu-depth-1 menu-item-1111">
                                                        <a href="#" class="little">Green Globe</a>
                                                    </li
                                                    ></ul>-->
                                            </div>
<!--                                            <div class="block-menu-text">
                                                <p>FIVE SEAS HOTEL CANNES - 1, RUE NOTRE DAME - 06400 CANNES</p>
                                                <div><p>T : +33 4 63 36 05 05</p>
                                                    <p>INFO@FIVESEASHOTEL.COM</p>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            
                            <!-- end sidebar -->
                        
                        <div class="container-fluid logo-padding-left editorial-logo-align">
                           <!-- <div class="col-md-12-">
                                <p><a class="logo-d" href="{{url()}}">D</a></p>
                            </div>
                            <div class="col-md-12-">
                                <h2 class="menu-text-align">Home</h2>
                            </div>
                            <div class="col-md-12- menu">
                                <a href="#"><img class="menu-button" src="{{ asset('sximo/assets/images/menu.png')}}" alt=""/></a>
                                <ul style="display: none;">
                                    <li>
                                        <a href="home.html">Get Inspired</a>
                                    </li>
                                    <li>
                                        <a href="#" class="trigger-click-on-book-now">By Date</a>
                                    </li>
                                    <li>
                                        <a href="#">Personalized Service</a>
                                    </li>
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12-">
                                <div class="row">
                                    <a href="#" class="book-button open-book-now-page">BOOK</a>
                                </div>
                            </div>-->
                            <div class="row go-back-button-container">
                                @if(isset($_GET['ref']) && $_GET['ref']!='' )
                                    <button class="go-back-button" id="back_button_page">Go Back</button> 
                                    
                                @else
                                    <button class="go-back-button" onclick="goBack()">Go Back</button>
                                @endif
                                <div class="previous-page-screen-short-container"></div>
                            </div>
                        </div>
                            
                            <!--New Login Pop Up Start Here-->
        <div id="login-forms-popup" class="popup login-form-pop-main-align">
             <div class="popup-inner">
                 <a href="#" class="popup-close-btn">&times;</a>
                 <div class="popup-content">
                     <div class="content-area">
                         <a class="dl-pop-logo-align" href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}"></a>
                     </div>
                     <!--Login Forms Start Here-->
                     <div class="landing-page-lock-login-btn-outer-align">
                         <div class="login-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="ps-form-main-pannel">
                                         <div class="ps-form-heading-outer-align">
                                             <div class="ps-big-form-heading">Login With</div>
                                             <div class="ps-big-form-heading">Your Account</div>
                                         </div>
                                         <form class="ps-login-sign-form-pannel">
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="text" class="form-control ps-login-form-input" placeholder="Email Address">
                                             </div>
                                             <div class="input-group ps-form-group-outer">
                                                 <input class="form-control ps-login-form-input" placeholder="Password" type="password">
                                                 <span class="input-group-addon login-forgot-pass-align"><a class="ps-forms-small-heading-link forgot-pass-show-form-btn" href="javascript:void(0)">Forgot?</a></span>
                                             </div>
                                             <div class="ps-login-sign-submit-btn">
                                                 <button type="submit">  Log In</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="forgot-pass-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="ps-form-main-pannel">
                                         <div class="ps-form-heading-outer-align">
                                             <div class="ps-big-form-heading">Forgot Your</div>
                                             <div class="ps-big-form-heading">Password</div>
                                             <p class="form-white-samml-des-text">Enter your email and you will get Instructions to reset your password</p>
                                         </div>
                                         <form class="ps-login-sign-form-pannel">
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="text" class="form-control ps-login-form-input" placeholder="Email Address">
                                             </div>
                                             <div class="ps-login-sign-submit-btn">
                                                 <button type="submit">Submit</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="create-account-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="ps-form-main-pannel">
                                         <div class="ps-form-heading-outer-align">
                                             <div class="ps-big-form-heading">Create Your Account</div>
                                             <div class="ps-big-form-heading">Password</div>
                                         </div>
                                         <form class="ps-login-sign-form-pannel">
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="text" class="form-control ps-login-form-input" placeholder="Email Address">
                                             </div>
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="password" class="form-control ps-login-form-input" placeholder="Password">
                                             </div>
                                             <div class="ps-login-sign-submit-btn">
                                                 <button type="submit">Submit</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="">
                             <div class="login-sign-up-sidebar-outer-align account-with-us-show-hide">
                                 <div class="your-account-heading-align">
                                     <h2>Your Account With Us</h2>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                             <div class="clearfix"></div>
                             <div class="ps-login-sign-up-main-pannel">
                                 <div class="col-md-6 col-sm-6 col-xs-6">
                                     <div class="row">
                                         <a class="ps-login-sign-up-common ps-sign-up-btn sign-up-show-form-btn" href="javascript:void(0)">Sign Up</a>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-sm-6 col-xs-6">
                                     <div class="row">
                                         <a class="ps-login-sign-up-common  login-show-form-btn" href="javascript:void(0)">Log In</a>
                                     </div>
                                 </div>
                                 <div class="sign-in-with-fb-tab">
                                     <a class="ps-login-sign-up-common" href="javascript:void(0)">Sign In With LinkedIn</a>
                                 </div>
                             </div>
                         </div>
                         <!--Login Forms End Here-->
                     </div>
                     <div class="clearfix"></div>
                 </div>
             </div>
         </div>
        <!--New Login Pop Up End Here-->
                            
                    </header>
                    <div class="filter-page-main-align">
                        <div class="col-md-10 col-sm-9 FloatFilter pull-right">
                            <div class="row">
                                
                                <!-- AIC Harman top bar adding -->
                                <section class="book-form-top-bar">
                                    <div>
                                        <div class="booking-form-bar-top">
                                            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar top-bar-search-form-align" action="{{URL::to('search')}}">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="form-group would-like-input top-bar-search padding-right-12">
                                                            <input  class="form-control ai-custom-deafault-style bh-search-input typeahead search-box searchbox_landing" name="s" id="search-navbar" placeholder="Enter Your Hotel or Destination" type="text" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div id="top-bar-search-booking-form">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="form-group padding-right-12">
                                                                        <input id="top-bar-search-booking-form-arrive" class="form-control ai-custom-deafault-style" name="arrive" type="text" placeholder="Arriving">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="form-group padding-right-12">
                                                                        <input id="top-bar-search-booking-form-destination" class="form-control ai-custom-deafault-style" name="destination" type="text" placeholder="Departing">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <div class="dropdown top-search-members-list">
                                                                <div class="top-search-members-inner-align">
                                                                    <div class="members-list ai-custom-deafault-style">
                                                                        <span id="adults-val">1</span>
                                                                        Adults,
                                                                        <span id="childern-val">0</span>
                                                                        Children
                                                                        <span class="right-down-arrow">
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                    <ul class="members-drop-list" style="display: none;">
                                                                        <li>
                                                                            <label>Adult</label>
                                                                            <input id="adult-input-value" name="adult" class="input-right" value="2" min="1" max="5" type="number">
                                                                        </li>
                                                                        <li>
                                                                            <label>Children</label>
                                                                            <input id="childerns-input-value" name="childs" class="input-right" value="0" min="0" max="5" type="number">
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <button class="top-booking-bar-btn" type="submit">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn"><i class="fa fa-lock " aria-hidden="true"></i></a>
                                            </form>
                                        </div>
                                        <!-- AIC Harman email phone sidebar add start -->
                                        
                                        <aside class="site-aside">
                                            <div class="contact-aside">
                                                <ul class="contact-aside-list">
                                                    <li class="contact-list-item contact-phone"><a href="tel:+49 172 8937230"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +49 172 8937230</a></li>
                                                    <li class="contact-list-item contact-email"><a href="mailto:bookings@emporium-voyage.com"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> bookings@emporium-voyage.com</a></li>
                                                </ul>
                                            </div>
                                        </aside>
                                        
                                        <!-- AIC Harman email phone sidebar add end-->
                                        
                                    </div>
                                </section>
                                <!-- top bar end-->
                                
                                <script src="{{ asset('sximo/assets/js/fliters.js')}}" type="text/javascript"></script>
                                <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
                                <script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"></script>
                                <?php /* <div class="header container-fluid">
                                    @if(empty($categoryslider))
										<div class="col-md-12">
											<div class="header-logo">
												<a href="{{url()}}">
													<img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="Design Locations"/>
												</a>
											</div>
										</div>
									@endif
                                    <div class="container">
                                        <div class="row">
                                            <div class="header-navigation-container col-md-12">
                                                <div class="row">
                                                    <div class="col-md-0"></div>
                                                    <div class="col-md-3 col-sm-2 header-text-align">
                                                    </div>
                                                    <div class="col-md-7 col-sm-8">
                                                        @include('layouts/elliot/ai_navigation')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                */?>

                                <div class="sticky-header-offset"></div> 
								
                                <div class="grid-page-category-slider-container">
								@if(!empty($categoryslider))
									<div class="bh-slideshow-thumbnail-split hidden-xs hidden-sm" data-uk-slideshow="{animation: 'slice-up', autoplay: true}" style="margin-bottom:20px;margin-top:0px;">
										<ul style="" class="uk-slideshow uk-overlay-active">
											@foreach($categoryslider as $slides)
											<li class="ai-uk-animation" style="" @if($categoryslider[0]==$slides) class="uk-active" @endif aria-hidden="true">
                                                                                            @if($slides->slide_type == 'Image')
                                                                                            <div style="background-image: url({{ URL::to('uploads/slider_images/'.$slides->slider_img)}});" class="uk-cover-background uk-position-cover"></div>
                                                                                            @else
                                                                                            <div class="uk-cover-background uk-position-cover"><iframe class="video-bg" src="https://www.youtube.com/embed/{{$slides->slider_video}}?playlist={{$slides->slider_video}}&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                                                                                            @endif
												<canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
												<div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
													<div>
														<ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
															<li>
																<span><a href="#" rel="category tag">{{$slides->slider_category}}</a></span>
															</li>
														</ul>
														<h3 class="bh-slideshow-overlay-title">
															<a href="#">{{$slides->slider_title}}</a>
														</h3>
														<div class="bh-slideshow-overlay-content">{{$slides->slider_description}}</div>
														@if($slides->slider_link != '#')
                                                                                                                <a class="uk-margin-top uk-button uk-button-primary" href="http://{{$slides->slider_link}}" title="Do it yourself">Discover <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                                                                                                                @endif
													</div>
												</div>
												<div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                                                                                                    <div style="width: 80%;">
														<ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
															<li>
																<span><a href="#" rel="category tag">{{$slides->slider_category}}</a></span>
															</li>
														</ul>
														<h3 class="bh-slideshow-thumbnail-split-preview-title">
															<a href="#">{{$slides->slider_title}}</a>
														</h3>
														<div class="bh-slideshow-thumbnail-split-preview-content">{{$slides->slider_description}}</div>
                                                                                                                @if($slides->slider_link != '#')
														<a class="uk-margin-top uk-button uk-button-primary" href="http://{{$slides->slider_link}}">Discover <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                                                                                                                @endif
													</div>
													<a href="javascript:void(0);" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
													<a href="javascript:void(0);" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
												</div>
											</li>
											@endforeach
										</ul>
									</div>
                                @endif
                                </div>
								<div class="container">
									<div class="row">
										<div class="header-navigation-container col-md-12">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													@include('layouts/elliot/ai_navigation')
												</div>
											</div>
										</div>
									</div>
								</div>
                                <!--Main Page Start here--><div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="row" style="{{ ($ttlcount==0)?'padding:100px 0 0;text-align: center;':'padding:10px 0 0;text-align: center;'}}">
                                        <div class="locator clear">
                                            <p class="searchcount"> {{$ttlcount}} Hotel(s) Found for {{$keyword}} </p>
                                        </div>
                                    </div>

                                    <div id="cityfilters">
                                         
                                         @if(!empty($cities))

                                         <div class="row" style="padding-bottom: 8px;background: #f0f0f0;padding-top: 8px;margin-bottom: 15px; margin-left: 0; margin-right: 0;">
                                             <div class="col-md-6 col-xs-12 text-right">
                                                Filter By Luxury Destination
                                             </div>
                                             <div class="col-md-6 col-xs-12">
                                                <select onchange="filter_destination(this.value ,'city')">
                                                    @foreach($cities as $citieVal)
                                                    <option value="{{ $citieVal->id }}">{{ $citieVal->category_name.'('.$citieVal->totalproperty.')'}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                         </div>
                                        <!-- Load City List -->
                                        <?php /*
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="clear-all-filters"><a href="javascript:void(0)"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear Filters</a></div>
                                                <div>
                                                    <ul class="top-nav-cities-filter top-slick-filtes top-bar-filters-removed regular slider slick-initialized slick-slider">
                                                        <li class="active select-all slick-slide slick-current slick-active">
                                                            <a href="javascript:void(0)" onclick="filter_destination(0,'city');">
                                                                <div class="filter-bg">
                                                                    <div class="right-text"></div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="top-filter-name">All Properties(0)</div>
                                                                </div>
                                                            </a>
                                                            <div style="display: none;" class="city-filter-node-overlay">
                                                                <a class="city-filter-node-heading">Heading</a>
                                                                <div class="city-filter-node-details">Testing testing testing testing testing testing testing</div>
                                                            </div>
                                                        </li>

                                                       
                                                        @foreach($cities as $citieVal)
                                                        <li class="slick-slide slick-active">
                                                            <a href="javascript:void(0)" onclick="filter_destination({{ $citieVal->id }} ,'city');">
                                                                <div class="filter-bg" >
                                                                    <div class="right-text"></div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="top-filter-name">{{ $citieVal->category_name.'('.$citieVal->totalproperty.')'}}</div>
                                                                </div>
                                                            </a>
                                                            <div style="display: none;" class="city-filter-node-overlay">
                                                                <a class="city-filter-node-heading">Heading</a>
                                                                <div class="city-filter-node-details">Testing testing testing testing testing testing testing</div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                                      */ ?>
                                        <!-- End City List -->
                                        @endif
                                      
                                    </div>

                                    <div id="listproperties">
                                        <div class="row ">
											
													
                                          
											@if($propertiesArr)
                                            {{--*/ $rw = 1 /*--}}
                                            {{--*/ $node_no = 1; $ads_node=0; /*--}}
                                            @foreach($propertiesArr as $props)
                                            @if($node_no%10==0)
                                                @if(!empty($reultsgridAds))
                                                    @if(array_key_exists($ads_node,$reultsgridAds))
                                                        <div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">
                                                            <div class="wrapperforliineedforlightboxremoval">
                                                                <div class="cat_product_medium1">
                                                                            <div class="ai-grid-page-node-pic-box pictureBox gridPicture">
                                                                                <a title="{{$reultsgridAds[$ads_node]->adv_title}}" class="picture_link-" href="{{ (strpos($reultsgridAds[$ads_node]->adv_link, 'http://') !== false) ? $reultsgridAds[$ads_node]->adv_link : 'http://'.$reultsgridAds[$ads_node]->adv_link }}">
                                                                                    <h2 style="position:absolute; color:#fff;padding-left: 20px;">Advertiser</h2>
                                                                                    <img alt="{{$reultsgridAds[$ads_node]->adv_title}}" src="{{URL::to('uploads/users/advertisement/'.$reultsgridAds[$ads_node]->adv_img)}}" class="img-responsive" style="border: 2px solid #D3D6D2;padding: 3px 1px 3px 0px;">
                                                                                </a>
                                                                            </div>
                                                                            <div class="listDetails">
                                                                                <div class="photographBox">
                                                                                    <h2>
                                                                                        <a title="{{$reultsgridAds[$ads_node]->adv_title}}" class="photograph FltLft ai-filtreted-hotel-name" href="{{ (strpos($reultsgridAds[$ads_node]->adv_link, 'http://') !== false) ? $reultsgridAds[$ads_node]->adv_link : 'http://'.$reultsgridAds[$ads_node]->adv_link }}">
                                                                                            {{$reultsgridAds[$ads_node]->adv_title}}
                                                                                        </a> 
                                                                                    </h2>
                                                                                </div>
                                                                                <div class="entire_story MrgTop5">
                                                                                    <p style="float: left;">{{$reultsgridAds[$ads_node]->adv_desc}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                 {{--*/ $ads_node++; /*--}}
                                            @else
                                            <div class="productData col-xs-12 col-sm-6 col-md-4 col-lg-3 margin-bottom-10">
                                                <div class="wrapperforliineedforlightboxremoval">
                                                    <div class="cat_product_medium1">
                                                        <div class="ai-grid-page-node-pic-box pictureBox gridPicture grid-box-main">
                                                            @if($props['data']->price!='')
                                                            <?php /*<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="{{$props['data']->id}}" href="{{URL::to($props['data']->property_slug)}}">
                                                                From EUR {{$props['data']->price}} / night 
                                                            </a> */ ?>
                                                            @endif
                                                            @if(array_key_exists('image', $props))
                                                                @if($props['data']->editor_choice_property=='1')
                                                                    <img alt="editor_choice_property" class="propovericons" src="{{URL::to('sximo/images/editors-choice.png')}}">
                                                                @elseif($props['data']->feature_property=='1')
                                                                    <img alt="editor_choice_property" class="propovericons" src="{{URL::to('sximo/images/featured-property.png')}}">
                                                                @endif
               
                                                                <a title="{{$props['data']->property_name}}" class="picture_link-" href="{{URL::to($props['data']->property_slug)}}" rel="{{$props['data']->id}}">
                                                                    <div class="overlay-text-frezeed">
                                                                        <h2 class="yacts-tittle-text">{{ $props['data']->property_name}}</h2>
                                                                        <p class="yacths-des-text yacths-des-text-align"><span>&euro;<?php echo $props['data']->price; ?> </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                    </div>
                                                                    <div class="overlay-text hotel-overlay-text">
                                                                        <h2 class="yacts-tittle-text">{{ $props['data']->property_name}}</h2>
                                                                        <p class="yacths-des-text yacths-des-text-align"><span>From &euro;{{ $props['data']->price}} </span>
                                                                        <span>      {{(isset($props['data']->category_name))? '| '.$props['data']->category_name : ''}}</span></p>
                                                                    </div>
                                                                    <div class="overlay-text yacts-overlay-text">
                                                                        <h2 class="yacts-tittle-text">{{ $props['data']->property_name }}</h2>
                                                                        <p class="yacths-des-text yacths-des-text-align"><span>&euro;{{ $props['data']->price}} </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                        <p class="yacths-des-text">2015H</p>
                                                                    </div>
                                                                    <img alt="{{ $props['image']->file_name }}" src="{{ URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">
                                                                </a>
                                                            @else
                                                            <a class="picture_link detail_view-" rel="{{$props['data']->id}}" href="{{URL::to($props['data']->property_slug)}}">
                                                                <img class="img-responsive" src="{{URL::to('sximo/assets/images/img-1.jpg')}}" alt="">
                                                            </a>

                                                            <div class="overlay-text-frezeed">
                                                                <h2 class="yacts-tittle-text">{{ $props['data']->property_name}}</h2>
                                                                <p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                            </div>
                                                            <div class="overlay-text hotel-overlay-text">
                                                                <h2 class="yacts-tittle-text">{{ $props['data']->property_name }}</h2>
                                                                <p class="yacths-des-text yacths-des-text-align"><span>From &euro;{{ $props['data']->price}} </span>|<span>New York</span></p>
                                                            </div>
                                                            <div class="overlay-text yacts-overlay-text">
                                                                <h2 class="yacts-tittle-text">{{ $props['data']->property_name }}</h2>
                                                                <p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                <p class="yacths-des-text">2015H</p>
                                                            </div>
                                                        <img class="img-responsive" src="{{URL::to('sximo/assets/images/img-1.jpg')}}" alt="">-->
                                                            
                                                            @endif
                                                        </div>
                                                        <div class="listDetails">
                                                            <div class="photographBox ai-grid-tiitles">
                                                                <h2>
                                                                    <a title="{{$props['data']->property_name}}" class="photograph FltLft ai-filtreted-hotel-name" rel="{{$props['data']->id}}" href="{{URL::to($props['data']->property_slug)}}">
                                                                        {{$props['data']->property_name}}
                                                                    </a>
                                                                    <span class="FltRgt">
                                                                        <!--i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" @if(array_key_exists('image', $props)) onclick="add_to_lightbox({{$props['image']->file_id}}, {{$props['data']->id}});" @endif ></i-->

                                                                       <a class="carticon" href="javascript:void(0)" onclick="submitgridbookform('{{$props['data']->property_slug}}#*{{$props['data']->id}}');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>
                                                                    </span>
                                                                </h2>

                                                            </div>

                                                            <div class="entire_story MrgTop5 ai-view-hotels-tittle">
                                                                <a class="textButton arrowButton detail_view MrgTop5" rel="{{$props['data']->id}}" href="#">
                                                                    Quick View 
                                                                </a>

                                                                <a class="textButton arrowButton MrgTop5" rel="{{$props['data']->id}}" href="{{URL::to($props['data']->property_slug)}}">
                                                                    Detail View 
                                                                </a>
                                                            </div>

                                                            <div class="showOnHover">
                                                                <div class="hover_request">
                                                                </div>   
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            @if($rw%4==0)
                                        </div>
                                        <div class="row">
                                            @endif

                                            @endif
                                            {{--*/ $rw++ /*--}}
                                            {{--*/ $node_no++ /*--}}
                                            @endforeach
                                            {{--*/ $totpage = $propertiesArr->appends($pager)->lastPage(); $newpage = $currentPage + 2; $prevnewpage = $newpage - 2; /*--}}
                                            @endif 
                                            
                                    </div>
									</div>
                                    <div id="loaderProperty"></div>
                                    <div id="brgrid"></div>
                                    <input type="hidden" id="nxtpg" value="{{$newpage}}">
                                    <input type="hidden" id="ttlpg" value="{{$totpage}}">
                                </div>

                            </div>
                            
                        </div>

                    </div>
                    <input class="ai_search_keywords" value="{{$keyword}}" type="hidden" />
                    <input class="ai-arrive-date-filter" value="<?php echo (isset($_REQUEST['arrive'])) ? date('d-m-Y', strtotime($_REQUEST['arrive'])) : date("d-m-Y"); ?>" type="hidden" />
                    <input class="ai-depart-date-filter" value="<?php echo (isset($_REQUEST['destination'])) ? date('d-m-Y', strtotime($_REQUEST['destination'])) : date("d-m-Y", strtotime("+ 1 day")); ?>" type="hidden" />
                    <input class="ai-current-filter" value="" type="hidden" />
                    <input class="ai-scrollDownloadData-filter-running" value="0" type="hidden" />
                    <script>
$(document).ready(function(){
    
    $(document).on('click', '.top-bar-filters li.select-all', function (){
        if ($(this).hasClass("active")) {
            $('.top-bar-filters li').addClass("active");
            $(this).removeClass("active");
        }
        else {
            $('.top-bar-filters li').removeClass("active");
            $(this).addClass("active");
        }
    });
    $(document).on('click', '.top-bar-filters li', function (){
        if (!$(this).hasClass("select-all")) {
            $(this).toggleClass("active");
            $('.top-bar-filters li.select-all').removeClass("active");
        }
    });
    $(document).on('click', '.clear-all-filters a', function (event){
        event.preventDefault();
        $('.top-bar-filters li').removeClass("active");
        $('.top-bar-filters li.select-all').addClass("active");
    });
    var scrollTimer, lastScrollFireTime = 0;



    /*$(window).scroll(function () {
        var minScrollTime = 4000;
        var now = new Date().getTime();
        var totlpgs = $('#ttlpg').val();
        var nxtpg = $('#nxtpg').val();
        if ( + nxtpg <= + totlpgs) {
            if (!scrollTimer) {
            var element_position = $('#brgrid').offset().top + $('#brgrid').outerHeight() - window.innerHeight;
            var y_scroll_pos = $(window).scrollTop() + 100;
            if ((y_scroll_pos >= element_position)) {
            var it_scroll = true;
            scrollDownloadData(it_scroll);
            //console.log(y_scroll_pos + ' / ' +element_position);
            }
            scrollTimer = setTimeout(function() {
            scrollTimer = null;
            lastScrollFireTime = new Date().getTime();
            var it_scroll = true;
            scrollDownloadData(it_scroll);
            //console.log(y_scroll_pos + ' / ' +element_position);
            }, minScrollTime);
            }
        }
    });*/
});



function scrollDataAjax(it_scroll,pageCounter)
{
    if($(".ai-scrollDownloadData-filter-running").val() == "1") {
        //return;
    }
    
    $(".ai-scrollDownloadData-filter-running").val("1");
    var nxtpg = pageCounter;
    var offSet = 12, isPreviousEventComplete = true, isDataAvailable = true;
    var sIndex = $('#listrecrds').val();
    var queryStrng = '';
    var destnarea = $('#selDestn').val();
    if (destnarea != '')
    {
        var dest_area = destnarea.split("#:");
        queryStrng = '&dest=' + dest_area[0] + '&area=' + dest_area[1];
    }

    if (isPreviousEventComplete && isDataAvailable) {
        isPreviousEventComplete = false;
        //$(".LoaderImage").css("display", "block");

    $.ajax({
        url: "{{ URL::to('filter_search_destionation')}}",
        type: "get",
        data: 'dest=&s=' + $(".ai_search_keywords").val() + '&arrive=' + $(".ai-arrive-date-filter").val() + '&destination=' + $(".ai-depart-date-filter").val() + '&page=' + nxtpg + queryStrng + "&filter_min_price=" + $("#filter_min_price").val() + "&filter_max_price=" + $("#filter_max_price").val() + "&current_filter=" + $(".ai-current-filter").val(),
        dataType: "json",
        complete: function (jqXHR, textStatus ) {
            // $('#nxtpg').val(parseInt(nxtpg) + 1);
        },
        success: function(data){
            
            $(".ai-scrollDownloadData-filter-running").val("0");
            $('#loaderProperty').hide();
                var html = chtml = '';
                if (data.status == 'error'){
                    if (it_scroll == false){
                        $('#listproperties').html(data.errors);
                    }else{
                        $('#listproperties').append(data.errors);
                    }
                        isDataAvailable = false;
                    }else{
                        if(data.searchdestname != undefined) {
                            $(".ai_search_keywords").val(data.searchdestname);
                        }
                
                        /*
                         * Slider HTML
                         */
                
                        var sliderHTML = '';
                
                
                   html += '<div class="row animate-bottom">';
                    var p = 1;
                    var node_no = 1;
                    var total_rows = 0;

                    $.each($.parseJSON(data.properties), function(idx, obj) {

                        /*html +='<li class="grid-item wow fadeInUp">';
                        html +='<a href="{{URL::to('/')}}/'+obj.pdata.property_slug+'">';
                        html +='<figure>';
                        html +='<div class="portfolio-img bg-deep-pink">';           
                        if (obj.hasOwnProperty("image")) {
                             var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
                        html +='<img alt="'+obj.pdata.property_name+'" src="'+pimg+'">';
                        }else{
                             html +='<img src="http://placehold.it/800x560" alt=""/>';
                        }
                        html +='</div>';
                        html +='<figcaption>';
                        html +='<div class="portfolio-hover-main text-left">';
                        html +='<div class="portfolio-hover-box vertical-align-bottom">';
                        html +='<div class="portfolio-hover-content position-relative last-paragraph-no-margin">';
                        html +='<span class="font-weight-600 line-height-normal alt-font text-white text-uppercase margin-one-half-bottom display-block">'+obj.pdata.property_name+'</span>';
                        if (obj.pdata.price != ''){
                            html +='<p class="text-white text-uppercase text-extra-small">From € '+obj.pdata.price+' </p>';
                        }
                        html +='</div>';
                        html +='</div>';
                        html +='</div>';
                        html +='</figcaption>';
                        html +='</figure>';
                        html +='</a>';
                        html +='<div class="listDetails">';
                        html +='<div class="photographBox ai-grid-tiitles">';
                        html +='<h2>';
                        html +='<a title="'+obj.pdata.property_name+'" class="photograph FltLft ai-filtreted-hotel-name" rel="'+obj.pdata.id+'" href="{{URL::to('/')}}/'+obj.pdata.property_slug+'">';
                        html +=obj.pdata.property_name;
                        html +='</a>';
                        html +='<span class="FltRgt">';
                        html +='<a class="carticon" href="javascript:void(0)" onclick="submitgridbookform(\''+obj.pdata.property_slug+'#*'+obj.pdata.id+'\');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
                        html +='</span>';
                        html +='</h2>';
                        html +='</div>';
                        html +='<div class="entire_story MrgTop5 ai-view-hotels-tittle">';
                        html +='<a class="textButton arrowButton detail_view MrgTop5" rel="'+obj.pdata.id+'" href="#">Quick View</a>';
                        html +='</div>';
                        html +='<div class="showOnHover">';
                        html +='<div class="hover_request">';
                        html +='</div>';   
                        html +='</div>';
                        html +='</div>';
                        html +='</li>';
                        */


                        
                        if (node_no % 20 == 0) {
                            html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                            html += 'Advertisement Here';
                            html += '</div>';
                        }else {
                            html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                            html += '<div class="wrapperforliineedforlightboxremoval">';
                            html += '<div class="cat_product_medium1">';
                            html += '<div class="ai-grid-page-node-pic-box pictureBox gridPicture grid-box-main">';
                            if (obj.pdata.price != ''){
                                if($("#filter_min_price").val() != '' && $("#filter_max_price").val() != '') {
                                    html += '<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="' + obj.pdata.id + '" href="' + detail_link + '"> From EUR ' + obj.pdata.price + ' / night </a>';
                                }
                            }
                            if (obj.hasOwnProperty("image")) {
                                if(obj.pdata.editor_choice_property=='1'){
                                    var edtch = "{{URL::to('sximo/images/editors-choice.png')}}";
                                    html += '<img alt="editor_choice_property" class="propovericons" src="'+edtch+'">';
                                }else if(obj.pdata.feature_property=='1'){
                                    var featp = "{{URL::to('sximo/images/featured-property.png')}}";
                                    html += '<img alt="editor_choice_property" class="propovericons" src="'+featp+'">';
                                }
                               var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
                                html += '<a title="' + obj.pdata.property_name + '" class="picture_link " rel="' + obj.pdata.id + '" href="{{URL::to('')}}/' + obj.pdata.property_slug + '">';
                                html += '<div class="overlay-text-frezeed">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;' + obj.pdata.price + ' </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                html += '</div>';
                                html += '<div class="overlay-text hotel-overlay-text">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>From &euro;' + obj.pdata.price + ' </span><' + obj.pdata.category_name + '</span></p>';
                                html += '</div>';
                                html += '<div class="overlay-text yacts-overlay-text">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;' + obj.pdata.price + ' </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                html += '<p class="yacths-des-text">2015H</p>';
                                html += '</div>';
                                html += '<img alt="' + obj.image.file_name + '" src="' + pimg + '" class="img-responsive">';
                                html += '</a>';

                            } else{
                                
                                var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
                                html += '<div class="overlay-text-frezeed">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                html += '</div>';
                                html += '<div class="overlay-text hotel-overlay-text">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>From &euro;' + obj.pdata.price + ' </span>|<span>New York</span></p>';
                                html += '</div>';
                                html += '<div class="overlay-text yacts-overlay-text">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                html += '<p class="yacths-des-text">2015H</p>';
                                html += '</div>';
                                html += '<img alt="" src="' + pimg + '" class="img-responsive">';
                            }

                            html += '</div>';
                            html += '<div class="listDetails">';
                            html += '<div class="photographBox ai-grid-tiitles">';
                            html += '<h2>';
                            var detail_link = "{{URL::to('')}}/" + obj.pdata.property_slug;
                            html += '<a title="' + obj.pdata.property_name + '" class="FltLft ai-filtreted-hotel-name" rel="' + obj.pdata.id + '" href="' + detail_link + '">';
                            html += obj.pdata.property_name;
                            html += '</a>';
                            html += '<span class="FltRgt">';
                            if (obj.hasOwnProperty("image")) {
                               // html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" onclick="add_to_lightbox(' + obj.image.file_id + ',' + obj.pdata.id + ');" ></i>';
                            }else{
                                //html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" ></i>';
                            }
                                html += '<a class="carticon" href="javascript:void(0)" onclick="submitgridbookform(\'' + obj.pdata.property_slug + '#*' + obj.pdata.id + '\');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
                                html += '</span>';
                                html += '</h2>';
                                html += '</div>';
                                html += '<div class="entire_story MrgTop5 ai-view-hotels-tittle">';
                                html += '<a class="textButton arrowButton detail_view MrgTop5" rel="' + obj.pdata.id + '" href="#">Quick View</a>';
                                html += '<a class="textButton arrowButton MrgTop5" rel="' + obj.pdata.id + '" href="' + detail_link + '">Detail View </a>';
                                html += '</div>';
                                html += '<div class="showOnHover">';
                                html += '<div class="hover_request">';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                if (p % 4 == 0){
                                    html += '</div>';
                                    html += '<div class="row">';
                                }
                            }
                            p++;
                            node_no++;
                            total_rows++;
                        });
                        if(total_rows>0){
                            $('.locator').parent().css('padding-top','0px');
                        }
                        $(".searchcount").html(data.ttl + ' Hotel(s) Found for ' + $(".ai_search_keywords").val());
                        html += '</div>';
                        if (it_scroll == false){

                            $('#listproperties').html(html);
                        }else{
                            $('#listproperties').append(html);
                        }
                    if (destnarea != ''){
                        if (dest_area[1] == 'country' || dest_area[1] == 'region'){
                            $('#cityfilters').html('');
                        }
                        var ttp = p - 1;
                        if (typeof $.parseJSON(data.cities) !== 'undefined' && $.parseJSON(data.cities).length > 0) {

                            chtml += '<div class="row" style="padding-bottom: 8px;background: #f0f0f0;padding-top: 8px;margin-bottom: 15px;">';
                            chtml += '<div class="col-md-6 col-xs-12 text-right">Filter By Luxury Destination</div>';
                            chtml += '<div class="col-md-6 col-xs-12">';
                            chtml += '<select onchange="filter_destination(this.value ,\'city\')">';
                            $.each($.parseJSON(data.cities), function(idx, cobj) {
                                chtml += '<option value="' + cobj.id + '">' + cobj.category_name + '(' + cobj.totalproperty + ')</option>';
                            })
                            chtml += '</select>';
                            chtml += '</div>';
                            chtml += '</div>'; 
                            
                            $('#cityfilters').html(chtml); 
                        }

//                var searchcountdispl = data.ttl + ' Hotel(s) Found for ' + data.searchdestname;
//                $('.searchcount').html(searchcountdispl);
                }
                   
                    sIndex = parseInt(sIndex) + offSet;
                    $('#listrecrds').val(sIndex);
                    $('#ttlpg').val(data.ttlpages);
                    isPreviousEventComplete = true;
                }
                      

                 },
            error: function (error) {
    //        alert(error);
            }
        });
    }
}


var pageCounter = 2;
var previousScroll = 0;
$(window).scroll(function () {

        var currentScroll = $(this).scrollTop();
       if (currentScroll > previousScroll){
           var windowScrollTop =  $(this).scrollTop() + ($('#listproperties').offset().top / 2);
           
            var documentHeight = $('#listproperties').innerHeight();

             console.log('windowScrollTop  : ' + windowScrollTop+ ' document height : '+ documentHeight);
            if(windowScrollTop >= documentHeight) {
                var it_scroll = true;
                 if(localStorage.page==2){
                    pageCounter = 2;
                 }
                scrollDataAjax(it_scroll, pageCounter);
                localStorage.page = 3;
                //var nextPage = parseInt($('#nxtpg').val()) + 1 ;
                   // $('#nxtpg').val(nextPage);
                pageCounter++;
                console.log('Ok! Fired Ajax');
            }
       } else {
          console.log('scroll up');
       }
       previousScroll = currentScroll;

        
    });

function scrollDownloadData(it_scroll)
{  localStorage.page = 2;
    if($(".ai-scrollDownloadData-filter-running").val() == "1") {
        return;
    }
    
    $('#loaderProperty').show();
    
    $(".ai-scrollDownloadData-filter-running").val("1");
var nxtpg = $('#nxtpg').val();
var offSet = 12, isPreviousEventComplete = true, isDataAvailable = true;
var sIndex = $('#listrecrds').val();
var queryStrng = '';
var destnarea = $('#selDestn').val();
if (destnarea != '')
{
var dest_area = destnarea.split("#:");
queryStrng = '&dest=' + dest_area[0] + '&area=' + dest_area[1];
}

if (isPreviousEventComplete && isDataAvailable) {
isPreviousEventComplete = false;
//$(".LoaderImage").css("display", "block");

$.ajax({
url: "{{ URL::to('filter_search_destionation')}}",
        type: "get",
        data: 'dest=&s=' + $(".ai_search_keywords").val() + '&arrive=' + $(".ai-arrive-date-filter").val() + '&destination=' + $(".ai-depart-date-filter").val() + '&page=' + nxtpg + queryStrng + "&filter_min_price=" + $("#filter_min_price").val() + "&filter_max_price=" + $("#filter_max_price").val() + "&current_filter=" + $(".ai-current-filter").val(),
        dataType: "json",
        complete: function (jqXHR, textStatus ) {
            $('#nxtpg').val(parseInt(nxtpg) + 1);
        },
        success: function(data){
            
            $(".ai-scrollDownloadData-filter-running").val("0");
            $('#loaderProperty').hide();
                        var html = chtml = '';
                        if (data.status == 'error')
                        {
                        if (it_scroll == false)
                        {
                        $('#listproperties').html(data.errors);
                        }
                        else
                        {
                        ('#listproperties').append(data.errors);
                        }
                        isDataAvailable = false;
                        }
                        else
                        {
                            if(data.searchdestname != undefined) {
                                $(".ai_search_keywords").val(data.searchdestname);
                            }
                            
                            /*
                             * Slider HTML
                             */
                            
                            var sliderHTML = '';
                            
                            if(data.categoryslider) {
                                if(data.categoryslider.length > 0) {
                                    sliderHTML += '<div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: \'slice-up\', autoplay: true}" style="margin-bottom:20px;margin-top:00px;">';
                                    sliderHTML += '<ul style="" class="uk-slideshow uk-overlay-active">';
                                    var activeClass = 'uk-active';
                                    for(var si = 0; si < data.categoryslider.length; si++) {
                                        if(si != 0) {
                                            activeClass = '';
                                        }
                                        sliderHTML += '<li class="ai-uk-animation ' + activeClass + ' " aria-hidden="true">';
                                            if(data.categoryslider[si].slide_type == 'Image') {
                                                sliderHTML += '<div style="background-image: url({{ URL()}}/uploads/slider_images/' + data.categoryslider[si].slider_img + ');" class="uk-cover-background uk-position-cover"></div>';
                                            }
                                            else {
                                                sliderHTML += '<div  class="uk-cover-background uk-position-cover"> <iframe class="video-bg"  src="https://www.youtube.com/embed/' + data.categoryslider[si].slider_video + '?playlist=' + data.categoryslider[si].slider_video + '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
                                            }
                                            sliderHTML += '<canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>';
                                            sliderHTML += '<div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">';
                                                sliderHTML += '<div>';
                                                    sliderHTML += '<ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">';
                                                        sliderHTML += '<li>';
                                                            sliderHTML += '<span><a href="#" rel="category tag">' + data.categoryslider[si].slider_category + '</a></span>';
                                                        sliderHTML += '</li>';
                                                    sliderHTML += '</ul>';
                                                    sliderHTML += '<h3 class="bh-slideshow-overlay-title">';
                                                        sliderHTML += '<a href="#">' + data.categoryslider[si].slider_title + '</a>';
                                                    sliderHTML += '</h3>';
                                                    sliderHTML += '<div class="bh-slideshow-overlay-content">' + data.categoryslider[si].slider_description + '</div>';
                                                    if(data.categoryslider[si].slider_link != '#') {
                                                        sliderHTML += '<a class="uk-margin-top uk-button uk-button-primary" href="http://' + data.categoryslider[si].slider_link + '" title="Do it yourself">Discover <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>';
                                                    }
                                                sliderHTML += '</div>';
                                            sliderHTML += '</div>';
                                            sliderHTML += '<div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">';
                                                sliderHTML += '<div>';
                                                    sliderHTML += '<ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">';
                                                        sliderHTML += '<li>';
                                                            sliderHTML += '<span><a href="#" rel="category tag">' + data.categoryslider[si].slider_category + '</a></span>';
                                                        sliderHTML += '</li>';
                                                    sliderHTML += '</ul>';
                                                    sliderHTML += '<h3 class="bh-slideshow-thumbnail-split-preview-title">';
                                                        sliderHTML += '<a href="#">' + data.categoryslider[si].slider_title + '</a>';
                                                    sliderHTML += '</h3>';
                                                    sliderHTML += '<div class="bh-slideshow-thumbnail-split-preview-content">' + data.categoryslider[si].slider_description + '</div>';
                                                    if(data.categoryslider[si].slider_link != '#') {
                                                        sliderHTML += '<a class="uk-margin-top uk-button uk-button-primary" href="http://' + data.categoryslider[si].slider_link + '">Discover <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>';
                                                    }
                                                sliderHTML += '</div>';
                                                sliderHTML += '<a href="javascript:void(0);" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>';
                                                sliderHTML += '<a href="javascript:void(0);" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>';
                                            sliderHTML += '</div>';
                                        sliderHTML += '</li>';
                                    }
                                    sliderHTML += '</ul>';
                                    sliderHTML += '</div>';
                                    sliderHTML += '<script type="text/javascript" src="<?php echo asset('sximo/assets/js/slideshow.js'); ?>"><\/script>';
                                }
                            }
                            $(".grid-page-category-slider-container").html( sliderHTML );
                            $('.uk-slideshow:first-child .ai-uk-animation .bh-slideshow-thumbnail-split-preview').delay(3000).fadeIn(5000);
                            $('.ai-uk-animation:first .bh-slideshow-thumbnail-split-preview').addClass('uk-animation-fade');
                        html += '<div class="row animate-bottom">';
                        var p = 1;
                        var node_no = 1;
                        var total_rows = 0;

                        $.each($.parseJSON(data.properties), function(idx, obj) {

                            /*html +='<li class="grid-item wow fadeInUp">';
                                        html +='<a href="{{URL::to('/')}}/'+obj.pdata.property_slug+'">';
                                        html +='<figure>';
                                        html +='<div class="portfolio-img bg-deep-pink">';           
                                        if (obj.hasOwnProperty("image")) {
                                             var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
                                        html +='<img alt="'+obj.pdata.property_name+'" src="'+pimg+'">';
                                        }else{
                                             html +='<img src="http://placehold.it/800x560" alt=""/>';
                                        }
                                        html +='</div>';
                                        html +='<figcaption>';
                                        html +='<div class="portfolio-hover-main text-left">';
                                        html +='<div class="portfolio-hover-box vertical-align-bottom">';
                                        html +='<div class="portfolio-hover-content position-relative last-paragraph-no-margin">';
                                        html +='<span class="font-weight-600 line-height-normal alt-font text-white text-uppercase margin-one-half-bottom display-block">'+obj.pdata.property_name+'</span>';
                                        if (obj.pdata.price != ''){
                                            html +='<p class="text-white text-uppercase text-extra-small">From € '+obj.pdata.price+' </p>';
                                        }
                                        html +='</div>';
                                        html +='</div>';
                                        html +='</div>';
                                        html +='</figcaption>';
                                        html +='</figure>';
                                        html +='</a>';
                                        html +='<div class="listDetails">';
                                        html +='<div class="photographBox ai-grid-tiitles">';
                                        html +='<h2>';
                                        html +='<a title="'+obj.pdata.property_name+'" class="photograph FltLft ai-filtreted-hotel-name" rel="'+obj.pdata.id+'" href="{{URL::to('/')}}/'+obj.pdata.property_slug+'">';
                                        html +=obj.pdata.property_name;
                                        html +='</a>';
                                        html +='<span class="FltRgt">';
                                        html +='<a class="carticon" href="javascript:void(0)" onclick="submitgridbookform(\''+obj.pdata.property_slug+'#*'+obj.pdata.id+'\');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
                                        html +='</span>';
                                        html +='</h2>';
                                        html +='</div>';
                                        html +='<div class="entire_story MrgTop5 ai-view-hotels-tittle">';
                                        html +='<a class="textButton arrowButton detail_view MrgTop5" rel="'+obj.pdata.id+'" href="#">Quick View</a>';
                                        html +='</div>';
                                        html +='<div class="showOnHover">';
                                        html +='<div class="hover_request">';
                                        html +='</div>';   
                                        html +='</div>';
                                        html +='</div>';
                                        html +='</li>';*/

                        if (node_no % 20 == 0) {
                        html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                        html += 'Advertisement Here';
                        html += '</div>';
                        }
                        else {
                        html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                        html += '<div class="wrapperforliineedforlightboxremoval">';
                        html += '<div class="cat_product_medium1">';
                        html += '<div class="ai-grid-page-node-pic-box pictureBox gridPicture grid-box-main">';
                        if (obj.pdata.price != '')
                        {
                            if($("#filter_min_price").val() != '' && $("#filter_max_price").val() != '') {
                                html += '<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="' + obj.pdata.id + '" href="' + detail_link + '"> From EUR ' + obj.pdata.price + ' / night </a>';
                            }
                        }
                        if (obj.hasOwnProperty("image")) {
                			if(obj.pdata.editor_choice_property=='1'){
                				var edtch = "{{URL::to('sximo/images/editors-choice.png')}}";
                				html += '<img alt="editor_choice_property" class="propovericons" src="'+edtch+'">';
                			}else if(obj.pdata.feature_property=='1'){
                				var featp = "{{URL::to('sximo/images/featured-property.png')}}";
                				html += '<img alt="editor_choice_property" class="propovericons" src="'+featp+'">';
                			}
                           var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
                            html += '<a title="' + obj.pdata.property_name + '" class="picture_link " rel="' + obj.pdata.id + '" href="{{URL::to('')}}/' + obj.pdata.property_slug + '">';
                            html += '<div class="overlay-text-frezeed">';
                            html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                            html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;' + obj.pdata.price + ' </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                            html += '</div>';
                            html += '<div class="overlay-text hotel-overlay-text">';
                            html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                            html += '<p class="yacths-des-text yacths-des-text-align"><span>From &euro;' + obj.pdata.price + ' </span><' + obj.pdata.category_name + '</span></p>';
                            html += '</div>';
                            html += '<div class="overlay-text yacts-overlay-text">';
                            html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                            html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;' + obj.pdata.price + ' </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                            html += '<p class="yacths-des-text">2015H</p>';
                            html += '</div>';
                            html += '<img alt="' + obj.image.file_name + '" src="' + pimg + '" class="img-responsive">';
                            html += '</a>';

                        } else{
                            
                            var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
                            html += '<div class="overlay-text-frezeed">';
                            html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                            html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                            html += '</div>';
                            html += '<div class="overlay-text hotel-overlay-text">';
                            html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                            html += '<p class="yacths-des-text yacths-des-text-align"><span>From &euro;' + obj.pdata.price + ' </span>|<span>New York</span></p>';
                            html += '</div>';
                            html += '<div class="overlay-text yacts-overlay-text">';
                            html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                            html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                            html += '<p class="yacths-des-text">2015H</p>';
                            html += '</div>';
                            html += pimg;
                        }

                        html += '</div>';
                        html += '<div class="listDetails">';
                        html += '<div class="photographBox ai-grid-tiitles">';
                        html += '<h2>';
                        var detail_link = "{{URL::to('')}}/" + obj.pdata.property_slug;
                        html += '<a title="' + obj.pdata.property_name + '" class="FltLft ai-filtreted-hotel-name" rel="' + obj.pdata.id + '" href="' + detail_link + '">';
                        html += obj.pdata.property_name;
                        html += '</a>';
                        html += '<span class="FltRgt">';
                        if (obj.hasOwnProperty("image")) {
                        html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" onclick="add_to_lightbox(' + obj.image.file_id + ',' + obj.pdata.id + ');" ></i>';
                        }
                        else{
                        html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" ></i>';
                        }
                        html += '<a class="carticon" href="' + detail_link + '"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
                        html += '</span>';
                        html += '</h2>';
                        html += '</div>';
                        html += '<div class="entire_story MrgTop5 ai-view-hotels-tittle">';
                        html += '<a class="textButton arrowButton detail_view MrgTop5" rel="' + obj.pdata.id + '" href="#">Quick View</a>';
                        html += '<a class="textButton arrowButton MrgTop5" rel="' + obj.pdata.id + '" href="' + detail_link + '">Detail View </a>';
                        html += '</div>';
                        html += '<div class="showOnHover">';
                        html += '<div class="hover_request">';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        if (p % 4 == 0)
                        {
                        html += '</div>';
                        html += '<div class="row">';
                        }
                        }
                        p++;
                        node_no++;
                        total_rows++;
                        });
                        if(total_rows>0){
                            $('.locator').parent().css('padding-top','0px');
                        }
                        $(".searchcount").html(data.ttl + ' Hotel(s) Found for ' + $(".ai_search_keywords").val());
                        html += '</div>';
                        if (it_scroll == false)
                        {
                        $('#listproperties').html(html);
                        }
                        else{
                        $('#listproperties').append(html);
                        }
                        if (destnarea != '')
                        {
                            if (dest_area[1] == 'country' || dest_area[1] == 'region'){
                            $('#cityfilters').html('');
                            }
                            var ttp = p - 1;
                            if (typeof $.parseJSON(data.cities) !== 'undefined' && $.parseJSON(data.cities).length > 0) {

                                chtml += '<div class="row" style="padding-bottom: 8px;background: #f0f0f0;padding-top: 8px;margin-bottom: 15px;">';
                                chtml += '<div class="col-md-6 col-xs-12 text-right">Filter By Luxury Destination</div>';
                                chtml += '<div class="col-md-6 col-xs-12">';
                                chtml += '<select onchange="filter_destination(this.value ,\'city\')">';
                                $.each($.parseJSON(data.cities), function(idx, cobj) {
                                    chtml += '<option value="' + cobj.id + '">' + cobj.category_name + '(' + cobj.totalproperty + ')</option>';
                                })
                                chtml += '</select>';
                                chtml += '</div>';
                                chtml += '</div>'; 
                                /*chtml += '<div class="row">';
                                chtml += '<div class="col-md-12">';
                                chtml += '<div class="clear-all-filters"><a href="javascript:void(0)"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear Filters</a></div>';
                                chtml += '<div>';
                                chtml += '<ul class="top-nav-cities-filter top-slick-filtes top-bar-filters-removed regular slider">';
                                chtml += '<li class="active select-all">';
                                chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + dest_area[0] + '\',\'city\');">';
                                chtml += '<div class="filter-bg">';
                                chtml += '<div class="right-text"></div>';
                                chtml += '<div class="clearfix"></div>';
                                chtml += '<div class="top-filter-name">All Properties(' + ttp + ')</div>';
                                chtml += '</div>';
                                chtml += '</a>';
                                chtml += '<div style="display: none;" class="city-filter-node-overlay">';
                                chtml += '<a class="city-filter-node-heading">Heading</a>';
                                chtml += '<div class="city-filter-node-details">Testing testing testing testing testing testing testing</div>';
                                chtml += '</div>';
                                chtml += '</li>';
                                $.each($.parseJSON(data.cities), function(idx, cobj) {
                                    var cimg = "{{URL::to('uploads/category_imgs/')}}/" + cobj.category_image;
                                    chtml += '<li>';
                                    chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + cobj.id + '\',\'city\');">';
                                    //chtml += '<div class="filter-bg" stysle="background-image: url(\'' + cimg + '\');">';
                                    chtml += '<div class="filter-bg" >';
                                    chtml += '<div class="right-text"></div>';
                                    chtml += '<div class="clearfix"></div>';
                                    chtml += '<div class="top-filter-name">' + cobj.category_name + '(' + cobj.totalproperty + ')</div>';
                                    chtml += '</div>';
                                    chtml += '</a>';
                                    chtml += '<div style="display: none;" class="city-filter-node-overlay">';
                                    chtml += '<a class="city-filter-node-heading">Heading</a>';
                                    chtml += '<div class="city-filter-node-details">Testing testing testing testing testing testing testing</div>';
                                    chtml += '</div>';
                                    chtml += '</li>';
                                });
                                chtml += '</ul>';
                                chtml += '</div>';
                                chtml += '</div>';
                                chtml += '</div>';
                                chtml += '<script>';
                                chtml += '$(\'.top-nav-cities-filter\').slick({';
                                    chtml += 'slide: \'li\',';
                                    chtml += 'dots: false,';
                                    chtml += 'infinite: false,';
                                    chtml += 'slidesToShow: 3,';
                                    chtml += 'slidesToScroll: 1,';
                                    chtml += 'cssEase: \'ease-out\',';
                                    chtml += 'variableWidth: false,';
                                    chtml += 'responsive: [';
                                        chtml += '{';
                                            chtml += 'breakpoint: 1024,';
                                            chtml += 'settings: {';
                                                chtml += 'slidesToShow: 3,';
                                                chtml += 'slidesToScroll: 1,';
                                            chtml += '}';
                                        chtml += '},';
                                        chtml += '{';
                                            chtml += 'breakpoint: 600,';
                                            chtml += 'settings: {';
                                                chtml += 'slidesToShow: 2,';
                                                chtml += 'slidesToScroll: 1';
                                            chtml += '}';
                                        chtml += '},';
                                        chtml += '{';
                                            chtml += 'breakpoint: 480,';
                                            chtml += 'settings: {';
                                                chtml += 'slidesToShow: 1,';
                                                chtml += 'slidesToScroll: 1,';
                                                chtml += 'arrows:false,';
                                            chtml += '}';
                                        chtml += '}';
                                    chtml += ']';
                                chtml += '});';
                                chtml += '$(document).on(\'click\', \'.top-slick-filtes li.select-all\', function () {';
                                    chtml += 'if ($(this).hasClass("active")) {';
                                        chtml += '$(\'.top-slick-filtes li\').addClass("active");';
                                        chtml += '$(this).removeClass("active");';
                                    chtml += '} else {';
                                        chtml += '$(\'.top-slick-filtes li\').removeClass("active");';
                                        chtml += '$(this).addClass("active");';
                                    chtml += '}';
                                chtml += '});';
                                chtml += '$(document).on(\'click\', \'.top-slick-filtes li\', function () {';
                                    chtml += 'if (!$(this).hasClass("select-all")) {';
                                        chtml += '$(this).toggleClass("active");';
                                        chtml += '$(\'.top-slick-filtes li.select-all\').removeClass("active");';
                                    chtml += '}';
                                chtml += '});';
                                chtml += '$(document).on(\'click\', \'.clear-all-filters a\', function (event) {';
                                    chtml += 'event.preventDefault();';
                                    chtml += '$(\'.top-slick-filtes li\').removeClass("active");';
                                    chtml += '$(\'.top-slick-filtes li.select-all\').addClass("active");';
                                chtml += '});';
                                chtml += '<\/script>';*/
                                $('#cityfilters').html(chtml); 
                            }

                            var searchcountdispl = data.ttl + ' Hotel(s) Found for ' + $(".ai_search_keywords").val();
                            $('.searchcount').html(searchcountdispl);
                        }

                        sIndex = parseInt(sIndex) + offSet;
                        $('#listrecrds').val(sIndex);
                        $('#ttlpg').val(data.ttlpages);
                        isPreviousEventComplete = true;
                        }
                         
        },
        error: function (error) {
//        alert(error);
        }
});
}
}
                    </script>
                    <script>
                        function clear_all_filters() {
                            
                            var $slider = $("#slider-range");
                            $slider.slider( "option", "min", 0 );
                            $slider.slider( "option", "max", 6000 );
                            
                            $(".ai_search_keywords").val('{{$keyword}}');
                            $(".ai-arrive-date-filter").val('<?php echo date('d-m-Y'); ?>');
                            $(".ai-depart-date-filter").val('<?php echo date('d-m-Y', strtotime('+ 1 day')); ?>');
                            $("#filter_min_price").val('');
                            $("#filter_max_price").val('');
                            $(".ai-current-filter").val('');
                            $('#selDestn').val('');
                            $('#listrecrds').val(0);
                            $('#nxtpg').val('2');
                            $('#amount').val('1');
                            var it_scroll = false;
                            scrollDownloadData(it_scroll);
                            $('#listrecrds').val(21);
                        }
                        function filter_destination(destn, area) {
                            if (destn != '' && destn > 0) {
                                $('#selDestn').val(destn + '#:' + area);
                                $('#listrecrds').val(0);
                                $('#nxtpg').val('1');
                                $(".ai-current-filter").val('destination');
                                var it_scroll = false;
                                scrollDownloadData(it_scroll);
                                $('#listrecrds').val(21);
                            }
                        }

                        function filter_property() {
                        $('#filter_min_price').val('0');
                        $('#filter_max_price').val(6000 - +$("#slider-range").slider("value"));
                        $('#listrecrds').val(0);
                        $('#nxtpg').val('1');
                        var it_scroll = false;
                        scrollDownloadData(it_scroll);
                        $('#listrecrds').val(21);
                        }

                        function experience_property_filter( keywords ) {
                            $(".ai-current-filter").val('experience');
                            $(".ai_search_keywords").val(keywords);
                            $('#listrecrds').val(0);
                            $('#listrecrds').val(0);
                            $('#nxtpg').val('1');
                            var it_scroll = false;
                            scrollDownloadData(it_scroll);
                            $('#listrecrds').val(21);
                            return false;
                        }

                        $(document).ready(function () {
                            $(".ai-ajax-searchform-navbar").submit(function ( event ){
                                event.preventDefault();
                                $("#search-navbar.ai-ajax-search-input").typeahead('close');
                                $(".ai_search_keywords").val($("#search-navbar.ai-ajax-search-input").val());
                                $('#listrecrds').val(0);
                                $('#listrecrds').val(0);
                                $('#nxtpg').val('1');
                                var it_scroll = false;
                                scrollDownloadData(it_scroll);
                                $('#listrecrds').val(21);
                            });
                            $(".ai-date-filters").submit(function ( event ){
                                event.preventDefault();
                                $(".ai-arrive-date-filter").val($(this).find(".ai-arrive-date").val());
                                $(".ai-depart-date-filter").val($(this).find(".ai-depart-date").val());
                                $('#listrecrds').val(0);
                                $('#listrecrds').val(0);
                                $('#nxtpg').val('1');
                                var it_scroll = false;
                                scrollDownloadData(it_scroll);
                                $('#listrecrds').val(21);
                            });
							
							$('.searchbox_landing').on('typeahead:selected', function (e, datum) {
								var propname = $(this);
								$.ajax({
									url: "{{ URL::to('find_property_by_name')}}",
									type: "post",
									data: 'pname=' + propname.val(),
									dataType: "json",
									success: function (data) {
										if (data.status == 'error')
										{
											propname.parents('.searchform-navbar').submit();
											return;
											propname.parents('.searchform-navbar').submit();
										} else
										{
											var obj = JSON.parse(data.property);
											window.location.href = "{{URL::to('')}}/" + obj.property_slug;
										}
									}
								});
							});
                        });
                    </script>
                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="filter-grid-page-side-bar">
                                <div class="filters-gird-page-side-bar-filter-align">
                                    <div class="design-locations-logo">
                                        <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                    </div>
                                    <div class="design-locations-logo filters-page-serch-bar-align">
                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar ai-ajax-searchform-navbar" action="{{URL::to('search')}}">
                                            <input  class="bh-search-input typeahead search-navbar ai-ajax-search-input" name="s" id="search-navbar" placeholder="SEARCH" type="text">
                                            <input class="hidden" type="submit" value="Submit" />
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#filter-by-price" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">Filter BY Price</div>
                                            </a>
                                            <div id="filter-by-price" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div class="filter-by-price">
                                                            <div id="slider-range" class="filter-slider"></div>
                                                            <p>
                                                                <span class="price-high-low-filter-text">High - Low</span>
                                                                <input class="friltered-price" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                                                                <input id="filter_min_price" type="hidden" value="" />
                                                                <input id="filter_max_price" type="hidden" value="" />
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(!isset($_REQUEST['landing_page']) && !isset($_REQUEST['destination_page'])): ?>
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#book-your-destination" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Book Your Destination
                                                </div>
                                            </a>
                                            <div id="book-your-destination" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div>
                                                            <form class="filter-menu-booking ai-date-filters" action="{{url::to('search')}}">
                                                                <input name="s" value="<?php echo (isset($_REQUEST['s'])) ? $_REQUEST['s'] : '' ?>" type="hidden" />
                                                                <input name="adult" value="<?php echo (isset($_REQUEST['adult'])) ? $_REQUEST['adult'] : '1' ?>" type="hidden" />
                                                                <input name="childs" value="<?php echo (isset($_REQUEST['childs'])) ? $_REQUEST['childs'] : '0' ?>" type="hidden" />
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Arrive</label>
                                                                    <input id="filter-date-mobile" class="ai-arrive-date" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="arrive" value="<?php echo (isset($_REQUEST['arrive'])) ? date('d-m-Y', strtotime($_REQUEST['arrive'])) : date("d-m-Y"); ?>" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Depart</label>
                                                                    <input id="filter-date-mobile-departure" class="ai-depart-date" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="destination" value="<?php echo (isset($_REQUEST['destination'])) ? date('d-m-Y', strtotime($_REQUEST['destination'])) : date("d-m-Y", strtotime("+ 1 day")); ?>" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <input class="black-submit-btn" value="Search" type="submit">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(!isset($_REQUEST['destination_page']) && !isset($_REQUEST['arrive'])): ?>
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Experience
                                                </div>
                                            </a>
                                            <div id="collapse1" class="panel-collapse <?php echo (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('Beach Hotels', 'Green Properties', 'Go Urban Hotels', 'Infinity Pools', 'Spa and Wellness Hotels', 'Mountain Ski Resorts', 'Yoga Hotels', 'Culinary Delights', 'Family Friendly', 'Unusual Adventure Hotels')))? 'in' : ''; ?> collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <form>
														
															@if(!empty($experiences))
																@foreach($experiences as $experience)
																	<div class="form-group post-filter-inputs">
																		<label><a onclick="experience_property_filter('{{$experience->category_name}}');" href="javascript:void(0);">{{$experience->category_custom_title}}</a></label>
																	</div>
																@endforeach
															@endif
															<!--<div class="form-group post-filter-inputs">
																<label><a onclick="experience_property_filter('Beach Hotels');" href="javascript:void(0);">Luxury Beach Hotels</a></label>
															</div>
                                                            <div class="form-group post-filter-inputs post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Green Properties');" href="javascript:void(0);">Luxury Green Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Go Urban Hotels');" href="javascript:void(0);">Luxury Urban Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Infinity Pools');" href="javascript:void(0);">Luxury Infinity Pools</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Spa and Wellness Hotels');" href="javascript:void(0);">Luxury Spa and Wellness Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Mountain Ski Resorts');" href="javascript:void(0);">Luxury Mountains and Skin Resorts</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Yoga Hotels');" href="javascript:void(0);">Discover Yoga Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Culinary Delights');" href="javascript:void(0);">Discover culinary Delight Hotels</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Family Friendly');" href="javascript:void(0);">Discover Family Friendly Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Unusual Adventure Hotels');" href="javascript:void(0);">Unusual Adventure Hotels</a></label>
                                                            </div>-->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <input type="hidden" id="selDestn" value="">
                                        <input type="hidden" id="listrecrds" value="21">
                                        <?php if(!isset($_REQUEST['landing_page']) && !isset($_REQUEST['arrive'])): ?>
                                        @if(!empty($ourmaindesitnation))
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#maindestinations" class="heading-stying {{($continent!='') ? '' : 'collapsed' }}">
                                                <div class="panel-heading custom-heading">
                                                    Destinations
                                                </div>
                                            </a>
                                            <div id="maindestinations" class="panel-collapse collapse {{($continent!='') ? 'in' : '' }}">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <!--First Parent-->
                                                        @foreach($ourmaindesitnation as $mndest)
                                                        <div class="node post-filter-inputs">
                                                            <a class="node-btn" href="javascript:void(0)" onclick="$('#maindestinations a.node-btn').removeClass('active');$(this).addClass('active');filter_destination('{{$mndest->id}}', 'continent');">{{$mndest->category_name}}</a>
                                                            @if(array_key_exists('childs',$mndest) && !empty($mndest->childs))
                                                            @foreach($mndest->childs as $cddest)
                                                            <!--Second Level-->
                                                            <div class="node" style="{{($continent==$mndest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
                                                                <a class="node-btn" href="javascript:void(0)" onclick="$('#maindestinations a.node-btn').removeClass('active');$(this).addClass('active');filter_destination('{{$cddest->id}}', 'region');">{{$cddest->category_name}}</a>
                                                                @if(array_key_exists('subchild',$cddest))
                                                                @foreach($cddest->subchild as $sbdest)
                                                                <!--Third Level-->
                                                                <div class="node" style="{{(str_replace('_',' ',$region)==$cddest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
                                                                    <a class="node-btn" href="javascript:void(0)" onclick="$('#maindestinations a.node-btn').removeClass('active');$(this).addClass('active');filter_destination('{{$sbdest->id}}', 'country');">{{$sbdest->category_name}}</a>
                                                                    @if(array_key_exists('subchild',$sbdest))
                                                                    @foreach($sbdest->subchild as $subchild)
                                                                    <div class="node" style="{{(isset($cat) && str_replace('_',' ',$cat)==$sbdest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
                                                                        <a class="node-btn" href="javascript:void(0)" onclick="$('#maindestinations a.node-btn').removeClass('active');$(this).addClass('active');filter_destination('{{$subchild->id}}', 'country');">{{$subchild->category_name}}</a>
                                                                    </div>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <?php endif; ?>
                                    </div> 
                                    <div class="filter-footer">
<!--                                        <div><a href="#" >View All Locations On Map</a></div>-->
                                        <div class="clear-all-filters"><a onclick="javascript:clear_all_filters();" href="javascript:void(0);"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear All</a></div>
                                    </div>
                                    <section class="regular slider">
                                        <div class="slick-cstm-width">
                                            <div class="side-bar-why-book-with-us">
                                                <div class="book-with-us-tittles">
                                                    <h2>Why book with us?</h2>
                                                </div>
                                                <ul class="side-bar-book-with-us-list">
                                                    @if(!empty($whybookwithus))
														@foreach($whybookwithus as $withus)
															<li>
																<h3>{{$withus->title}}</h3>
																<p>{{$withus->sub_title}}</p>
															</li>
														@endforeach
													@endif
                                                </ul>
                                            </div>
                                        </div>
                                        @if(!empty($sidebargridAds))
											@foreach($sidebargridAds as $slides)
												<div class="slick-cstm-width">
													<a href="{{ (strpos($slides->adv_link, 'http://') !== false) ? $slides->adv_link : 'http://'.$slides->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$slides->adv_img)}}"></a>
												</div>
											@endforeach
                                        @endif
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="clearfix"></div>
					<div id="frontpage-layer-bj-detail" class="frontpage-layer-bj">
						<div id="frontpage-layer-bj-header-wrapper">
							<div id="frontpage-layer-bj-header">
								<a href="#" id="frontpage-layer-bj-header-logo"> <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive yachts-pop-up-logo"></a>
							</div>
							<span id="frontpage-layer-bj-header-close" class="frontpage-layer-bj-header-close"></span>
						</div>
						<div id="frontpage-layer-bj-content">
							<div class="frontpage-detail-content-top">
								<div class="frontpage-detail-content-top-link">
									<div class="frontpage-detail-content-top-link">

									</div>
								</div>
							</div>
							<div id="placepopupcontent">
							
							</div>
							
						</div>	
					</div>
                    <form action="{{url()}}" method="get" id="gridbookform">
						<input type="hidden" name="property" id="bookformproperty" value="" />
                        <input type="hidden" name="roomType" id="roomType" value="" />
                        <input name="arrive" value="{{ date('d.m.Y') }}" type="hidden" />
						<input name="destination" value="" type="hidden" />
                        <input name="booking_adults" value="1" type="hidden" />
						<input name="booking_children" value="0" type="hidden" />
					</form>
                    <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
                    <script type="text/javascript">
					
						function submitgridbookform(propdt)
						{
							if(propdt!='')
							{
								var pros = propdt.split("#*");
								$('#bookformproperty').val(pros[1]);
								$('#gridbookform').attr('action','{{url()}}/book-property/' +pros[0]);
								$('#gridbookform').submit();
							}
						}
						$(document).on('ready', function () {


                            $('.top-nav-cities-filter').slick({
                                slide: 'li',
                                dots: false,
                                infinite: false,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                cssEase: 'ease-out',
                                variableWidth: false,
                                autoplay:false,
                                responsive: [
                                    {
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 600,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1
                                        }
                                    },
                                    {
                                        breakpoint: 480,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1,
                                            arrows:false,
                                        }
                                    }
                                ]
                            });
                            $(document).on('click', '.top-slick-filtes li.select-all', function () {
                                if ($(this).hasClass("active")) {
                                    $('.top-slick-filtes li').addClass("active");
                                    $(this).removeClass("active");
                                } else {
                                    $('.top-slick-filtes li').removeClass("active");
                                    $(this).addClass("active");
                                }
                            });
                            $(document).on('click', '.top-slick-filtes li', function () {
                                if (!$(this).hasClass("select-all")) {
                                    $(this).toggleClass("active");
                                    $('.top-slick-filtes li.select-all').removeClass("active");
                                }
                            });
                            $(document).on('click', '.clear-all-filters a', function (event) {
                                event.preventDefault();
                                $('.top-slick-filtes li').removeClass("active");
                                $('.top-slick-filtes li.select-all').addClass("active");
                            });    

							$(".regular").slick({
								dots: false,
								infinite: true,
								slidesToShow: 1,
								slidesToScroll: 1,
								prevArrow: false,
								nextArrow: false,
								autoplay: true,
								autoplaySpeed: 3000
							});
						});
                    </script>
					<script>
						$(document).ready(function () {

						$('#quick_pager_header').mouseover(function () {
						$('.flyoutBox').show();
						});
						$('.flyoutBox').mouseover(function () {
						$('.flyoutBox').show();
						});
						$('#quick_pager_header').mouseout(function () {
						$('.flyoutBox').hide();
						});
						$('.flyoutBox').mouseout(function () {
						$('.flyoutBox').hide();
						});
						$(document).on('click', '.detail_view', function(){
						$('#frontpage-layer-bj').fadeOut('slow');
						$('#frontpage-detail-tile').html('');
						$.ajax({
						url: "{{ URL::to('getproperty')}}" + '/' + $(this).attr('rel'),
								type: "get",
								success: function(data){
								var imagesPro = '';
								imagesPro += '<div class="detail-tile-inner ai-haeding-bg-style">';
								imagesPro += '<h3 class="popup-property-title">' + data.data.property_name + '</h3>';
								imagesPro += '<p class="popup-property-desc" style="text-align:left; margin: 0 30px; font-size:14px;">' + data.data.about_property + '</p>';
								imagesPro += '</div>';
								imagesPro += '<ul class="clearfix frontpage-detail-tiles" id="frontpage-detail-tiles-detail">';
								$(data.image).each(function(i, val){
								//console.log(val);
								imagesPro += '<li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible">';
								imagesPro += '<div class="detail-tile-inner">';
								imagesPro += '<img src="' + val.imgsrc + val.file_name + '"/>';
								/*imagesPro+='<a href="#" id="LearnMoreBtn1" onclick="add_to_lightbox('+val.id+','+data.data.id+');">Add to lightbox</a>';*/
								imagesPro += '</div>';
								imagesPro += '</li>';
								});
								imagesPro += '</ul>';
								var formlink = "{{url()}}/book-property/" + data.data.property_slug + "}}";
								imagesPro += '<div class="editorial-book-now-page sec-differentiate-line " id="book-now">';
								imagesPro += '<form class="detail-page-booking-form" action="'+formlink+'" method="get">';
								imagesPro += '<input type="hidden" name="property" id="property" value="' + data.data.id + '" />';
								imagesPro += '<input type="hidden" name="roomType" id="roomType" value="" />';
								imagesPro += '<div class="book-now-page-content-">';
								imagesPro += '<div class="editoral-book-page-headings">';
								imagesPro += '<h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>';
								imagesPro += '<p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>';
								imagesPro += '</div>';
								imagesPro += '<ul class="dates" id="editorial-book-now-inputs">';
								imagesPro += '<li>';
								imagesPro += '<div class="editorail-heading">Arrive</div>';
								imagesPro += '<input id="date-range-editorial-arrive" name="arrive" class="datePicker- dateFrom-" value="{{ date("d.m.Y") }}" type="text" />';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<div class="heading">Departure</div>';
								imagesPro += '<input id="date-range-editorial-destination" name="destination" class="datePicker- dateFrom-" value="" type="text" />';
								imagesPro += '</li>';
								imagesPro += '</ul>';
								imagesPro += '<ul class="dates">';
								imagesPro += '<li>';
								imagesPro += '<div class="heading">Adults</div>';
								imagesPro += '<select name="booking_adults">';
								imagesPro += '<option>1</option>';
								imagesPro += '<option>2</option>';
								imagesPro += '<option>3</option>';
								imagesPro += '</select>';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<div class="heading">Children</div>';
								imagesPro += '<select name="booking_children">';
								imagesPro += '<option>0</option>';
								imagesPro += '<option>1</option>';
								imagesPro += '<option>2</option>';
								imagesPro += '</select>';
								imagesPro += '</li>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '</ul>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '<div class="editorial-submit-btn">';
								imagesPro += '<button type="submit">BOOK NOW</button>';
								imagesPro += '</div>';
								imagesPro += '<div class="view-modify-cancel-booking">';
								imagesPro += '<a href="#">View, Modify or Cancel your Booking</a>';
								imagesPro += '</div>';
								imagesPro += '<ul class="booking-page-footer-section editorial-book-align" >';
								imagesPro += '<li>';
								imagesPro += '<a href="#" target="_blank">';
								imagesPro += '<span>Join the worlds leading luxury club</span>';
								imagesPro += '<h6 class="center">Enjoy exclusive members only benefits</h6>';
								imagesPro += '</a>';
								imagesPro += '<div class="white-border-bottom"></div>';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<a href="#" target="_blank">';
								imagesPro += '<span>Spa Treatment</span>';
								imagesPro += '<h6 class="center">Book</h6>';
								imagesPro += '</a>';
								imagesPro += '<div class="white-border-bottom"></div>';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<a href="#" target="_blank">';
								imagesPro += '<span>View or Modify Reserveration</span>';
								imagesPro += '<h6 class="center">Login to Support Center</h6>';
								imagesPro += '</a>';
								imagesPro += '<div class="white-border-bottom"></div>';
								imagesPro += '</li>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '</ul>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '</div>';
								imagesPro += '</form>';
								imagesPro += '</div>';
								$('#placepopupcontent').html(imagesPro);
								
                                                                        /*Toggle Side Nav Start Here*/
                                                                        eval($('.dropdown').each(function () {
                                                                            var $dropdown = $(this);
                                                                            $(".members-list", $dropdown).click(function (e) {
                                                                                e.preventDefault();
                                                                                $div = $(".members-drop-list", $dropdown);
                                                                                $div.toggle();
                                                                                $(".members-drop-list").not($div).hide();
                                                                                return false;
                                                                            });
                                                                        }));

									eval($("#adult-input-value").change(function () {
										var adults = $(this).val();
										$('#adults-val').html(adults);
									}));

									eval($("#childerns-input-value").change(function () {
										var childerns = $(this).val();
										$('#childern-val').html(childerns);
									}));
									
									eval($('#book-hotel1').dateRangePicker({
										startDate: "2017-01-11",
										separator: ' to ',
										getValue: function () {
										if ($('#book-hotel1').val() && $('#book-hotel2').val())
											return $('#book-hotel1').val() + ' to ' + $('#book-hotel2').val();
										else
											return '';
										},
										setValue: function (s, s1, s2) {
											$('#book-hotel1').val(s1);
											$('#book-hotel2').val(s2);
										}
									}));
									eval($('#book-hotel2').dateRangePicker({
										startDate: "2017-01-11",
										separator: ' to ',
										getValue: function () {
										if ($('#book-hotel1').val() && $('#book-hotel2').val())
											return $('#book-hotel1').val() + ' to ' + $('#book-hotel2').val();
										else
											return '';
										},
										setValue: function (s, s1, s2) {
											$('#book-hotel1').val(s1);
											$('#book-hotel2').val(s2);
										}
									}));
								
								}
						});
						$('#frontpage-layer-bj-detail').fadeIn('slow');
						$('#fixed_wrapper').hide();
						$('html').addClass('hidescroll');
						$('body').addClass('layerloaded');
						return false;
						});
						$('.frontpage-layer-bj-header-close').click(function () {
						$('.frontpage-layer-bj').fadeOut('slow');
						$('#fixed_wrapper').show();
						$('html').removeClass('hidescroll');
						});
						});
					</script>
                    <script>
                        $(document).ready(function () {
                        $(".social-share").click(function (event) {
                        event.preventDefault();
                        $(this).find("ul").toggle();
                        $(this).toggleClass("open");
                        });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                        $("header .menu > a").click(function (event) {
                        event.preventDefault();
                        $(this).parent().find("ul").toggle("slow");
                        });
                        $(".trigger-click-on-book-now").click(function (event) {
                        event.preventDefault();
                        $(".open-book-now-page").trigger("click");
                        });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                        $(window).scroll(function () {
                        if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                        } else {
                        $('#back-to-top').fadeOut();
                        }
                        });
                        $("#back-to-top").click(function (event) {
                        event.preventDefault();
                        $("html, body").animate({scrollTop: 0}, "slow");
                        });
                        $(".trigger-click-on-video-pop-up").click(function (event) {
                        event.preventDefault();
                        $(".open-video-pop-up").trigger("click");
                        });
                        $('.uk-slideshow:first-child .ai-uk-animation .bh-slideshow-thumbnail-split-preview').delay(3000).fadeIn(5000);
                        $('.ai-uk-animation:first .bh-slideshow-thumbnail-split-preview').addClass('uk-animation-fade');
                        });
                    </script>
                    <script>
                        if ($('#two-inputs').length > 0) {
                        $('#two-inputs').dateRangePicker(
                        {
                        selectForward: (Boolean),
                                stickyMonths: (Boolean),
                                startDate: "12-01-2017",
                                format: ' DD.MM.YYYY',
                                separator: ' to ',
                                getValue: function ()
                                {
                                if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                                        return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                                else
                                        return '';
                                },
                                setValue: function (s, s1, s2)
                                {
                                $('#date-range-arrive').val(s1);
                                $('#date-range-destination').val(s2);
                                }
                        }
                        ).bind('datepicker-first-date-selected', function (event, obj) {
                        $("#date-range-destination").val('');
                        });
                        }
                    </script>
                    <script>
                        /* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
                        var acc = document.getElementsByClassName("accordion");
                        var i;
                        for (i = 0; i < acc.length; i++) {
                        acc[i].onclick = function () {
                        this.classList.toggle("active");
                        this.nextElementSibling.classList.toggle("show");
                        }
                        }
                    </script>
                    <script>
                        function toogleNavpost() {
                        if (document.getElementById("mySidenavpost").style.width == "400px") {
                        return closeNavpost();
                        }
                        return openNavpost();
                        }
                        function openNavpost() {
                        if ($(window).width() >= 768) {
                        document.getElementById("mySidenavpost").style.width = "400px";
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        else{
                        document.getElementById("mySidenavpost").style.width = "100%";
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        }
                        function closeNavpost() {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        window.onload = function () {
                        if ($(window).width() >= 768) {
                        if ($("#mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        }
                        setTimeout(function () {
                        if ($(window).width() >= 768) {
                        if ($("#mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        }, 10000);
                        };
                        if ($(window).width() <= 767) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        document.getElementById("main").style.marginRight = "250px";
                        }

                        $(document).on('click', function (event) {
                        if ($(window).width() <= 767) {
                        if ($(event.target).has('.filter-width').length) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        }
                        }
                        });
                    </script>
                    <script>
                        $(".node-btn").click(function(){
                        $(this).parent().find("> .node").toggle();
                        $(this).parent().find("> .node").css({"padding-left": "10px", "margin-top": "5px", "text-transform": "inherit"});
                        $(this).parent().find("> .node > a").css({"text-transform": "none"});
                        });
                    </script>
                    <script>
                        $(function () {
                        $('#filter-date-mobile').combodate();
                        });
                        $('#filter-date-mobile').combodate({
                        minYear: 2018,
                                maxYear: 2019,
                        });
                        $(function () {
                        $('#filter-date-mobile-departure').combodate();
                        });
                        $('#filter-date-mobile-departure').combodate({
                        minYear: 2018,
                                maxYear: 2019,
                        });
                        <?php if(\Session::get('ai_previous_page')): ?>
                        $(document).ready(function (){
                            $(".go-back-button-container .previous-page-screen-short-container").html('<img src="{{URL()}}/sximo/previous_page_image/<?php echo \Session::get('ai_previous_page'); ?>">');
                        });
                        <?php endif; ?>
//                        $(window).load(function () {
                            var scaleBy = 1;
                            var w = 1600;
                            var h = 700;
                            var div = document.querySelector('body');
                            var canvas = document.createElement('canvas');
                            canvas.width = w * scaleBy;
                            canvas.height = h * scaleBy;
                            canvas.style.width = w + 'px';
                            canvas.style.height = h + 'px';
                            var context = canvas.getContext('2d');
                            context.scale(scaleBy, scaleBy);

                            html2canvas(div, {
                                canvas:canvas,
                                onrendered: function (canvas) {
                                    theCanvas = canvas;
                                    var imageData = canvas.toDataURL();
                                    $.ajax({
                                        url: "{{URL::to('save_previous_page_image')}}",
                                        type: "POST",
                                        data: "ai_previous_page=" + encodeURIComponent(imageData)
                                    });
                                }
                            });
//                        });
                    </script>
                    <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
                    <div class="editorial-custom-footer-style grid-page-footer-align">
                        @include('layouts/elliot/ai_footer_social')
                    </div>
                    <?php //@include('layouts/elliot/ai_lightbox_popups') ?>

                    <script>
                    
                        /*Top Bar Booking Start Here*/
                $('#top-bar-search-booking-form').dateRangePicker(
                    {
                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "12-01-2017",
                        format: 'DD.MM.YYYY',
                        autoClose: "true",
                        separator: ' to ',
                        getValue: function ()
                        {
                            if ($('#top-bar-search-booking-form-destination').val() && $('#top-bar-search-booking-form-arrive').val())
                                return $('#top-bar-saerch-booking-form-destination').val() + ' to ' + $('#top-bar-saerch-booking-form-arrive').val();
                            else
                                return '';
                        },
                        setValue: function (s, s1, s2)
                        {
                            $('#top-bar-search-booking-form-arrive').val(s1);
                            $('#top-bar-search-booking-form-destination').val(s2);
                        }
                    }
                ).bind('datepicker-first-date-selected', function (event, obj) {
                    $("#top-bar-search-booking-form-destination").val('');
                });
                /*Top Bar Booking End Here*/
                    
                    </script> 
                    
                     <script> 
                $('.contact-aside').hover(
                    function(){ $(this).addClass('active') },
                    function(){ $(this).removeClass('active') }
                )
         </script>
         
         <!-- contact email aside -->
                <script> 
                    $('.contact-aside').hover(
                        function(){ $(this).addClass('active') },
                        function(){ $(this).removeClass('active') }
                    )
                </script>
<script>
$(document).ready(function(){
    eval($('.dropdown').each(function () {
    var $dropdown = $(this);
    $(".members-list", $dropdown).click(function (e) {
        e.preventDefault();
        $div = $(".members-drop-list", $dropdown);
        $div.toggle();
        $(".members-drop-list").not($div).hide();
        return false;
    });
}));
});
</script>

           <style>
/* Center the loader */
#loaderProperty {
  

  z-index: 1;
  width: 30px;
  height: 30px;
 display: none;
  border: 4px solid #dedada;
  border-radius: 50%;
  border-top: 4px solid #000;
  width: 30px;
  height: 30px;
  margin: 0 auto;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



</style>                             
    </body>
</html>
