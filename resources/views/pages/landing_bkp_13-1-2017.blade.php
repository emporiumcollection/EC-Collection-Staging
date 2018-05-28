{{--*/ $landing_menus = SiteHelpers::menus('landing') /*--}}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Emporium-Voyage</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('sximo/assets/css/landing-page-styles.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/ai-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/Hamburg-menu.css')}}" rel="stylesheet" type="text/css"/>
<!--        <link href="{{ asset('sximo/assets/css/menu41e7.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/responsive.custom41e7.css')}}" rel="stylesheet" type="text/css"/>
        
        <link href="{{ asset('sximo/assets/css/style-ai.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/homepage41e7.css')}}" rel="stylesheet" type="text/css"/>-->
        <!--AIC sidebar js -->
<!--        <script src="{{ asset('sximo/assets/js/jquery_1.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/custm.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/TweenMax.min41e7.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/menu41e7.js')}}" type="text/javascript"></script>-->
        
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript" ></script>
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript" ></script>
        <script src="{{ asset('sximo/assets/js/html2canvas.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m_slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/open-search.js')}}" type="text/javascript"></script>
        
        
        
        <style>
        
                         /* hamburg menu pop up css */

            .EVhamburgService {
                padding: 19px;
            }

            .EVpopService {
                width: 100%;
                top: 0px;
            }

            .EVcenterPOP {
                border: none;
                display: table-footer-group;
                margin: 0;
            }
            
            /* hamburg menu pop up css */
        
            #inner-level-accordian .panel-title {
                float: left;
                width: 100%;
                margin-bottom: 10px;
            }
            #search-navbar-destination.search-navbar-destination-search-box {
                background: #252525 none repeat scroll 0 0 !important;
                border: 2px solid #2a2d30;
                display: table;
                margin: 0 auto 10px;
                width: 80%;
            }
            .bh-search-input.typeahead.search-navbar.search-navbar-destination-search-box.tt-hint {
                display: none;
            }
            .sidenavpost .bh-search-input{
                padding-left: 0px !important;
            }
            .sidenavpost .tt-menu{
                left: 0% !important;
                color:#fff !important;
            }
            .sidenavpost a{
                padding: 0 !important;
                font-size: 14px !important;
            }
            .sidenavpost .closebtn{
                font-size: 36px !important;
            }
            div.destinSearch .bh-search-input {
                width: 80%;
                border:2px solid #fff;
                margin-left:100px;
                margin-bottom:10px;
            }
            div.destinSearch .tt-menu {
                width: 80%;
                left:100px !important;
            }
            div.destinSearch .typeahead {
                height: 50px;
            }
            div.destinSearchMob .bh-search-input {
                border:2px solid #fff;
                margin-bottom:10px;
            }
            div.destinSearchMob .typeahead {
                height: 50px;
            }
            .destination-inner-accordian-outer .panel-heading {
                background-color: transparent;
                border: medium none;
                height: auto;
                margin: 0;
                padding: 0;
            }
            .where-box-sub-menu .destination-inner-accordian-outer  a.active{
                background-color: transparent !important;
                color: #fff !important;
                text-decoration: underline;
            }
            .where-box-sub-menu.inner-level-sub-menu a {
                text-transform: inherit;
            }
            .where-box-sub-menu.inner-level-sub-menu  li {
                padding: 7px 0 2px 20px;
            }
            .where-box-sub-menu.inner-level-sub-menu {
                margin: 0 0 15px;
            } 
            .destination-inner-accordian-outer .panel-collapse {
                float: left;
                width: 100%;
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
            }
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
            .node-btn.active {
                border-bottom: 2px solid;
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
            top: 63px;
            left: calc(100% - 43px);
            width: 291px;
            background: #272727;
            color: #fff;
            font-size: 15px;
            right: 0;
        }
        .contact-aside ul {
            padding: 7px 0;
            list-style: none;
        }
        .contact-aside li {
            padding: 9.33333px 0;
            margin: 0 15px;
        }
        .contact-aside {
            color: #fff;
            font-size: 15px;
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
            margin-right: 10px;
            margin-left: 5px;
        }
        
         /* sidebar css */
        
        body:not(.adminimal-theme) {
                /*background-color: #ada077;*/
                /*color: #ffffff;*/
            }
            .menu-logo {
                background: url(sites/five/files/five_logo_gold.svg) no-repeat center center;
            }
            .mobile-detect-class .menu-logo {
                background-image: url(http://fiveseashotel.com/sites/five/files/five_logo_white.svg);
            }
            #loader-logo-under {
                background: url(http://fiveseashotel.com/sites/five/files/five_logo_gold.svg) no-repeat left center;
            }
            #loader-logo-up {
                background: url(http://fiveseashotel.com/sites/five/files/five_logo_white.svg) no-repeat left center;
            }
            #website-logo {
                background: url(http://fiveseashotel.com/sites/five/files/five_logo_white.svg) no-repeat center;
            }
            body:not(.adminimal-theme) a,
            body:not(.adminimal-theme) ul.primary li a {
                
/*                color: #ffffff;*/
            }
            body:not(.adminimal-theme) a:hover,
            body:not(.adminimal-theme) a.active,
            body:not(.adminimal-theme) ul.primary li a:hover,
            body:not(.adminimal-theme) ul.primary li a.active {
                /*background-color: #ada077;*/
                /*color: #232323;*/
                a.contextual-links-trigger {
                    background: transparent url(modules/contextual/images/gear-select.png) no-repeat 2px 0;
                }
            }
            body:not(.adminimal-theme) footer {
                background-color: #ffffff;
            }
            body:not(.adminimal-theme) footer a,
            body:not(.adminimal-theme) footer a:hover {
                background-color: #ffffff;
                color: #232323;
            }
            #block-ledunfly-footer-text .block-inner {
                color: #ada077;
            }
            div.underline-title,
            div.underline-rollover {
                background-color: #ffffff;
            }
            body:not(.adminimal-theme) .region-sidebar-first {
/*                background-color: #252525;*/
                color: #ada077;
            }
            #unsupported {
                background-color: #ada077;
                color: #ffffff;
            }
            .block-menu-text {
                color: #232323;
            }
            #block-ledunfly-book-link {
                background-color: #ada077;
                color: #ffffff;
            }
            #block-ledunfly-book-link:hover {
                background-color: #232323;
            }
            #block-ledunfly-book-link a:hover {
                color: #ffffff;
            }
            #block-ledunfly-book-link a:nth-child(2):hover {
                color: #ada077;
            }
            #block-ledunfly-menu-link {
                background-color: transparent;
                color: #ffffff;
            }
            #block-ledunfly-menu-link span {
                background-color: #ffffff;
            }
            ul.menusk li.little a,
            ul.menusk li ul li.little a {
                color: #ABA07C;
            }
            ul.menusk li a,
            ul.menusk li ul li a {
                color: #ABA07C;
            }
            ul.menusk li a:hover,
            ul.menusk li a:active,
            ul.menusk li.little a:hover,
            ul.menusk li.little a:active,
            ul.menusk li a.active {
                color: #aba07ccc;
            }
            #block-system-main-menu .block-menu-text {
                color: #ABA07C;
            }
            #block-system-main-menu .block-menu-text a,
            #block-system-main-menu .block-menu-text a:hover,
            #block-system-main-menu .block-menu-text a.active {
                background: none;
                color: #232323;
            }
            ul.menusk ul.menusk1:before {
                background-color: #ABA07C;
            }
            #block-system-main-menu .block-inner {
                background: rgba(37, 37, 37, 0.9);
            }
            #block-locale-language,
            #block-locale-language .block-title,
            #block-locale-language li,
            #block-locale-language li span,
            #block-locale-language li a {
                background-color: #252525;
                color: #ada077;
            }
            #block-locale-language li:hover span,
            #block-locale-language li:hover a {
                background-color: #ada077;
                color: #252525;
            }
            #block-locale-language li:hover,
            {
                background-color: #ada077;
                border-top: 1px solid #ada077;
                color: #252525;
            }
            #block-details-social-links,
            #block-details-social-links a,
            #block-details-social-links a:hover {
                background-color: #ffffff;
                color: #ada077;
            }
            #block-details-social-links .block-content a span:before {
                background-color: #ada077;
                opacity: 0.7;
            }
            #block-ledunfly-footer-text {
                background-color: #ffffff;
            }
            .not-logged-in.page-user input#edit-submit {
                color: #ccc5af;
            }
            #homepage-1391 {
                background: url('sites/five/files/homepage/img_bg_footer_1.jpg') no-repeat bottom center #f2f1f5;
            }
            #homepage-1391 a {
                background-color: #f2f1f5;
            }
            #homepage-1391 a:hover,
            #homepage-1391 a.active {
                background-color: #f2f1f5;
            }
            #homepage-1391 .header-inner-wrapper {
                background: url('sites/five/files/homepage/five_header_1600x926_home_v2_0.jpg') no-repeat top center #f2f1f5;
                background-size: cover;
            }
            #homepage-1391 .content-first .field-name-field-hp-text-1 {
                background: #ada077;
                color: #ffffff;
            }
            #homepage-1391 div.underline-title {
                background: #ada077;
                background: #ffffff;
            }
            #homepage-1391 div.underline-rollover {
                background: #ffffff;
            }
            #homepage-1391 .content-first .field-name-field-hp-text-1 a {
                background-color: #ada077;
                color: #ffffff;
            }
            #homepage-1391 .content-first .field-name-field-hp-text-1 a:hover,
            #homepage-1391 .content-first .field-name-field-hp-text-1 a.active {
                background-color: #ada077;
                color: #ffffff;
            }
            .scroll-down {
                background-color: #ada077;
                border-color: #ada077;
            }
            #homepage-1391 .infos .field-name-field-hp-text {
                background-image: url("sites/five/files/bg-hp-bloc-bas_1.jpg");
            }
            #node-slider-1389 {
                background: #232323;
                color: #ffffff;
            }
            #node-slider-1389 a,
            #node-slider-1389 a:hover,
            #node-slider-1389 a.active {
                background: #232323;
                color: #ffffff;
            }
