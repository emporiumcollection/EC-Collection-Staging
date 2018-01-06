@include('layouts/elliot/ai_header')
@include('layouts/elliot/ai_navigation_bar_style_2')

<link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/stick-nav-arrows.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/detail-page.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/products.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/rating.css')}}" rel="stylesheet" type="text/css"/>


<script src="{{ asset('sximo/assets/js/animate.js')}}" type="text/javascript"></script>
<script src="{{ asset('sximo/assets/js/rating.js')}}" type="text/javascript"></script>

@include('layouts/elliot/next_previous_arrow')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="section-padding">
            <div class="post-title">
                <h1><span>Design Locations</span></h1>
            </div>
            <div>
                <div class="post-content" data-aos="fade-right">
                    <div  class="products-slideshow-image">
                        <a data-popup-id="gallery-popup"  class="video-popup-btn" href="#">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                            <div class="silde-show-btn" data-aos="zoom-in">
                                See Slideshow
                            </div>
                        </a>
                    </div>
                    <div class="post-sub-titles">
                        <h2 class="products-main-sub-title">The pinnacle of lofty living</h2>
                        <h2 class="sub-tittle-des">Canal House Loft Amsterdam - <span>Interior &  Kitchen</span></h2>
                    </div>
                </div>
                <div class="products-double-image-sec">
                    <div class="left-image"  >
                        <img data-aos="fade-right" class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                    </div>
                    <div class="right-image"  >
                        <img data-aos="fade-right" class="img-responsive" src="{{ asset('sximo/assets/images/L1006427-Edit-21-1800x0-c-default.jpg')}}" alt=""/>
                        <p>We gave this sideboard a herring bone motif from oak wood.</p>
                        <div class="product-tittle">Classic Chair</div>
                        <div>
                            <ul class="below-tittle-des-and-rating">
                                <li>$320</li>
                                <li>3 Customer Reviews</li>
                                <li><div id="star-rating">
                                        <input type="radio" name="example" class="rating" value="1" />
                                        <input type="radio" name="example" class="rating" value="2" />
                                        <input type="radio" name="example" class="rating" value="3" />
                                        <input type="radio" name="example" class="rating" value="4" />
                                        <input type="radio" name="example" class="rating" value="5" />
                                    </div></li>
                            </ul>   
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-image-product-des">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                            It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially</div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="products-double-des-sec">
                    <div class="left-side"  >
                        <div class="products-tabs">
                            <!--Tabs start-->
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all-cats">Description</a></li>
                                <li><a data-toggle="tab" href="#design-tab">Additional Information</a></li>
                                <li><a data-toggle="tab" href="#dream-escapes-tab">Reviews</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="all-cats" class="tab-pane fade in active">
                                    <div class="tabs-des-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially
                                    </div>
                                </div>
                                <div id="design-tab" class="tab-pane fade">
                                    <div class="tabs-des-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially
                                    </div>
                                </div>
                                <div id="dream-escapes-tab" class="tab-pane fade">
                                    <div class="tabs-des-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially
                                    </div>
                                </div>
                            </div>
                            <!--Tabs end-->
                        </div>
                    </div>
                    <div class="right-side"  >
                        <div class="form">
                            <div class="form-group">
                                <div class="basic-products-options">
                                    <label>Color</label>
                                    <select class="">
                                        <option>Black</option>
                                        <option>Black</option>
                                        <option>Black</option>
                                        <option>Black</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <select class="product-quantity">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                    <input type="submit" value="Add To Bag" class="add-to-bag-button" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-border-bottom"></div>
                <div class="clearfix"></div>
                <!--Related Products Section-->
                <div class="related-products-sec">
                    <div class="related-products-heading">
                        <h3>Related Products</h3>
                    </div>
                    <div class="categories-align">
                        <ul>
                            <li>Categories: <span>Essentials</span></li>
                            <li>Tags: <span>Essentials, Kitchens</span></li>
                        </ul>
                    </div>
                </div>
                <div class="related-products-align">
                    <div class="row">
                        <div class="col-md-3 thumb-4">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product.png')}}" alt=""/>
                            <div class="hover-product-name">HOVER PRODUCT NAME</div>
                            <div class="product-name">Classic Chair</div>
                            <div class="related-product-price">$479,99</div>
                        </div>
                        <div class="col-md-3 thumb-4">
                            <img  class="img-responsive" src="{{ asset('sximo/assets/images/product.png')}}" alt=""/>
                            <div class="hover-product-name">HOVER PRODUCT NAME</div>
                            <div class="product-name">Classic Chair</div>
                            <div class="related-product-price">$479,99</div>
                        </div>
                        <div class="col-md-3 thumb-4">
                            <img  class="img-responsive" src="{{ asset('sximo/assets/images/product.png')}}" alt=""/>
                            <div class="hover-product-name">HOVER PRODUCT NAME</div>
                            <div class="product-name">Classic Chair</div>
                            <div class="related-product-price">$479,99</div>
                        </div>
                        <div class="col-md-3 thumb-4">
                            <img  class="img-responsive" src="{{ asset('sximo/assets/images/product.png')}}" alt=""/>
                            <div class="hover-product-name">HOVER PRODUCT NAME</div>
                            <div class="product-name">Classic Chair</div>
                            <div class="related-product-price">$479,99</div>
                        </div>
                    </div>
                </div> 
                <div class="clearfix"></div>
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
         <script>
            $(function () {                   // Start when document ready
                $('#star-rating').rating(); // Call the rating plugin
            });
        </script>
         @include('layouts/elliot/ai_footer_social')
        <!--@include('layouts/elliot/ai_footer_3')
        @include('layouts/elliot/ai_footer_2')-->)
        