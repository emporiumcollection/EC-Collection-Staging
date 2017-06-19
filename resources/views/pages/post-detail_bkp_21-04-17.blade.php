@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/stick-nav-arrows.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/detail-page.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>

<script src="{{ asset('sximo/assets/js/animate.js')}}" type="text/javascript"></script>

@include('layouts/elliot/next_previous_arrow')
<!--Main Page Start here-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="section-padding">
            <div>
                <div class="post-title">
                    <h1><span>Design Locations</span></h1>
                </div>
                <div class="post-sub-titles">
                    <h2 class="main-sub-title">The pinnacle of lofty living</h2>
                    <h2 class="sub-tittle-des">Canal House Loft Amsterdam - <span>Interior &  Kitchen</span></h2>
                </div>
            </div>
            <div class="post-content" data-aos="fade-right">
                <div  class="slideshow-image">
                    <a data-popup-id="gallery-popup"  class="video-popup-btn" href="#">
                        <img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                        <div class="silde-show-btn interior-gallery" data-aos="zoom-in">
                            See Slideshow
                        </div>
                    </a>
                </div>
                <div class="about-project">
                    <h3>About this project</h3>
                    <p>We are always in search for the right balance between 
                        sustainability and aesthetics, which fortunately prove
                        to go hand in hand – and seem to remain happily married 
                        over the course of a lifespan. We source sustainable materials only, 
                        minimize our waste and never do anything excessive unless it’s absolutely necessary.
                    </p>
                    <p>
                        We wanted a very light and fresh look for this kitchen, with grey powder coated 
                        steel and a stainless steel countertop. On the opposing side, 
                        we created a spray plastered cabinet with a top made from Belgian blue stone.
                    </p>
                </div>
                <div class="double-image-sec">
                    <div class="left-image floating"  >
                        <img data-aos="fade-right" class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                    </div>
                    <div class="right-image floating"  >
                        <img data-aos="fade-right" class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                        <p>We gave this sideboard a herring bone motif from oak wood.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="description-text">
                    <p>Every single component in this loft adds to its strong and sturdy character. 
                        We constructed black oak walls in the bedroom and created a custom walnut cabinet. 
                        Furthermore, we casted concrete floors in the hallways
                    </p>
                </div>
                <div class="below-post-image" data-aos="fade-right">
                    <img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                </div>
            </div>
        </div>
        <!--Gallery popup start-->
        <div id="gallery-popup" class="popup">
            <div class="popup-inner post-popup">
                <a href="#" class="popup-close-btn">CLOSE</a>
                <div class="popup-content res-gallery-sec-padding">
                    <div class="image-slider-container">

                        <div class="clearfix"></div>
                        <ul class="image-slider post-page-sideshow">
                            <li class="active">
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/></a>
                            </li>
                        </ul>
                        <div class="images-count">1 / 4</div>
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn gallery-res-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-round-arrow.png')}}"  alt=""/>
                            </a>
                            <a class="image-slider-next-btn gallery-res-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-round-arrow.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <script src="../dist/aos.js"></script>
        <script>
AOS.init({
    easing: 'ease-in-out-sine'
});
        </script>
        @include('layouts/elliot/ai_footer_3')
        @include('layouts/elliot/ai_footer_2')
        