/*            html {
                font-size: 100%;
                -webkit-text-size-adjust: 100%;
                line-height: 1.5;
                height: 100%;
                overflow-y: scroll;
            }
			body {
                min-height: 100%;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                font-smoothing: antialiased;
                text-rendering: optimizeLegibility\9;
            }*/

            figure {
                margin: 0;
            }

            .block-inner,
            .pane-inner,
            .menu-wrapper,
            .branding-elements,
            .breadcrumb-wrapper,
            .attribution,
            .at-panel .rounded-corner,
            .block-panels-mini > .block-title,
            .rendered-by-ds .panel-display .region-inner,
            div.messages {
                margin-left: 10px;
                margin-right: 10px;
            }

            #content .panel-display,
            #content .panel-flexible {
                margin-left: -10px;
                margin-right: -10px;
            }

            img {
                height: auto;
                -ms-interpolation-mode: bicubic;
            }

            img,
            embed,
            object,
            video {
                max-width: 100%;
            }

            .lt-ie9 img,
            .lt-ie9 object,
            .lt-ie9 embed,
            .lt-ie9 video {
                max-width: none;
            }

            #map img,
            .gmap img,
            .view-gmap img,
            .openlayers-map img,
            #getlocations_map_canvas img,
            #locationmap_map img,
            .geofieldMap img,
            .views_horizontal_slider img,
            .geolocation-map img,
            .geolocation-views-map img {
                max-width: none !important;
            }

            header[role=banner],
            .content-inner,
            .nav,
            .region-sidebar-first,
            .region-sidebar-second,
            .region-secondary-content,
            .region-tertiary-content,
            .region-footer {
                overflow: visible;
                word-wrap: break-word;
            }
            .ir {
                display: block !important;
                text-indent: 100%;
                white-space: nowrap;
                overflow: hidden;
                border: 0;
                font: 0/0 a;
                text-shadow: none;
                color: transparent;
                background-color: transparent;
            }

            /* More robust element-invisible and element-focuable classes */
            .element-invisible {
                border: 0;
                clip: rect(1px 1px 1px 1px);
                clip: rect(1px, 1px, 1px, 1px);
                height: 1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            .element-invisible.element-focusable:active,
            .element-invisible.element-focusable:focus {
                clip: auto;
                height: auto;
                overflow: visible;
                position: static;
                width: auto;
            }

            .offscreen {
                position: absolute;
                top: -99999em;
                width: 1px;
                height: 1px;
                overflow: hidden;
                outline: 0;
            }
            .element-hidden {
                display: none;
            }
            
            .emporium-voyage-Menu {
                color: #c7ab84;
                margin-top: 3px;
                margin-left: 0px;
                opacity: 1;
                box-shadow: none;
                font-size: 20px;
            }
            
             .close {
                font-size: 21px;
                font-weight: 700;
                opacity: 1;
                text-shadow: none;
            }
            
        /* sidebar css end */
        
        /* AIC 29-12-2017*/
        
        .main-page-landing {
                float: right;
        }
        
        .booking-form-bar-top {
	float: left;
	opacity: unset !important;
	padding-left: 15px !important;
	padding-right: 8px !important;
	padding-top: 15px !important;
	position: absolute;
	top: 0;
	width: 100% !important;
	background: rgba(37, 37, 37, 0.9);
        }
        
        .login_popup .fa {
            color: #ABA07C;
            font-size: 24px;
            margin: 0px;
            padding: 0px 0px 0px 0px;
        }
        
        header {
            left: 91% !important;
            left: 0;
            position: fixed;
            top: 0;
            width: 90px;
        }
        
        .hotels-logo img {
	padding: 11px 19px 40px 20px;
    }
        
        .right-menus ul li a {
	background-color: #1E2023;
	border-bottom: 1px solid #414246;
	color: #fff;
	display: block;
	font-size: 12px !important;
	padding: 25px 0 25px 21px;
	text-transform: uppercase;
	background: rgba(37,37,37,1.0);
    }
    
    .right-menu-sidebar {
	float: right;
	height: 100vh;
	position: fixed;
	right: 0;
	top: 0;
	left: 0;
	width: 17%;
	background: rgb(37,37,37,0.9);
    }
    
    .editorial_m_slider_landing ul li .editorial-text {
	background: rgb(37,37,37,0.9);
	bottom: 85px;
	margin-left: 0;
	margin-top: 0;
	opacity: .71;
	padding: 21px;
	position: absolute;
	right: 0;
	width: 419px;
    }
    
    .editorial_m_slider_landing .editor-picks-small-text {
	color: #fff;
	font-family: ACaslonPro-Regular;
	font-size: 36px;
	font-style: normal;
    }
    
    .close-btn-align {
	color: #fff;
	font-size: 36px;
	position: absolute;
	right: 115px;
	top: 5px;
	z-index: 99;
	color: #c7ab84;
    }
    
    .headings > h2 {
        font-size: 36px;
    }
    .headings > p {
        color: #ABA07C;
        font-size: 16px;
    }
    
    /* AIC 5-1-2018 */
    
    .show-login-forms-btn {
	display: inline-block;
	padding: 5px 0;
	text-align: center;
	vertical-align: text-top;
	width: 73%;
    }
    
    .hamburgMenu {
        margin-top: 20px;
    }
    
    .video-popup-btn.login_popup.show-login-forms-btn {
	display: inline-block;
	margin-top: 14px;
	width: 59%;
    }
    
    .hamburgMenu {
        font-size: 24px;
        color: #ABA07C;
    }

                            
        
        
            
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
    <body id="main">
        <!--Desktop Version Start Here-->
        <div class="hidden-xs hidden-sm">
            <div class="wrapper">
                <div class="container-fluid"> 
                    <div class="row">
                        <header>
                            
                            <!-- start sidebar -->
                            
<!--                            <div class="region region-sidebar-first sidebar">
                                <div class="region-inner clearfix">
                                    <div id="block-ledunfly-menu-link" class="block block-ledunfly no-title odd first block-count-4 block-region-sidebar-first block-menu-link" ><div class="block-inner clearfix">  
                                            <div class="block-content content"><i class="fa fa-bars emporium-voyage-Menu" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                    <div id="block-ledunfly-menu-logo" class="block block-ledunfly no-title even block-count-5 block-region-sidebar-first block-menu-logo" ><div class="block-inner clearfix">  

                                            <div class="block-content content"><a href="index.html" title="Five Seas Hotel"><div class="menu-logo"></div></a></div>
                                        </div>
                                    </div>
                                    <div id="block-system-main-menu" class="block block-system block-menu no-title odd block-count-6 block-region-sidebar-first block-main-menu" role="navigation">
                                        <div class="block-inner clearfix">
                                            <div class="block-content content" class="block-content content">
                                                 Start Popup Menu 
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

                                              Start Popup 2 Menu    
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

                                        </ul>    Comment Static menu 
                                                
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
                                                    ></ul>
                                            </div>
                                            <div class="block-menu-text">
                                                <p>FIVE SEAS HOTEL CANNES - 1, RUE NOTRE DAME - 06400 CANNES</p>
                                                <div><p>T : +33 4 63 36 05 05</p>
                                                    <p>INFO@FIVESEASHOTEL.COM</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    -->
                            
                            <!-- end sidebar -->
                            
                            <a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn"><i class="fa fa-lock " aria-hidden="true" ></i></a>
                            <a data-popup-id="ev-primary-navigation" href="#" class="video-popup-btn"><!--<i class="fa fa-bars hamburgMenu" aria-hidden="true"></i>-->
                                <div class="block-content content">
                                    <span></span>
                                    <span> </span>
                                    <span></span>
                                </div>
                            </a>
                        </header>
                        <!--Main Page-->
                        @if(!empty($slider)) 
                        <div class="col-md-10 main-page-landing">
                            <div class="row">
                                <section class="book-form-top-bar">
                                    <div>
                                        <div class="booking-form-bar-top">
                                            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar top-bar-search-form-align" action="{{URL::to('search')}}">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="form-group would-like-input top-bar-search padding-right-12">
                                                            <input  class="form-control ai-custom-deafault-style bh-search-input typeahead search-box searchbox_landing" name="s" id="search-navbar-sliderform" placeholder="Enter Your Hotel or Destination" type="text" required="required">
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
                                            </form>
                                        </div>
                                        <!-- AIC Harman email phone sidebar add start -->
                                        
<!--                                            <aside class="site-aside">
                                                <div class="contact-aside">
                                                    <ul class="contact-aside-list">
                                                        <li class="contact-list-item contact-phone"><a href="tel:+49 172 8937230"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +49 172 8937230</a></li>
                                                        <li class="contact-list-item contact-email"><a href="mailto:bookings@emporium-voyage.com"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> bookings@emporium-voyage.com</a></li>
                                                    </ul>
                                                </div>
                                            </aside>-->
                                        
                                        <!-- AIC Harman email phone sidebar add end -->
                                        
                                    </div>
                                </section>
                                <div class="clearfix"></div>
                                <!--Slider start here-->
                                <div class="m_slider editorial_m_slider_landing ">
                                    <ul>
                                        @foreach($slider as $key => $slider_row)
                                        <li class="{{($key == 0)? 'active' : ''}}">
                                            <div class="image editorial-image">
                                                <a href="{{$slider_row->slider_link}}"> <img src="{{url()}}/uploads/slider_images/{{$slider_row->slider_img}}" alt=""/></a>
                                            </div>
                                            <div class="editorial-text">
                                                <div class="editor-picks-small-text"><a href="{{$slider_row->slider_link}}">{{$slider_row->slider_title}}</a></div>
                                                <div class="description-bold-text">{{$slider_row->slider_description}}</div>
                                                <!--end slide -->
                                            </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="editorial-arrows-container arrows-container">
                                        <a class="editorial-previous-arrow previous-arrow" href="#">
                                            <img class="banner-arrow-bg" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="editorial-next-arrow next-arrow" href="#">
                                            <img  class="banner-arrow-bg" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                </div>
								
								
                                <div class="landing-page-footer-section">
                                    @if(!empty($landing_menus))
                                    <ul class="landing-page-footer-menu-style">
                                        @foreach ($landing_menus as $fmenu)
                                        <li><a @if($fmenu['menu_type'] =='external') href="{{ URL::to($fmenu['url'])}}" @else href="{{ URL::to($fmenu['module'])}}" @endif>@if(CNF_MULTILANG ==1 && isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                                                {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                                                @else
                                                {{$fmenu['menu_name']}}
                                                @endif</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                                <!--Slider end here-->
                            </div>
                        </div>
                        @endif
                        <!--Main Page End-->
                        <!--Sidebar-->
                        <div class="col-md-2">
                            <div class="row">
                                <div class="right-menus right-menu-sidebar">
                                    <div class="hotels-logo">
                                        <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive">
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#" class="book-button open-search-page">Search Our Collection</a>
                                        </li>
                                        <li>
                                            <a href="#" class="book-button open-date-page">Search By Date</a>
                                        </li>
                                        <li>
                                            <a href="#" class="book-button open-destination-page">Select Your Destination</a>
                                        </li>
                                        <li>
                                            <a href="#" class="book-button open-experience-page">Select Your Experience</a>
                                        </li>
                                        <!--<li>
                                            <a href="#" class="book-button open-about-page">About</a>
                                        </li>
                                        <li>
                                            <a href="#" class="book-button open-personalized-page">Personalized Service</a>
                                        </li>-->
                                    </ul>
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
                                        @if(!empty($landingads))
                                        @foreach($landingads as $lnads)
                                        <div class="slick-cstm-width">
                                            <a href="{{ (strpos($lnads->adv_link, 'http://') !== false) ? $lnads->adv_link : 'http://'.$lnads->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$lnads->adv_img)}}"></a>
                                        </div>
                                        @endforeach
                                        @endif
                                    </section>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!--Sidebar End-->
                </div>
            </div>
            <!--Search Our Collection Page-->
            <div class="search-page" <?php if(isset($_GET['ref']) && $_GET['ref']=='oc'){ echo 'style="width:100%;"';}?>>
                <div class="open-search-html">
                    <div><a class="close-btn close-btn-align" href="#">&times;</a></div>
                    <div class="row search-page-box">
                        <div class="col-md-6">
                            <div class="left-serach">
                                <h2>Our Collection</h2>
                                <div class="serach-page-menu">
                                    <ul>
                                        <li><a href="{{URL::to('luxurytravel/Hotel?ref=oc')}}">Hotels</a></li>
										<li><a href="http://www.emporium-yachts.com/luxurytravel/Yachts">Yachts</a></li>
                                        <!--<li><a href="{{URL::to('luxurytravel/Villas')}}">Villas</a></li>-->
                                        <!--<li><a href="{{URL::to('luxurytravel/Safari Lodges')}}">Safari</a></li>-->
                                        <!--<li><a href="{{URL::to('luxurytravel/Spas')}}">Spa's</a></li>-->
                                        <!--<li><a href="{{URL::to('luxurytravel/Yachts?ref=oc')}}">Yachts</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right-serach">
                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Emporium-Voyage.png')}}" alt="Emporium-Voyage" />
                                <!--Search form start-->
                                <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                    <input type="hidden" name="ref" value="oc">
                                    <input  class="bh-search-input typeahead search-navbar search-box" name="s" id="search-navbar-our-collection" placeholder="Enter Your Hotel or Destination" type="text">
                                </form>
                                <!--Search form end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Search Our Collection End Here-->
            <!--Experience Page Start Here-->
            <div class="experience-page" <?php if(isset($_GET['ref']) && $_GET['ref']=='sye'){ echo 'style="width:100%;"';}?>>
                <div class="open-experience-html des-holiday-sec-align">
                    <div><a class="close-btn-experience close-btn-align" href="#">&times;</a></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header-logo-center">
                        <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/Emporium-Voyage.png')}}"/></a>
                    </div>
                    <h2>Select Your Experience</h2>
                    <div class="choose-experience-center-align">
                        <div class="width-100 holiday-type-image-align ">
                            @if(!empty($experiences))
								@foreach($experiences as $experience)
									<div class="width-20">
										<img class="img-responsive" src="{{URL::to('uploads/category_imgs/'.$experience->category_image)}}" alt=""/>
										<a href="{{URL::to('luxury_experience/'. str_replace(' ','_',$experience->category_name))}}"><h3 class="hover-tittles">{{$experience->category_custom_title}}</h3></a>
									</div>
								@endforeach
							@endif
							
                        </div>
                    </div>
                </div>
            </div>
            <!--Experience Page End Here-->
            <!--Destination Page Start Here-->
            <div class="destination-page" <?php if(isset($_GET['ref']) && $_GET['ref']=='syd'){ echo 'style="width:100%;"';}?>>
                <div class="open-destination-html">
                    <div><a class="close-btn-destination close-btn-align" href="#">&times;</a></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header-logo-center">
                        <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/Emporium-Voyage.png')}}"/></a>
                    </div>
                    <h2>Select Your Destination</h2>
                    <div class="destinSearch">
                        <!--Search form start-->
                        <form autocomplete="off" method="get" id="searchform-navbar" class="destinationsearchform-navbar" action="{{URL::to('search')}}">
                            <inpu type="hidden" name="ref" value="syd">
                            <input  class="bh-search-input typeahead search-navbar search-navbar-destination-search-box" name="s" id="search-navbar-destination" placeholder="ENTER YOUR DESTINATION" type="text">
                        </form>
                        <!--Search form end-->
                    </div>
                    <div class="panel-group-" id="accordion1">
                       <?php 

                       /* Note:
                            Now the our destinations will render from storage/app/homeOurDestination.html. 
                            That file will be genrate from cron job or backend panel.  
                       
                        
                          */  
      ?>
                        {!!Storage::get('homeOurDestination.html')!!}
                        @if(!empty($ourmaindesitnation))
                        @foreach($ourmaindesitnation as $destination)
                        <div class="panel panel-default  destination-sub-menues">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse-inner{{$destination->id}}">
                                <div class="destination-panel-heading">
                                    <h4 class="panel-title menu-text accordion ">
                                        {{$destination->category_name}}
                                    </h4>
                                </div>
                            </a>
                            <div id="collapse-inner{{$destination->id}}" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <ul class="where-box-sub-menu">
                                        @if (array_key_exists("childs",$destination))
                                        @foreach($destination->childs as $childDest)
                                        <li><div class="panel-group destination-inner-accordian-outer" id="inner-level-accordian">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="margin-top-15 panel-title pull-left">
                                                        <a data-toggle="collapse" data-parent="#inner-level-accordian" href="#destination-child{{$childDest->id}}">{{$childDest->category_name}}</a>
                                                    </h4>
                                                </div>
                                                @if (array_key_exists("subchild",$childDest))
                                                    <div id="destination-child{{$childDest->id}}" class="panel-collapse collapse">
                                                        <ul class="where-box-sub-menu inner-level-sub-menu">
                                                            @foreach($childDest->subchild as $subchildDest)
                                                                <li>
                                                                    @if (array_key_exists("subchild",$subchildDest) && !empty($subchildDest->subchild))
                                                                    <div class="panel-group destination-inner-accordian-outer" id="inner-level-accordian">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" data-parent="#inner-level-accordian" href="#destination-child{{$childDest->id}}-{{$subchildDest->id}}">{{$subchildDest->category_name}}</a>
                                                                                </h4>
                                                                            </div>
                                                                            
                                                                                <div id="destination-child{{$childDest->id}}-{{$subchildDest->id}}" class="panel-collapse collapse">
                                                                                    <ul class="where-box-sub-menu inner-level-sub-menu">
                                                                                        @foreach($subchildDest->subchild as $_child)
                                                                                            <li><a href="{{URL::to('luxury_destinations/'. str_replace(' ','_',$destination->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$_child->category_name))}}">{{$_child->category_name}}</a></li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <a href="{{URL::to('luxury_destinations/'. str_replace(' ','_',$destination->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$subchildDest->category_name))}}">{{$subchildDest->category_name}}</a>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div></li>
                                        <!--The menu code is commented please uncomment this when you make it dynamic-->
                                        <!--<li><a href="{{URL::to('search?continent='.$destination->category_name.'&region='.$childDest->category_name.'&s='.$childDest->category_name.'&ref=syd&destination_page=1')}}">{{$childDest->category_name}}</a></li>-->
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        
                    </div>
                </div>
            </div>
            <!--Destination Page  End Here-->
            <!--Personalized Page Start Here-->
            <div class="personalized-page">
                <div class="open-personalized-html">
                    <div><a class="close-btn-personalized close-btn-align" href="#">&times;</a></div>
                    <div class="panel-body des-about-panel-body-style">
                        <div class="col-md-6 about-us-sec">
                            <div class="row">
                                <div class="about-res-image" style="background-image: url('{{ asset('sximo/assets/images/room.png')}}')"></div>
                            </div>
                        </div>
                        <div class="col-md-6 about-us-side-text">
                            <div class="border-box">
                                <a class="video-popup-btn" data-popup-id="register-popup" href="#">Register</a>
                            </div>
                        </div>
                    </div>
                    <!--<div class="panel-body des-about-panel-body-style">
                        <div class="col-md-12">
                            <img class="img-responsive-" src="{{ asset('sximo/assets/images/JUNIOR-SUITES.png')}}" alt="">
                            <div class="register-here-overlay">
                                <a class="video-popup-btn" data-popup-id="register-popup" href="#">Register</a>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <!--Personalized Page  End Here-->
            <!--Search By Date Page Start Here-->
            <div class="book-now-page date-page" <?php if(isset($_GET['ref']) && $_GET['ref']=='sbd'){ echo 'style="width:100%;"';}?>>
                <div class="book-now-page-content open-date-html">
                    <div><a class="close-btn-date close-btn-align" href="#">&times;</a></div>
                    <div class="headings">
                        <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
                        <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                    </div>
                    <form action="{{URL::to('search')}}" method="get">
                        <input name="s" value="" type="hidden">
                        <input name="ref" value="sbd" type="hidden">

                        <ul class="dates" id="search-by-date">
                            <li>
                                <div class="heading">Arrive</div>
                                <input id="date-range-arrive" size="20" name="arrive" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}">
                            </li>
                            <li>
                                <div class="heading">Departure</div>
                                <input id="date-range-destination" size="20" name="destination" value="{{ ($destination_date!='') ? $destination_date : '' }}">
                            </li>
                        </ul>
                        <ul class="dates">
                            <li>
                                <div class="heading">Adults</div>
                                <select name="adult">
                                    <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
                                    <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
                                    <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>
                                </select>
                            </li>
                            <li>
                                <div class="heading">Children</div>
                                <select name="childs">
                                    <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
                                    <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
                                    <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
                                </select>
                            </li>
                            <div class="clearfix"></div>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="submit-btn editorial-submit-btn">
                            <button class="booking-form-pop-up-btn-" data-popup-id="booking-form-pop-up" type="submit">BOOK NOW</button>
                        </div>
                    </form>
                    <div class="view-modify-cancel-booking">
                        <a href="#">View, Modify or Cancel your Booking</a>
                    </div>
                    <ul class="booking-page-footer-section">
                        <li>
                            <a href="#" target="_blank">
                                <span>Join the worlds leading luxury club</span>
                                <h6 class="center">Enjoy exclusive members only benefits</h6>
                            </a>
                            <div class="white-border-bottom"></div>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <span>Spa Treatment</span>
                                <h6 class="center">Book</h6>
                            </a>
                            <div class="white-border-bottom"></div>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <span>View or Modify Reserveration</span>
                                <h6 class="center">Login to Support Center</h6>
                            </a>
                            <div class="white-border-bottom"></div>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--Search By Date Page End Here-->
            <!--About Page Start Here-->
            <div class="about-page">
                <div class="open-about-html">
                    <div><a class="close-btn-about close-btn-align" href="#">&times;</a></div>
                    <div id="" class="spa-sec-outer-align-">
                        <div class="">
                            <div class="ai-spa-sec-inner">
                                <div class="main-spa-sec-show-area">
                                    <div class="spa-overlay-text">
                                        <blockquote>"Beauty awakens the soul to act."</blockquote>
                                        <span>Dante Alighieri</span>
                                    </div>
                                    <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/main-spa.jpg')}}" alt=""/>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="spa-left-pannel-align">
                                            <p class="spa-sec-para-style spa-text-pannel1">
                                                Relax, let go, and enjoy: Rituals of nurturing and pampering 
                                                are combined with the ancient knowledge of traditional Chinese
                                                medicine to create a holistic entity in the Susanne Kaufmann&trade;
                                                Boutique SPA. Wholesome products are used, containing no chemical
                                                additives or colourants. Facial and body treatments are centred on
                                                anti-aging and active regeneration &ndash; awakening new life energies
                                                and bringing vitality into the daily routine.</p>
                                            <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/spa-img2.jpg')}}" alt=""/>
                                            <div class="spa-left-des-pannel2">
                                                <h4 class="spa-bold-text">OPENING HOURS</h4>
                                                <div class="spa-booking-des-text-align">
                                                    <p class="spa-sec-para-style">For hotel guests the pool and sauna are open daily from 6am to 10pm.</p>
                                                    <p class="spa-sec-para-style">For Day SPA users, the use of the pool and sauna are only permitted with&nbsp;the booking of a treatment at these times:</p>
                                                    <p class="spa-sec-para-style">Monday to Thursday, from 10am to 9pm.<br>Friday to Sunday, from 10am to 8pm.</p>
                                                    <p class="spa-sec-para-style spa-bold-text">We need to inform you that our pool and sauna will be closed for the yearly maintenance work from 31<sup>st</sup> of July-18th of August 2017. We really apologize for the upcoming inconvenience.</strong></p>
                                                    <div class="spa-booking-info">
                                                        <p class="spa-sec-para-style">BOOKINGS:</p>
                                                        <p class="spa-sec-para-style">Phone: +49 30 311 722-160</p>
                                                        <p class="spa-sec-para-style"><a class="spa-booking-link" href="#">http://design-locations.biz</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="spa-description-pannel2">
                                            <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/spa-img3.jpg')}}" alt=""/>
                                            <div class="spa-products-tittles-align">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/spa-product.jpg')}}" alt=""/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <blockquote class="spa-content-quote">
                                                            "Organic treats are cosmetics with all natural ingredients, produced according to the strictest organic principles. In them, the proportion of active herbal and organic ingredients cultivated in the wild is exceptionally high."
                                                            <p class="content-quote-author">Susanne Kaufmann</p>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--About Page End Here-->
        </div>
        <!--<Desktop Version End Here-->
        <div class="page-bg-image hidden-md hidden-lg"> 
            <div class="wrapper ">
                <div class="container-fluid">
                    <div class="row">
                        <header>
                            <div class="landing-mobile-top-header">
                                <div class="col-md-2 col-xs-2 col-sm-2">
                                    <div class="row">
                                        <div class="mobile-logo-d">D</div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 col-sm-2">
                                    <div class="row">
                                        <div class="row res-margin-align">
                                            <div id="mySidenavpost" class="sidenavpost">
                                                <div class="filter-width">
                                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavpost()">&times;</a>
                                                    <div class="design-locations-logo">
                                                        <a href="index.html"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                                    </div>
													<div class="serach-page-menu">
														<ul>
															<li><a href="{{URL::to('luxurytravel/Hotel?ref=oc')}}">Hotels</a></li>
															<li><a href="http://www.emporium-yachts.com/luxurytravel/Yachts">Yachts</a></li>
														</ul>
													</div>
                                                    <div class="design-locations-logo">
                                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                                            <input  class="bh-search-input typeahead search-navbar" name="s" id="search-navbar-sidemenu" placeholder="SEARCH" type="text">
                                                        </form>
                                                    </div>
                                                    <div class="panel-group" id="accordion">
                                                        <div class="panel panel-default custom-post-panel">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                                <div class="panel-heading custom-heading">
                                                                    Experience
                                                                </div>
                                                            </a>
                                                            <div id="collapse1" class="panel-collapse collapse">
                                                                <div class="panel-body custom-panel-body">
                                                                    <div class="dl-filter">
                                                                        <form>
																			@if(!empty($experiences))
																				@foreach($experiences as $experience)
																					<div class="form-group post-filter-inputs">
																						<label><a href="{{URL::to('luxury_experience/'. str_replace(' ','_',$experience->category_name))}}">{{$experience->category_custom_title}}</a></label>
																					</div> 
																				@endforeach
																			@endif
                                                                           <!-- <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Beach_Hotels')}}">Luxury Beach Hotels</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Green_Properties')}}">Luxury Green Hotels</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Go_Urban_Hotels')}}">Luxury Urban Hotels</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Infinity_Pools')}}">Luxury Infinity Pools</a></label>
                                                                            </div>
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Spa_and_Wellness_Hotels')}}">Luxury Spa and Wellness Hotels</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Mountain_Ski_Resorts')}}">Luxury Mountains and Skin Resorts</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Yoga_Hotels')}}">Discover Yoga Hotels</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Culinary_Delights')}}">Discover culinary Delight Hotels</a></label>
                                                                            </div>
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Family_Friendly')}}">Discover Family Friendly Hotels</a></label>
                                                                            </div> 
                                                                            <div class="form-group post-filter-inputs">
                                                                                <label><a href="{{URL::to('luxury_experience/Unusual_Adventure_Hotels')}}">Unusual Adventure Hotels</a></label>
                                                                            </div>-->
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="filter-footer">
                                                        <div><a href="#" >View All Locations On Map</a></div>
                                                        <div><a href="#"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear All</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="landing-filters">
                                                <span style="font-size:14px;cursor:pointer" onclick="toogleNavpost()"><img  src="{{ asset('sximo/assets/images/menu.png')}}" alt=""/></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 col-sm-2 text-align">
                                    <div class="row">
                                        <a  data-popup-id="search-page" class="video-popup-btn landing-search" href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 col-sm-2 text-align">
                                    <div class="row">
                                        <a class="add-to-cart" href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 col-sm-2 text-align">
                                    <a class="landing-header-destination" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                </div> 
                                <div class="col-md-2 col-xs-2 col-sm-2 text-align">
                                    <div class="row">
                                        <div class="dropdown">
                                            <button class="dropbtn"><i class="fa fa-share-alt-square" aria-hidden="true"></i></button>
                                            <div class="dropdown-content">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="container"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header-logo-align">
                                <a href="#"><img class="img-responsive height-165" onmouseenter="this.src='{{ asset('sximo/assets/images/luxury-logo-new.png')}}'" onmouseout="this.src = '{{ asset('sximo/assets/images/design-location-logo.png')}}'" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt="design locations"/></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="panel-group" id="accordion-mobile">
                                <div class="panel panel-default  sub-menues">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-mobile" href="#collapse-mobile-1">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                Search our collection
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapse-mobile-1" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                            <input type="hidden" name="ref" value="oc_small">
                                                <input  class="bh-search-input ai-md-search-input typeahead search-navbar main-search-box" name="s" id="search-navbar-our-collection-res" placeholder="Enter Your Hotel or Destination" type="text">
                                            </form>
											<div class="serach-page-menu">
												<ul>
													<li><a href="{{URL::to('luxurytravel/Hotel')}}">Hotels</a></li>
													<li><a href="http://www.emporium-yachts.com/luxurytravel/Yachts">Yachts</a></li>
												</ul>
											</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default  sub-menues">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-mobile" href="#collapse-mobile-2">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                Select Your Experience
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapse-mobile-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel landing-page-panel-background">
                                                <div class="width-100 holiday-type-image-align ">
													@if(!empty($experiences))
														@foreach($experiences as $experience)
															<div class="width-20">
																<a href="{{URL::to('luxury_experience/'. str_replace(' ','_',$experience->category_name))}}">
																	<img src="{{ \ImageCache::make(public_path('uploads/category_imgs/'.$experience->category_image),100,170,199)}}" alt=""/>
																	<span class="link-txt hover-cation">{{$experience->category_custom_title}}</span>
																</a>
															</div>
														@endforeach
													@endif
                                                    <!--<div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Beach_Hotels')}}">
                                                            <img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoBeachHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Luxury Beach Hotels</span>
                                                        </a>

                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Green_Properties')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoGreenHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Luxury Green Hotels</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Go_Urban_Hotels')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoUrbanHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Luxury Urban</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Infinity_Pools')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoInfinityPoolHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Luxury Infinity Pools</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Spa_and_Wellness_Hotels')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoSpaandWellnessHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Luxury Spa and Wellness Hotels</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="width-100 holiday-type-image-align ">
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Mountain_Ski_Resorts')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoMountainaandSkiResorts.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Luxury Mountains and Skin Resorts</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Yoga_Hotels')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoYogaHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Discover Yoga Hotels</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Culinary_Delights')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoCulnaryDelightHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Discover culinary Delight Hotels</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Family_Friendly')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoFamilyFriendlyHotels.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Discover Family Friendly Hotels</span>
                                                        </a>
                                                    </div>
                                                    <div class="width-20">
                                                        <a href="{{URL::to('luxury_experience/Unusual_Adventure_Hotels')}}"><img src="{{ \ImageCache::make(public_path('sximo/assets/images/GoUnusualAdventures.jpg'),100,170,199)}}" alt=""/>
                                                            <span class="link-txt hover-cation">Unusual Adventure Hotels</span>
                                                        </a>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="panel panel-default  sub-menues">
                                    <a href="{{url()}}/home" class="collapsed">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                Get Inspired
                                            </h4>
                                        </div>
                                    </a>
                                </div>-->
                                <div class="panel panel-default  sub-menues">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-mobile" href="#collapse-mobile-7">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                Search By Date
                                            </h4>
                                        </div>
                                    </a>
                                    <!-- AIC responsive search collapse -->
                                <div id="collapse-mobile-7" class="panel-collapse collapse">
                                    <div  class="panel-body">
                                        <div class="panel landing-page-panel-background">
                                            <div class="padding-panel-div">
                                                <div class="headings">
                                                    <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
                                                    <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="destinSearchMob">
                                                <form action="http://www.emporium-voyage.com/search" method="get">
                                                        <input name="s" value="" type="hidden">
                                                        <input name="ref" value="sbd" type="hidden">
                                                        
