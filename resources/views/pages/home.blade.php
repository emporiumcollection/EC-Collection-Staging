@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>


<div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: 'slice-up', autoplay: true}">
    <ul style="height: 650px;" class="uk-slideshow uk-overlay-active">
        <li style="height: 650px;" class="uk-active" aria-hidden="true"><div style="background-image: url({{ asset('sximo/assets/images/editorial-banner.png')}});" class="uk-cover-background uk-position-cover"></div>
            <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
            <div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
                <div>
                    <ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Feb 04, 2016</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Design Location</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-overlay-title">
                        <a href="#">Design Location 1</a>
                    </h3>
                    <div class="bh-slideshow-overlay-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien sed…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#" title="Do it yourself">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
            </div>
            <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                <div>
                    <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Feb 04, 2016</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Design Location</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-thumbnail-split-preview-title">
                        <a href="#">Design Location 1</a>
                    </h3>
                    <div class="bh-slideshow-thumbnail-split-preview-content">Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien
                        sed aliquam ullamcorper. Fusce magna dolor, aliquam nec quam vel, 
                        lacinia rhoncus odio. Nulla facilisi. Donec laoreet diam eget nisi 
                        cursus laoreet. Suspendisse et commodo metus. Donec porttitor ut velit 
                        sit amet aliquam. Etiam diam enim, auctor eu ante…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
            </div>
        </li>
        <li class="" style="height: 650px;" aria-hidden="false"><div style="background-image: url({{ asset('sximo/assets/images/editorial-banner.png')}});" class="uk-cover-background uk-position-cover"></div>
            <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
            <div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
                <div>
                    <ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Dec 24, 2015</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Design Location</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-overlay-title">
                        <a href="#">Design Location 2</a>
                    </h3>
                    <div class="bh-slideshow-overlay-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien sed…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#" title="Design Location">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
            </div>
            <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                <div>
                    <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Dec 24, 2015</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Design Location</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-thumbnail-split-preview-title">
                        <a href="#">Design Location 2</a>
                    </h3>
                    <div class="bh-slideshow-thumbnail-split-preview-content">Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien
                        sed aliquam ullamcorper. Fusce magna dolor, aliquam nec quam vel, 
                        lacinia rhoncus odio. Nulla facilisi. Donec laoreet diam eget nisi 
                        cursus laoreet. Suspendisse et commodo metus. Donec porttitor ut velit 
                        sit amet aliquam. Etiam diam enim, auctor eu ante…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
            </div>
        </li>
        <li style="height: 650px;" aria-hidden="true"><div style="background-image: url({{ asset('sximo/assets/images/editorial-banner.png')}});" class="uk-cover-background uk-position-cover"></div>
            <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
            <div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
                <div>
                    <ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Nov 15, 2015</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Design Location</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-overlay-title">
                        <a href="#">Design Location 3</a>
                    </h3>
                    <div class="bh-slideshow-overlay-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien sed…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#" title="Design Location">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
            </div>
            <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                <div>
                    <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Nov 15, 2015</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Design Location</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-thumbnail-split-preview-title">
                        <a href="#">Design Location 3</a>
                    </h3>
                    <div class="bh-slideshow-thumbnail-split-preview-content">Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien
                        sed aliquam ullamcorper. Fusce magna dolor, aliquam nec quam vel, 
                        lacinia rhoncus odio. Nulla facilisi. Donec laoreet diam eget nisi 
                        cursus laoreet. Suspendisse et commodo metus. Donec porttitor ut velit 
                        sit amet aliquam. Etiam diam enim, auctor eu ante…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
            </div>
        </li>
        <li style="height: 650px;" aria-hidden="true"><div style="background-image: url({{ asset('sximo/assets/images/editorial-banner.png')}});" class="uk-cover-background uk-position-cover"></div>
            <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
            <div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
                <div>
                    <ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Nov 15, 2015</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Decorations</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-overlay-title">
                        <a href="#">Design Location 4</a>
                    </h3>
                    <div class="bh-slideshow-overlay-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien sed…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#" title="Do it yourself">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
            </div>
            <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                <div>
                    <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                        <li>
                            <span>Nov 15, 2015</span>
                        </li>
                        <li>
                            <span><a href="#" rel="category tag">Decorations</a></span>
                        </li>
                    </ul>
                    <h3 class="bh-slideshow-thumbnail-split-preview-title">
                        <a href="#">Design Location 4</a>
                    </h3>
                    <div class="bh-slideshow-thumbnail-split-preview-content">Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra sapien
                        sed aliquam ullamcorper. Fusce magna dolor, aliquam nec quam vel, 
                        lacinia rhoncus odio. Nulla facilisi. Donec laoreet diam eget nisi 
                        cursus laoreet. Suspendisse et commodo metus. Donec porttitor ut velit 
                        sit amet aliquam. Etiam diam enim, auctor eu ante…</div>
                    <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                </div>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
            </div>
        </li>
    </ul>
</div>
<!--Home slider end-->

<!--Sections-->
<section id ="destination" class="sections-one">
    <div class="container-fluid">
        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="col-md-6 col-sm-6 col-xs-12 featured-hotels">
                    <div class="image-slider-container">
                        <ul class="image-slider">
                            <li class="active">
                                <a class="video-popup-btn" data-popup-id="featured-hotel-popup" href="#">
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/FEATURED.png')}}" alt=""/>
                                    <div class="titles">
                                        <div class="">Our</div>
                                        <div class="text-with-border">FEATURED</div>
                                        <div class="">Hotels</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="video-popup-btn" data-popup-id="featured-hotel-popup" href="#">
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/FEATURED.png')}}" alt=""/>
                                    <div class="titles">
                                        <div class="">Our</div>
                                        <div class="text-with-border">FEATURED</div>
                                        <div class="">Hotels</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="video-popup-btn" data-popup-id="featured-hotel-popup" href="#">
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/FEATURED.png')}}" alt=""/>
                                    <div class="titles">
                                        <div class="">Our</div>
                                        <div class="text-with-border">FEATURED</div>
                                        <div class="">Hotels</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="video-popup-btn" data-popup-id="featured-hotel-popup" href="#">
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/FEATURED.png')}}" alt=""/>
                                    <div class="titles">
                                        <div class="">Our</div>
                                        <div class="text-with-border">FEATURED</div>
                                        <div class="">Hotels</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="images-count">1 / 4</div>
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn" href="#">
                                <img class="img-responsive" src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn" href="#">
                                <img class="img-responsive" src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row ediors-choice">
                        <div class="image-slider-container background-images">
                            <ul class="image-slider">
                                <li class="active">
                                    <a href="{{url('property/la-mirage')}}"><img class="img-responsive res-product-margin-top-25" src="{{ asset('sximo/assets/images/editors.png')}}" alt=""/></a>
                                    <a href="{{url('property/la-mirage')}}">
                                        <div class="titles">
                                            <div class="bold-text">EDITOR'S</div>
                                            <div class="">Choice</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('property/la-mirage')}}"><img class="img-responsive res-product-margin-top-25" src="{{ asset('sximo/assets/images/editors.png')}}" alt=""/></a>
                                    <div class="titles">
                                        <h2 class="categories">Hotel</h2>
                                        <h3 class="cat-names"><a href="#">Editors Choice</a></h3>
                                    </div>
                                </li>
                            </ul>
                            <div class="image-slider-btns">
                                <a class="image-slider-previous-btn" href="#">   
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                </a>
                                <a class="image-slider-next-btn" href="#">
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                </a>
                            </div>
                            <!--<div class="images-count">1 / 4</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12 res-our-video-align">
                <div class="col-md-6 col-sm-6 col-xs-12 video">
                    <a data-popup-id="video-popup" class="video-popup-btn open-video-pop-up" href="#"><img src="{{ asset('sximo/assets/images/OUR-VIDEO-CHANNEL.jpg')}}" alt=""/></a>
                    <a href="#" class="trigger-click-on-video-pop-up">
                        <div class="titles">
                            <div class="bold-text">OUR VIDEO CHANNEL</div>
                            <div class="">La Belle Epoque</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 discover-new-hotels">
                    <div class="image-slider-container auto-slider">
                        <ul class="image-slider">
                            <li class="active">
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/discover-our-new-hotels.png')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/BeachHotels2.jpg')}}" alt=""/></a>  
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/GoGreen2.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/GoUrban2.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/InfinityPools2.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/SpaAndWellnessHotels3.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/MountainAndSki2.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/YogaHotels3.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/CulinaryDelights.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/FamilyFriendly-1.jpg')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="{{url()}}/property"><img src="{{ asset('sximo/assets/images/UnusualAdventures.jpg')}}" alt=""/></a>
                            </li>
                        </ul>
                        <div class="images-count">1 / 4</div>
                        <div class="image-slider-btns ">
                            <a class="image-slider-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="row res-row">
                    <div class="col-md-7 col-sm-7 col-xs-12 interior-gallery">
                        <a data-popup-id="gallery-popup" class="video-popup-btn" href="#"><img src="{{ asset('sximo/assets/images/get-inspired.png')}}" alt=""/></a>
                        <div class="titles">
                            <div class="bold-text">GET INSPIRED</div>
                            <div class="">Gallery</div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-sm-12 col-xs-12 product">
                        <div class="row">
                            <div class="inner">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <a data-popup-id="product-popup-" class="video-popup-btn-" href="{{url()}}/product-grid-shuffle"><img class="img-responsive res-product-margin-top-25" src="{{ asset('sximo/assets/images/vailesess-aver.png')}}" alt=""/></a>
                                            <div class="titles">
                                                <div class="">VAILESESS AVER</div>
                                                <div class="small-text">spring collection</div>
                                            </div>
                                            <a class="shop-now-btn" href="{{url()}}/filters-grid">Shop Now</a>
                                        </li>
                                        <li class="">
                                            <a data-popup-id="product-popup-" class="video-popup-btn-" href="{{url()}}/product-grid-shuffle"><img class="img-responsive  res-product-margin-top-25" src="{{ asset('sximo/assets/images/vailesess-aver.png')}}" alt=""/></a>
                                            <div class="titles">
                                                <div class="">VAILESESS AVER</div>
                                                <div class="small-text">spring collection</div>
                                            </div>
                                            <a class="shop-now-btn" href="{{url()}}/filters-grid">Shop Now</a>
                                        </li>
                                        <li class="">
                                            <a data-popup-id="product-popup-" class="video-popup-btn-" href="{{url()}}/product-grid-shuffle"><img class="img-responsive  res-product-margin-top-25" src="{{ asset('sximo/assets/images/vailesess-aver.png')}}" alt=""/></a>
                                            <div class="titles">
                                                <div class="">VAILESESS AVER</div>
                                                <div class="small-text">spring collection</div>
                                            </div>
                                            <a class="shop-now-btn" href="{{url()}}/filters-grid">Shop Now</a>
                                        </li>
                                        <li class="">
                                            <a data-popup-id="product-popup-" class="video-popup-btn-" href="{{url()}}/product-grid-shuffle"><img class="img-responsive  res-product-margin-top-25" src="{{ asset('sximo/assets/images/vailesess-aver.png')}}" alt=""/></a>
                                            <div class="titles">
                                                <div class="">VAILESESS AVER</div>
                                                <div class="small-text">spring collection</div>
                                            </div>
                                            <a class="shop-now-btn" href="{{url()}}/filters-grid">Shop Now</a>
                                        </li>
                                    </ul>
                                    <div class="images-count res-shop-now-btn-align">1 / 4</div>
                                    <div class="image-slider-btns res-shop-now-btn-align">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 our-villas-yacht-align">
                <div class="col-md-6 col-sm-6 col-xs-12 hotel-interior">
                    <div class="image-slider-container">
                        <ul class="image-slider">
                            <li class="active">
                                <a href="{{url('luxurytravel/Villas')}}"><img class="img-responsive" src="{{ asset('sximo/assets/images/our-villas.png')}}" alt=""/></a>
                                <div class="titles">
                                    <div class="caps-text">OUR VILLAS</div>
                                    <div class="">Interior</div>
                                </div>
                            </li>
                            <li class="">
                                <a href="{{url('luxurytravel/Villas')}}><img class="img-responsive" src="{{ asset('sximo/assets/images/our-villas.png')}}" alt=""/></a>
                                <div class="titles">
                                    <div class="caps-text">OUR VILLAS</div>
                                    <div class="">Interior</div>
                                </div>
                            </li>
                        </ul>
                        <!--<div class="images-count">1 / 4</div>-->
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 yacht-interior">
                    <div class="image-slider-container">
                        <ul class="image-slider">
                            <li class="active">
                                <a href="{{url('luxurytravel/Yachts')}}"><img src="{{ asset('sximo/assets/images/our-yacjts.png')}}" alt=""/></a>
                                <div class="titles">
                                    <div class="caps-text">OUR YACHTS</div>
                                    <div class="">Charter</div>
                                </div>
                            </li>
                            <li class="">
                                <a href="{{url('luxurytravel/Yachts')}}"><img class="img-responsive" src="{{ asset('sximo/assets/images/our-yacjts.png')}}" alt=""/></a>
                                <div class="titles">
                                    <div class="caps-text">OUR YACHTS</div>
                                    <div class="">Charter</div>
                                </div>
                            </li>
                        </ul>
                        <div class="images-count">1 / 2</div>
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="col-md-5  col-sm-12 col-xs-12 alltabs custom-tabs">

                <!--Tabs start-->

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#all-cats">ALL</a></li>
                    <li><a data-toggle="tab" href="#design-tab">DESIGN</a></li>
                    <li><a data-toggle="tab" href="#dream-escapes-tab">DREAM ESCAPES</a></li>
                </ul>
                <div class="tab-content">
                    <div id="all-cats" class="tab-pane fade in active">
                        <ul class="thumb-container">
                            <li class="thumb">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <div class="clearfix"></div>
                                <h5 class="title res-text-align-center">Normann Copenhagen:</h5>
                                <h5 class="res-text-align-center"><b><i >Bell Lamp</i></b></h5>
                                <br/>
                                <div class="text-muted res-text-align-center"><small>18 DEC 2016</small><div class="clearfix"></div></div>
                                <br/>
                                <p class="res-text-align-center">Normann Copehagen is a Danish design company with the mission to create original, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                            </li>
                            <li class="thumb">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <div class="clearfix"></div>
                                <h5 class="title res-text-align-center">Normann Copenhagen:</h5>
                                <h5 class="res-text-align-center"><b><i >Bell Lamp</i></b></h5>
                                <br/>
                                <div class="text-muted res-text-align-center"><small>18 DEC 2016</small><div class="clearfix"></div></div>
                                <br/>
                                <p class="res-text-align-center">Normann Copehagen is a Danish design company with the mission to create original, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                            </li>
                        </ul>
                    </div>
                    <div id="design-tab" class="tab-pane fade">
                        <ul class="thumb-container">
                            <li class="thumb">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <h5 class="title res-text-align-center">Normann Copenhagen:</h5>
                                <h5 class="res-text-align-center"><b><i >Bell Lamp</i></b></h5>
                                <br/>
                                <div class="text-muted res-text-align-center"><small>18 DEC 2016</small><div class="clearfix"></div></div>
                                <br/>
                                <p class="res-text-align-center">Normann Copehagen is a Danish design company with the mission to create original, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                            </li>
                            <li class="thumb">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <h5 class="title res-text-align-center">Normann Copenhagen:</h5>
                                <h5 class="res-text-align-center"><b><i >Bell Lamp</i></b></h5>
                                <br/>
                                <div class="text-muted res-text-align-center"><small>18 DEC 2016</small><div class="clearfix"></div></div>
                                <br/>
                                <p class="res-text-align-center">Normann Copehagen is a Danish design company with the mission to create original, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                            </li>
                        </ul>
                    </div>
                    <div id="dream-escapes-tab" class="tab-pane fade">
                        <ul class="thumb-container">
                            <li class="thumb">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <h5 class="title res-text-align-center">Normann Copenhagen:</h5>
                                <h5 class="res-text-align-center"><b><i>Bell Lamp</i></b></h5>
                                <br/>
                                <div class="text-muted res-text-align-center"><small>18 DEC 2016</small><div class="clearfix"></div></div>
                                <br/>
                                <p class="res-text-align-center">Normann Copehagen is a Danish design company with the mission to create original, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                            </li>
                            <li class="thumb">
                                <div class="image-slider-container">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/Normann-Copenhagen.jpg')}}" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <h5 class="title res-text-align-center ">Normann Copenhagen:</h5>
                                <h5 class="res-text-align-center"><b><i >Bell Lamp</i></b></h5>
                                <br/>
                                <div class="text-muted res-text-align-center"><small>18 DEC 2016</small><div class="clearfix"></div></div>
                                <br/>
                                <p class="res-text-align-center">Normann Copehagen is a Danish design company with the mission to create original, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--Tabs end-->

            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 interview-container">
                <div class="inner">
                    <div class="col-md-12 col-sm-6">
                        <div class="interview">
                            <!--                                                <p class="top">INTERVIEWS</p>
                                                                            <img class="img-responsive" src="{{ asset('sximo/assets/images/interviews.png')}}" alt=""/>
                                                                            <p class="bottom">Architect</p>-->
                            <div class="interview testimoniales-container">
                                <ul class="">
                                    <li class="active">
                                        <div class="testimonialos-">
                                            <p class="top">INTERVIEWS</p>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/interviews.png')}}" alt=""/>
                                            </a>
                                            <p class="bottom">Architect 1</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="testimonialos-">
                                            <p class="top">INTERVIEWS</p>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/interviews.png')}}" alt=""/>
                                            </a>
                                            <p class="bottom">Architect 2</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="testimonialos-">
                                            <p class="top">INTERVIEWS</p>
                                            <a href="{{url()}}/filters-grid">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/interviews.png')}}" alt=""/>
                                            </a>
                                            <p class="bottom">Architect 3</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="btns">
                                    <a data-index="1" href="#"><i class="fa fa-circle"></i></a>
                                    <a data-index="2" href="#"><i class="fa fa-circle"></i></a>
                                    <a data-index="3" href="#"><i class="fa fa-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="testimoniales-container">
                            <ul class="">
                                <li class="active">
                                    <div class="testimonialos">
                                        <p>1 These are our Client Testimonials These are our Client Testimonials</p>
                                        <p class="author">Ullilow</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="testimonialos">
                                        <p>2 These are our Client Testimonials These are our Client Testimonials</p>
                                        <p class="author">Ullilow</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="testimonialos">
                                        <p>3 These are our Client Testimonials These are our Client Testimonials</p>
                                        <p class="author">Ullilow</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="btns">
                                <a data-index="1" href="#"><i class="fa fa-circle"></i></a>
                                <a data-index="2" href="#"><i class="fa fa-circle"></i></a>
                                <a data-index="3" href="#"><i class="fa fa-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 res-padding-right-align">
                <div class="row res-row">
                    <div class="col-md-12 col-sm-6 margin-top-25 discover-section">
                        <a href="#"><img src="{{ asset('sximo/assets/images/by-collection.png')}}" alt=""/></a>
                        <p class="discover-our-luxury res-text-align-center">BY COLLECTION</p>
                    </div>
                    <div class="col-md-12 col-sm-6 margin-top-25 advertising">
                        <a href="#"><img src="{{ asset('sximo/assets/images/m.png')}}" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid loadmore-btn">
        <div class="col-md-12">
            <a class="loadmore" href="{{url()}}/home">Load More</a>
        </div>
    </div>
</section>
<!--Sections-->
<script>
    
window.onload = $(function(){
    $('.bh-slideshow-thumbnail-split-preview').hide();
    setTimeout(function(){
        $('.bh-slideshow-thumbnail-split-preview').fadeIn('slow');
    },4000);
});
</script>
@include('layouts/elliot/ai_footer_social') 