<!--                                                        <div class="form-group">
                                                            <label for="sel1">Select list (select one):</label>
                                                            <select class="form-control" id="sel1">
                                                              <option>1</option>
                                                              <option>2</option>
                                                              <option>3</option>
                                                              <option>4</option>
                                                            </select>
                                                        </div>-->
                                                        <ul class="dates" id="search-by-date">
                                                            <li>
                                                                <div class="heading">Arrive</div>
                                                                    <input id="date-range-arrive" size="20" name="arrive" type="hidden" value="12.01.2018">
                                                                    <select class="form-control ariveSelect" id="sel1">
                                                                        <option>Day</option>
                                                                        <option>Month</option>
                                                                        <option>Year</option>
                                                                    </select>
                                                            </li>
                                                            <li>
                                                                <div class="heading">Departure</div>
                                                                <input id="date-range-destination" size="20" type="hidden" name="destination" value="">
                                                                <select class="form-control ariveSelect" id="sel1">
                                                                    <option>Day</option>
                                                                    <option>Month</option>
                                                                    <option>Year</option>
                                                                </select>
                                                            </li>
                                                        </ul>
                                                        <ul class="dates">
                                                            <li>
                                                                <div class="heading">Adults</div>
                                                                <select name="adult">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                </select>
                                                            </li>
                                                            <li>
                                                                <div class="heading">Children</div>
                                                                <select name="childs">
                                                                    <option>0</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                </select>
                                                            </li>
                                                            <div class="clearfix"></div>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                        <div class="submit-btn editorial-submit-btn">
                                                            <button class="booking-form-pop-up-btn-" data-popup-id="booking-form-pop-up" type="submit">BOOK NOW</button>
                                                        </div>
                                                    </form>
                                                    <div class="view-modify-cancel-booking">
                                                        <a href="#">View, Modify or Cancel your Booking</a>
                                                    </div>
                                                    <ul class="booking-page-footer-section">
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <span>Join the worlds leading luxury club</span>
                                                                <h6 class="center">Enjoy exclusive members only benefits</h6>
                                                            </a>
                                                            <div class="white-border-bottom"></div>
                                                        </li>
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <span>Spa Treatment</span>
                                                                <h6 class="center">Book</h6>
                                                            </a>
                                                            <div class="white-border-bottom"></div>
                                                        </li>
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <span>View or Modify Reserveration</span>
                                                                <h6 class="center">Login to Support Center</h6>
                                                            </a>
                                                            <div class="white-border-bottom"></div>
                                                        </li>
                                                        <div class="clearfix"></div>
                                                    </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div></div>
                                <div class="panel panel-default  sub-menues">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-mobile" href="#collapse-mobile-3">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                Select Your Destination
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapse-mobile-3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel landing-page-panel-background">
                                                <div class="padding-panel-div">
                                                    <div class="clearfix"></div>
                                                    <div class="destinSearchMob">
                                                        <!--Search form start-->
                                                        <form autocomplete="off" method="get" id="searchform-navbar" class="destinationsearchform-navbar" action="{{URL::to('search')}}">
                                                            <input type="hidden" name="ref" value="syd_small">
                                                            <input  class="bh-search-input typeahead search-navbar" name="s" id="search-navbar-destination-res" placeholder="ENTER YOUR DESTINATION" type="text">
                                                        </form>
                                                        <!--Search form end-->
                                                    </div>

                                                    <?php 

                                                       /* Note:
                                                            Now the our destinations will render from storage/app/homeOurDestinationMobile.html. 
                                                            That file will be genrate from cron job or backend panel.  
                                                        */  
                                                        
                                                        //

                                                    ?>
                                                    {!!Storage::get('homeOurDestinationMobile.html')!!}
                                                    @if(!empty($ourdesitnation))
                                                    <div class="panel-group-" id="mobile-inner-accordian">
                                                        @foreach($ourdesitnation as $destination)
                                                        <div class="panel panel-default  destination-sub-menues">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#mobile-inner-accordian" href="#mobile-inner{{$destination['maincat']->id}}">
                                                                <div class="destination-panel-heading">
                                                                    <h4 class="panel-title menu-text accordion ">
                                                                        {{$destination['maincat']->category_name}}
                                                                    </h4>
                                                                </div>
                                                            </a>
                                                            <div id="mobile-inner{{$destination['maincat']->id}}" class="panel-collapse collapse ">
                                                                <div class="panel-body">
                                                                    @if (array_key_exists("child",$destination))
                                                                    <ul class="where-box-sub-menu">
                                                                        @foreach($destination['child'] as $childDest)
                                                                        <li><a href="{{URL::to('luxury_destinations/'. str_replace(' ','_',$destination['maincat']->category_name).'/'. str_replace(' ','_',$childDest->category_name).'/'. str_replace(' ','_',$childDest->category_name))}}">{{$childDest->category_name}}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="panel panel-default  sub-menues">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-mobile" href="#collapse-mobile-4">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                Personalized Service
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapse-mobile-4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-6 about-us-sec">
                                                <div class="row">
                                                    <img  src="{{ asset('sximo/assets/images/room.png')}}" alt=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 about-us-side-text">
                                                <div class="border-box">
                                                    <a class="video-popup-btn btn-style" data-popup-id="register-popup" href="#">Register</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default  sub-menues">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-mobile" href="#collapse-mobile-5">
                                        <div class="panel-heading">
                                            <h4 class="panel-title menu-text accordion">
                                                About
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapse-mobile-5" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-6 about-us-sec">
                                                <div class="row">
                                                    <img  src="{{ asset('sximo/assets/images/GoMountainaandSkiResorts.jpg')}}" alt=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 about-us-side-text">
                                                <div class="border-box">
                                                    <h2>Design Locations</h2>
                                                    <p>
                                                        From the posh, sun-soaked beaches along the
                                                        Indian Ocean to the epoch heights of the Himalayas,
                                                        Design Location is your ideal, vogue vacation planner!
                                                        With over 300 posh properties and elite spas huddled in its cocoon,
                                                        Design Locations ensure the ultimate luxury experience. Our expertise lies in our utmost diligence to provide our beau monde customers with an exotic experience they will relish forever. If you are looking for glamour, grandeur and some sinful indulgence in the lap of luxury, you have come to the right place!
                                                    </p>
                                                    <a href="#" class="about-read-more-button">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            <!--Footer Section-->
                        <div class="panel-group" id="landing-footer-accordian">
                            @if(!empty($landing_menus))
                            <div class="panel panel-default">
                                <a class="collapsed" data-toggle="collapse" data-parent="#landing-footer-accordian" @if($fmenu['menu_type'] =='external') href="{{ URL::to($fmenu['url'])}}" @else href="{{ URL::to($fmenu['module'])}}" @endif>
                                   <div class="panel-heading">
                                        <h4 class="panel-title menu-text accordion">
                                            @if(CNF_MULTILANG ==1 && isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                                            {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                                            @else
                                            {{$fmenu['menu_name']}}
                                            @endif
                                        </h4>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                        <!--Next-->
                    </div>
                </div>
            </div>
        </div>
        <!--Register Pop Up Start Here main-->
        <div id="register-popup" class="popup personlized-service-pop-up-outer">
            <div class="popup-inner personlized-service-pop-up">
                <a href="#" class="popup-close-btn personlized-service-pop-up-close-btn">&times;</a>
                <div class="popup-content personlized-service-content">
                    <div class="popup-form-center">
                        <div class="form-tittle">
                            <h3>JohnnyShares - Sharing & Collaboration Platform</h3>
                        </div> 
                        <div class="form-content clearfix">
                            <div class="form-logo">
                                <img class="img-responsive" src="{{ asset('sximo/assets/images/logo-design_1.png')}}" alt="Design Locations">
                            </div>
                            <div>
                                <ul class="navigation-tabs">
                                    <li><a href="#" class="active" id="sign-in-form-link">Sign in</a></li>
                                    <li><a href="#" id="forgot-password-link">Forgot Password</a></li>
                                    <li><a href="#" id="register-form-link">Register</a></li>
                                </ul>
                            </div>
                            <div class="input-fileds">
                                <form  id="login-form" role="form" style="display: none;">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="email_address" placeholder="Email Address" class="form-control">
                                        <i class="fa fa-user input-fa" aria-hidden="true"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input placeholder="Password" type="Password" name="password"  class="form-control">
                                        <i class="fa fa-lock input-fa" aria-hidden="true"></i>
                                    </div>
                                    <div class="form-group">
                                        <label> Remember Me ? </label>
                                        <input class="remember-me-checkbox" name="remember" value="1" type="checkbox">
                                        <i class="fa fa-lock input-fa remember-me-fa" aria-hidden="true"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Language</label>
                                        <select class="form-control" name="language">
                                            <option value="Deutsch"> Deutsch</option>
                                            <option value="en"> English</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-info form-sign-in-btn btn-sm btn-block" type="submit">Sign In</button>
                                </form>
                                <form id="register-form" role="form" style="display: block;">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="user_name" placeholder="Name" class="form-control">
                                        <i class="fa fa-user input-fa" aria-hidden="true"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="email_address" placeholder="Email Address" class="form-control">
                                        <i class="fa fa-user input-fa" aria-hidden="true"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input placeholder="Password" type="Password" name="password"  class="form-control">
                                        <i class="fa fa-lock input-fa" aria-hidden="true"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input placeholder="Confirm Password" type="Password" name="password"  class="form-control">
                                        <i class="fa fa-lock input-fa" aria-hidden="true"></i>
                                    </div>
                                    <button class="btn btn-info form-sign-in-btn btn-sm btn-block" type="submit">Sign Up</button>
                                </form>
                                <form id="forgot-password" role="form" style="display: none;">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="email_address" placeholder="Email Address" class="form-control">
                                        <i class="fa fa-user input-fa" aria-hidden="true"></i>
                                    </div>
                                    <button class="btn btn-info form-sign-in-btn btn-sm btn-block" type="submit">Recover Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--Register Pop Up End Here main-->
        <!--New Login Pop Up Start Here main-->
        <div id="login-forms-popup" class="popup login-form-pop-main-align">
             <div class="popup-inner">
                 <a href="#" class="popup-close-btn">&times;</a>
                 <div class="popup-content">
                     <div class="content-area">
<!--                         <a class="dl-pop-logo-align" href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}"></a>-->
                     </div>
                     <!--Login Forms Start Here-->
                     <div class="landing-page-lock-login-btn-outer-align">
                         <div class="login-form-show-hide" style="display:block;">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
<!--                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>-->
                                         <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="ps-login-signup-form-top-bar1">
                                        <div class="col-md-12 col-sm-6">
                                           <div class="row">
                                               <div class="ps-forms-cross-icons">
                                                   <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
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
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/angel-fernandez-alonso-220762.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="forgot-pass-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
<!--                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>-->
                                         <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="ps-login-signup-form-top-bar1">
                                        <div class="col-md-12 col-sm-6">
                                           <div class="row">
                                               <div class="ps-forms-cross-icons">
                                                   <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
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
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Kootenay Aurora 1-X3.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="create-account-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
<!--                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons1">
                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>-->
                                         <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="ps-login-signup-form-top-bar1">
                                        <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
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
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/matthew-kane-365718.jpg')}}" alt=""/>
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
        <!--New Login Pop Up End Here main-->
        
        <!-- my popup hamburg menu -->
        <div id="ev-primary-navigation" class="popup personlized-service-pop-up-outer">
            <div class="popup-inner personlized-service-pop-up EVpopService">
                <a href="#" class="popup-close-btn personlized-service-pop-up-close-btn">&times;</a>
                <div class="popup-content personlized-service-content EVhamburgService">
                    <!-- code here-->
                    <div class="col-md-12">
			<div id="" class="">
				<div class="popup-inner personlized-service-pop-up EVpopService">
					<!--<a href="#" class="popup-close-btn personlized-service-pop-up-close-btn">&times;</a>-->
					<div class="popup-content personlized-service-content">
						<div class="popup-form-center EVcenterPOP">
							<ul class="EVMenu">
								<li><a href="#">Sleep</a>
									<ul class="sub-menu">
										<li><a class="activeEV" href="#">Suite Présidentielle</a></li>
										<li><a href="#">Suite Terrasse</a></li>
										<li><a href="#">Top Of Five</a></li>
										<li><a href="#">Suites So Suite</a></li>
										<li><a href="#">Junior Suites</a></li>
										<li><a href="#">Chambres</a></li>
										<li><a href="#">Executive</a></li>
										<li><a href="#">Chambres Deluxe</a></li>
										<li><a href="#">Services</a></li>
									</ul>
								</li>
								<li><a href="#">Savour</a>
									<ul class="sub-menu">
										<li><a class="activeEV" href="#">Le Roof</a></li>
										<li><a href="#">Le Bar</a></li>
										<li><a href="#">Le Brunch</a></li>
									</ul>
								</li>
								<li><a href="#">Relax</a>
									<ul class="sub-menu">
										<li><a class="activeEV" href="#">Spa</a></li>
										<li><a href="#">Terrasse piscine</a></li>
										<li><a href="#">Plage privée</a></li>
									</ul>
								</li>
								<li><a href="#">Discover</a>
									<ul class="sub-menu">
										<li><a class="activeEV" href="#">Cannes</a></li>
										<li><a href="#">Activités</a></li>
									</ul>
								</li>
								<li><a href="#">News</a>
								</li>
								<li><a href="#">Offers</a>
									<ul class="sub-menu">
										<li><a class="activeEV" href="#">Offers Sleep</a></li>
										<li><a href="#">Offers Relax</a></li>
									</ul>
								</li>
								<li><a href="#">Gift box</a>
								</li>
                                                                <li><a href="#">Events</a>
								</li>
                                                                <li class="smallEV"><a href="#">CarriÃ¨res</a>
								</li>
                                                                <li class="smallEV"><a href="#">Plan & AccÃ¨s</a>
								</li>
                                                                <li class="smallEV"><a href="#">Mentions lÃ©gales</a>
								</li>
                                                                <li class="smallEV"><a href="#">Green Globe</a>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		 </div>
                    <!-- code here-->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--my popup hamburg menu End Here-->
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
<!--                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>-->
                                         <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="ps-login-signup-form-top-bar1">
                                        <div class="col-md-12 col-sm-6">
                                           <div class="row">
                                               <div class="ps-forms-cross-icons">
                                                   <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
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
<!--                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>-->
                                         <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="ps-login-signup-form-top-bar1">
                                        <div class="col-md-12 col-sm-6">
                                           <div class="row">
                                               <div class="ps-forms-cross-icons">
                                                   <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
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
<!--                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons1">
                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>-->
                                         <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="ps-login-signup-form-top-bar1">
                                        <div class="col-md-12 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
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
        <!-- end my popup-->
        
        <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
        
           <script> 
                $('.contact-aside').hover(
                    function(){ $(this).addClass('active') },
                    function(){ $(this).removeClass('active') }
                )
         </script>
        
        <script type="text/javascript">
            $(document).on('ready', function () {
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
                $(".to-booking-nav-show-hide-btn").click(function () {
                    $(".booking-form-bar-top").toggle(1000);
                });
                $("header .menu > a").click(function (event) {
                    event.preventDefault();
                    $(this).parent().find("ul").toggle("slow");
                });
                $(".trigger-click-on-book-now").click(function (event) {
                    event.preventDefault();
                    $(".open-book-now-page").trigger("click");
                });
                /*Login form Scripts*/
                $(".sign-up-show-form-btn").click(function () {
                    $(".create-account-form-show-hide").show();
                    $(".account-with-us-show-hide").hide();
                    $(".login-form-show-hide").hide();
                    $(".forgot-pass-form-show-hide").hide();
                });
                $(".login-show-form-btn").click(function () {
                    $(".login-form-show-hide").show();
                    $(".account-with-us-show-hide").hide();
                    $(".create-account-form-show-hide").hide();
                    $(".forgot-pass-form-show-hide").hide();
                });
                $(".forgot-pass-show-form-btn").click(function () {
                    $(".forgot-pass-form-show-hide").show();
                    $(".login-form-show-hide").hide();
                    $(".account-with-us-show-hide").hide();
                    $(".create-account-form-show-hide").hide();
                });
                $(".show-account-with-us").click(function () {
                    $(".account-with-us-show-hide").show();
                    $(".forgot-pass-form-show-hide").hide();
                    $(".login-form-show-hide").hide();
                    $(".create-account-form-show-hide").hide();
                });
                /*Date Range Picker Start Here*/
                $('#search-by-date').dateRangePicker(
                    {
                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "12-01-2017",
                        format: ' DD.MM.YYYY',
                        separator: ' to ',
                        getValue: function ()
                        {
                            if ($('#search-date-range-destination').val() && $('#search-date-range-arrive').val())
                                return $('#search-date-range-destination').val() + ' to ' + $('#search-date-range-arrive').val();
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
                /*Date Range Picker End Here*/
                //Active Menu Start Here
                $('ul li a').click(function () {
                    $('li a').removeClass("active");
                    $(this).addClass("active");
                });
                /*Active Menu Start Here*/
                /*Register Tabs Start Here*/
                 $('#register-form-link').click(function (e) {
                    $("#register-form").delay(100).fadeIn(100);
                    $("#login-form").fadeOut(100);
                    $("#forgot-password").fadeOut(100);
                    $('#sign-in-form-link').removeClass('active');
                    $('#forgot-password-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });
                $('#sign-in-form-link').click(function (e) {
                    $("#login-form").delay(100).fadeIn(100);
                    $("#register-form").fadeOut(100);
                    $("#forgot-password").fadeOut(100);
                    $('#register-form-link').removeClass('active');
                    $('#forgot-password-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });
                $('#forgot-password-link').click(function (e) {
                    $("#forgot-password").delay(100).fadeIn(100);
                    $("#login-form").fadeOut(100);
                    $("#register-form").fadeOut(100);
                    $('#sign-in-form-link').removeClass('active');
                    $('#register-form-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });
                /*Register Tabs End Here*/
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
            });
            /*Previous Page Screen Short*/
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
            /*Previous Page Screen Short End Here*/
            /*Toggle Side Nav Start Here*/
            function toogleNavpost() {
                if (document.getElementById("mySidenavpost").style.width == "342px") {
                    return closeNavpost();
                }
                return openNavpost();
            }
            function openNavpost() {
                if ($(window).width() >= 768) {
                    document.getElementById("mySidenavpost").style.width = "342px";
                    document.getElementById("main").style.marginRight = "250px";
                } else {
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
            $(document).on('click', function (event) {
                if ($(window).width() <= 767) {
                    if ($(event.target).has('.filter-width').length) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                    }
                }
            });
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
        </script>
        @include('layouts/elliot/ai_search-page')
        @include('layouts/elliot/ai_booking-page')
        @include('layouts/elliot/ai_newsletter')
        @include('layouts/elliot/ai_cookie-bar')
    </body>
</html>
