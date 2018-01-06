@include('layouts/elliot/ai_header_content')
<!--Sections-->
<section id="destination" class="sections-one content-grid-shuffle">
    <div class="articles-sections-container shop-page-width-align content-grid-shuffle-page">
        <!--HTML Slider Start Here-->
        <div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: 'slice-up', autoplay: false}">
            <?php
            if (!empty($featured_articles)) {
                echo '<ul style="height: 650px;" class="uk-slideshow uk-overlay-active ">';
                foreach ($featured_articles as $featured_article) {
                    ?>
                    <li style="height: 650px;" class="uk-active  video-silder-outer-align" aria-hidden="true">
                        <div style="background-image: url({{ URL::to('uploads/article_imgs/'.$featured_article->featured_slider_image)}});" class="uk-cover-background uk-position-cover"></div>
                        <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
                        <div class="bh-slideshow-thumbnail-split-preview ai-uk-animation uk-animation-fade  uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                            <div>
                                <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                                    <li>
                                        <span>{{date('M d, Y', strtotime($featured_article->updated))}}</span>
                                    </li>
                                    <!--                                        <li>
                                                                                <span><a href="javascript:void(0);" rel="category tag">{{$featured_article->title_pos_1}}</a></span>
                                                                            </li>-->
                                </ul>
                                <h3 class="bh-slideshow-thumbnail-split-preview-title">
                                    <a href="javascript:void(0);">{{$featured_article->title_pos_1}}</a>
                                </h3>
                                <div class="bh-slideshow-thumbnail-split-preview-content"><?php echo html_entity_decode($featured_article->description_pos_1); ?></div>
                                <a class="uk-margin-top uk-button uk-button-primary" href="javascript:void(0);">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                            </div>
                            <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                            <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                        </div>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            ?>
        </div>
        <!--HTML Slider End Here-->

        <div class="article-grid">
            <div class="container">
                <div class="row">
                    <div class="header-navigation-container col-md-12">
                        <div class="row">
                            <div class="col-md-0"></div>
                            <div class="col-md-3 col-sm-2 header-text-align"></div>
                            <div class="col-md-7 col-sm-8">
                                <div class="header-navigation-menu">
                                    <nav class="navbar navbar-inverse">
                                        <div class="container-fluid">
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                            </div>
                                            <div class="collapse navbar-collapse" id="myNavbar">
                                                <ul class="nav navbar-nav">
                                                    <?php
                                                    $grid_menus = SiteHelpers::menus('content');
                                                    if (!empty($grid_menus)) {
                                                        foreach ($grid_menus as $gmenu) {
                                                            ?>
                                                            <li class="active">
                                                                <a href="<?php echo ($gmenu['menu_type'] == 'external') ? URL::to($gmenu['url']) : URL::to($gmenu['module']); ?>" >
                                                                    <?php
                                                                    if (CNF_MULTILANG == 1 && isset($gmenu['menu_lang']['title'][Session::get('lang')])) {
                                                                        echo $gmenu['menu_lang']['title'][Session::get('lang')];
                                                                    } else {
                                                                        echo $gmenu['menu_name'];
                                                                    }
                                                                    ?>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-grid-boxes-outer">
                <?php if (!empty($editors_choice_article)): ?>
                    <div class="col-md-8 col-sm-7 thumb-1 content-box-thumb-1 products-overlay-pannel-main">
                        <a href="<?php echo URL::to('article').'/'.$editors_choice_article->id; ?>">
                            <div class="outer-overlay-hidden">
                                <div class="shop-overlay-outer">
                                    <img alt="" class="featured-property-icon" src="{{URL::to('sximo/images/editors-choice.png')}}">
                                    <div class="overlay-text">
                                        <div class="overlay-text-inner">
                                            <h2 class="shop-overlay-tittle">{{$editors_choice_article->title_pos_1}}</h2>
                                        </div>
                                    </div>
                                    <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$editors_choice_article->featured_image}}" alt=""/>
                                </div>
                            </div>
                        </a>
                        <div class="shop-products-des-pannel">
                            <div class="shop-below-tittle">
                                <a href="<?php echo URL::to('article').'/'.$editors_choice_article->id; ?>" class="main-shop-product-name">{{$editors_choice_article->title_pos_1}}</a>
                            </div>
                            <div class="shop-right-icons">
                                <ul class="shop-icons-list-align">
                                    <li><a href="<?php echo URL::to('article').'/'.$editors_choice_article->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo URL::to('article').'/'.$editors_choice_article->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-view-btn">
                                <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$editors_choice_article->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="latest-hotel-slider col-md-4 col-sm-5 products-overlay-pannel-main">
                    <?php
                    if (!empty($new_hotels)) {
                        foreach ($new_hotels as $new_hotel) {
                            ?>
                            <div>
                                <a href="{{URL::to($new_hotel->property_slug)}}">
                                    <div class="outer-overlay-hidden">
                                        <div class="shop-overlay-outer">
                                            <div class="overlay-text">
                                                <div class="overlay-text-inner">
                                                    <h2 class="shop-overlay-tittle">{{$new_hotel->property_name}}</h2>
                                                    <p class="shop-overlay-price"><span>From ${{$new_hotel->price}} </span>|<span> {{$new_hotel->city}}</span></p>
                                                </div>
                                            </div>
                                            <img class="img-responsive thumb-image" src="{{ asset('sximo/assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden-design-locati.jpg')}}" alt=""/>
                                        </div>
                                    </div>
                                </a>
                                <div class="shop-products-des-pannel">
                                    <div class="shop-below-tittle">
                                        <a href="{{URL::to($new_hotel->property_slug)}}" class="main-shop-product-name">{{$new_hotel->property_short_name}}</a>
                                    </div>
                                    <div class="shop-right-icons">
                                        <ul class="shop-icons-list-align">
                                            <li><a href="{{URL::to($new_hotel->property_slug)}}"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                            <li><a href="{{URL::to($new_hotel->property_slug)}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="shop-view-btn">
                                        <a class="quick-vew-btn" href="{{URL::to($new_hotel->property_slug)}}">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="clearfix"></div>
                <div class="margin-top-50"></div>
                <?php
                $index = 0;
                if (isset($articles[$index])):
                ?>
                <div class="col-md-8 col-sm-8 custom-tabs design-tabs-section products-overlay-pannel-main">
                    <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">
                        <div class="outer-overlay-hidden">
                            <div class="shop-overlay-outer">
                                <div class="overlay-text">
                                    <div class="overlay-text-inner">
                                        <h2 class="shop-overlay-tittle">{{$articles[$index]->title_pos_1}}</h2>
                                    </div>
                                </div>
                                <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$articles[$index]->featured_image}}" alt=""/>
                            </div>
                        </div>
                    </a>
                    <div class="shop-products-des-pannel">
                        <div class="shop-below-tittle">
                            <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>" class="main-shop-product-name">{{$articles[$index]->title_pos_1}}</a>
                        </div>
                        <div class="shop-right-icons">
                            <ul class="shop-icons-list-align">
                                <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="shop-view-btn">
                            <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php
                $index = 1;
                if (isset($articles[$index])):
                    ?>
                    <div class="col-md-4 thumb-4 col-sm-4 products-overlay-pannel-main">
                        <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">
                            <div class="outer-overlay-hidden">
                                <div class="shop-overlay-outer">
                                    <div class="overlay-text">
                                        <div class="overlay-text-inner">
                                            <h2 class="shop-overlay-tittle">{{$articles[$index]->title_pos_1}}</h2>
                                        </div>
                                    </div>
                                    <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$articles[$index]->featured_image}}" alt=""/>
                                </div>
                            </div>
                        </a>
                        <div class="shop-products-des-pannel">
                            <div class="shop-below-tittle">
                                <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>" class="main-shop-product-name">{{$articles[$index]->title_pos_1}}</a>
                            </div>
                            <div class="shop-right-icons">
                                <ul class="shop-icons-list-align">
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-view-btn">
                                <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <div class="margin-top-50"></div>
                <?php
                $index = 2;
                if (isset($articles[$index])):
                    ?>
                    <div class="col-md-4 col-sm-4 thumb-5 products-overlay-pannel-main">
                        <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">
                            <div class="outer-overlay-hidden">
                                <div class="shop-overlay-outer">
                                    <div class="overlay-text">
                                        <div class="overlay-text-inner">
                                            <h2 class="shop-overlay-tittle">{{$articles[$index]->title_pos_1}}</h2>
                                        </div>
                                    </div>
                                    <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$articles[$index]->featured_image}}" alt=""/>
                                </div>
                            </div>
                        </a>
                        <div class="shop-products-des-pannel">
                            <div class="shop-below-tittle">
                                <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>" class="main-shop-product-name">{{$articles[$index]->title_pos_1}}</a>
                            </div>
                            <div class="shop-right-icons">
                                <ul class="shop-icons-list-align">
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-view-btn">
                                <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                $index = 3;
                if (isset($articles[$index])):
                    ?>
                    <div class="col-md-8 col-sm-8 thumb-6 products-overlay-pannel-main">
                        <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">
                            <div class="outer-overlay-hidden">
                                <div class="shop-overlay-outer">
                                    <div class="overlay-text">
                                        <div class="overlay-text-inner">
                                            <h2 class="shop-overlay-tittle">{{$articles[$index]->title_pos_1}}</h2>
                                        </div>
                                    </div>
                                    <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$articles[$index]->featured_image}}" alt=""/>
                                </div>
                            </div>
                        </a>
                        <div class="shop-products-des-pannel">
                            <div class="shop-below-tittle">
                                <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>" class="main-shop-product-name">{{$articles[$index]->title_pos_1}}</a>
                            </div>
                            <div class="shop-right-icons">
                                <ul class="shop-icons-list-align">
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-view-btn">
                                <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <div class="margin-top-50"></div>
                <?php
                $index = 4;
                if (isset($articles[$index])):
                    ?>
                    <div class="col-md-6 col-sm-6 thumb-7 products-overlay-pannel-main">
                        <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">
                            <div class="outer-overlay-hidden">
                                <div class="shop-overlay-outer">
                                    <div class="overlay-text">
                                        <div class="overlay-text-inner">
                                            <h2 class="shop-overlay-tittle">{{$articles[$index]->title_pos_1}}</h2>
                                        </div>
                                    </div>
                                    <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$articles[$index]->featured_image}}" alt=""/>
                                </div>
                            </div>
                        </a>
                        <div class="shop-products-des-pannel">
                            <div class="shop-below-tittle">
                                <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>" class="main-shop-product-name">{{$articles[$index]->title_pos_1}}</a>
                            </div>
                            <div class="shop-right-icons">
                                <ul class="shop-icons-list-align">
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-view-btn">
                                <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                $index = 5;
                if (isset($articles[$index])):
                    ?>
                    <div class="col-md-6 col-sm-6 thumb-8 products-overlay-pannel-main">
                        <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">
                            <div class="outer-overlay-hidden">
                                <div class="shop-overlay-outer">
                                    <div class="overlay-text">
                                        <div class="overlay-text-inner">
                                            <h2 class="shop-overlay-tittle">{{$articles[$index]->title_pos_1}}</h2>
                                        </div>
                                    </div>
                                    <img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/{{$articles[$index]->featured_image}}" alt=""/>
                                </div>
                            </div>
                        </a>
                        <div class="shop-products-des-pannel">
                            <div class="shop-below-tittle">
                                <a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>" class="main-shop-product-name">{{$articles[$index]->title_pos_1}}</a>
                            </div>
                            <div class="shop-right-icons">
                                <ul class="shop-icons-list-align">
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-view-btn">
                                <a class="quick-vew-btn" href="<?php echo URL::to('article').'/'.$articles[$index]->id; ?>">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="clearfix"></div>
    </div>
    <div class="shop-page-sidebar-width">
        <div class="shop-page-fixed-sidebar">
            <div class="filters-gird-page-side-bar-filter-align">
                <div class="design-locations-logo">
                    <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>
                </div>
                <div class="design-locations-logo filters-page-serch-bar-align shop-page-sidebar-outer">
                    <input class="af-search-input bh-search-input typeahead" placeholder="SEARCH" type="text">
                </div>
                <div class="panel-group" id="accordion">
                    <!--Categories-->
                    <div class="panel panel-default custom-post-panel">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                            <div class="panel-heading custom-heading">CATEGORIES</div>
                        </a>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body custom-panel-body">
                                <div class="dl-filter">
                                    <form>
                                        <?php
                                        if (!empty($categories)) {
                                            foreach ($categories as $category) {
                                                echo '<div class="form-group post-filter-inputs ">
                                                        <label><a onclick="javascript:af_category(' . $category->cat_id . ');" href="javascript:void(0);">' . $category->cat_name . '</a></label>
                                                    </div>';
                                            }
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Categories End Here-->
                </div>
                <section class="regular slider">
                    <div class="slick-cstm-width">
                        <div class="side-bar-why-book-with-us">
                            <div class="book-with-us-tittles">
                                <h2>Why book with us?</h2>
                            </div>
                            <ul class="side-bar-book-with-us-list">
                                <li>
                                    <h3>Handpicked Selection of Hotels.</h3>
                                    <p>Over 200 destination at the best rate</p>
                                </li>
                                <li>
                                    <h3>Upgrade & Late Check-out</h3>
                                    <p>At any hotel, upon Availability</p>
                                </li>
                                <li>
                                    <h3>Upto 50% off at New Hotels</h3>
                                    <p>Exclusive community invitations</p>
                                </li>
                                <li>
                                    <h3>Free WiFi</h3>
                                    <p>Guaranteed at all Hotels</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(!empty($sidebargridAds))
                    @foreach($sidebargridAds as $slides)
                    <div class="slick-cstm-width">
                        <a href="http://{{$slides->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$slides->adv_img)}}"></a>
                    </div>
                    @endforeach
                    @endif
                </section>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
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
<!--Ajax Filter Data-->
<input class="af_search" type="hidden" value="" />
<input class="af_category" type="hidden" value="0" />
<input class="af_is_filter_running" type="hidden" value="0" />
<input class="af_start" type="hidden" value="<?php echo $articles_limit; ?>" />
<input class="af_editors_choice_start" type="hidden" value="<?php echo $editors_choice_limit; ?>" />
<!--End Here-->
<!--New Login Pop Up End Here-->
<script>
    $(document).ready(function ($) {
        $(".latest-hotel-slider").slick({
            dots: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: true,
            nextArrow: true, autoplay: true,
            autoplaySpeed: 3000
        });
        
        var suggestions = [{!! TagsFinder::article_suggestions() !!}];
        $('.af-search-input.typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: substringMatcher(suggestions)
        });
    
        $('.af-search-input').on('typeahead:selected', function (e, datum) {
            var propname = $(this);
            $.ajax({
                url: "{{URL::to('get-article-by-title')}}",
                type: "post",
                data: 'title=' + propname.val(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 'error') {
                        $(".af_search").val( +propname.val() );
                        $(".af_start").val('0');
                        $(".af_editors_choice_start").val('0');
                        af_load_more_articles(true);
                        return;
                    } else {
                        window.location.href = "{{URL::to('article')}}/" + data.article.id;
                    }
                }
            });
            
        });

        $('.af-search-input').keyup(function (event) {
            var key = event.which;
            if (key == 13) {
                $(".af_search").val($(this).val());
                $(".af_start").val('0');
                $(".af_editors_choice_start").val('0');
                af_load_more_articles(true);
                event.preventDefault();
            }
        });
    
        setInterval(function () {
            af_load_more_articles(false);
        }, 3000);
    
    });
    
    function af_category(category_id) {
        $(".af_category").val(category_id);
        $(".af_start").val('0');
        $(".af_editors_choice_start").val('0');
        af_load_more_articles(true);
    }

    function af_load_more_articles(erase_grid) {

        var af_search = $(".af_search").val();
        var af_category = $(".af_category").val();
        var af_is_filter_running = $(".af_is_filter_running").val();
        var af_start = $(".af_start").val();
        var af_editors_choice_start = $(".af_editors_choice_start").val();
        if (af_is_filter_running == '0') {
            $(".af_is_filter_running").val('1');
            $.ajax({
                url: "{{URL::to('ajax-content-grid-shuffle')}}",
                type: "POST", data: "af_search=" + af_search + "&af_category=" + af_category + "&af_start=" + af_start + "&af_editors_choice_start=" + af_editors_choice_start,
                success: function (data, textStatus, jqXHR) {
                    data = jQuery.parseJSON(data);
                    $(".af_is_filter_running").val('0');
                    $(".af_start").val( + $(".af_start").val() + <?php echo $articles_limit; ?>);
                    $(".af_editors_choice_start").val( + $(".af_editors_choice_start").val() + <?php echo $editors_choice_limit; ?>);

                    var gridHtml = '';
                    if (data.articles.length == 0 && erase_grid == true) {
                        gridHtml += '<p>No record found.</p>';
                    }
                    else if (data.articles.length > 0) {
                        var index = 0;

                        gridHtml += '<div class="content-grid-boxes-outer">';
                            if (data.editors_choice_article[0] && data.editors_choice_article[0] != 'undefined') {
                                gridHtml += '<div class="col-md-8 col-sm-7 thumb-1 content-box-thumb-1 products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.editors_choice_article[0].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<img alt="" class="featured-property-icon" src="<?php echo URL::to('sximo/images/editors-choice.png');  ?>">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.editors_choice_article[0].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs').'/'; ?>' + data.editors_choice_article[0].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.editors_choice_article[0].id + '" class="main-shop-product-name">' + data.editors_choice_article[0].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.editors_choice_article[0].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.editors_choice_article[0].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.editors_choice_article[0].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                            gridHtml += '<div class="ajax-latest-hotel-slider col-md-4 col-sm-5 products-overlay-pannel-main">';

                            if (data.new_hotels.length > 0) {
                                for(var sld = 0; sld < data.new_hotels.length; sld++) {
                                    gridHtml += '<div>';
                                        gridHtml += '<a href="{{URL::to(' + data.new_hotels[sld].property_slug + ')}}">';
                                            gridHtml += '<div class="outer-overlay-hidden">';
                                                gridHtml += '<div class="shop-overlay-outer">';
                                                    gridHtml += '<div class="overlay-text">';
                                                        gridHtml += '<div class="overlay-text-inner">';
                                                            gridHtml += '<h2 class="shop-overlay-tittle">' + data.new_hotels[sld].property_name + '</h2>';
                                                            gridHtml += '<p class="shop-overlay-price"><span>From $' + data.new_hotels[sld].price + ' </span>|<span> ' + data.new_hotels[sld].city + '</span></p>';
                                                        gridHtml += '</div>';
                                                    gridHtml += '</div>';
                                                    gridHtml += '<img class="img-responsive thumb-image" src="{{ asset('sximo/assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden-design-locati.jpg')}}" alt=""/>';
                                                gridHtml += '</div>';
                                            gridHtml += '</div>';
                                        gridHtml += '</a>';
                                        gridHtml += '<div class="shop-products-des-pannel">';
                                            gridHtml += '<div class="shop-below-tittle">';
                                                gridHtml += '<a href="{{URL::to(' + data.new_hotels[sld].property_slug + ')}}" class="main-shop-product-name">' + data.new_hotels[sld].property_short_name + '</a>';
                                            gridHtml += '</div>';
                                            gridHtml += '<div class="shop-right-icons">';
                                                gridHtml += '<ul class="shop-icons-list-align">';
                                                    gridHtml += '<li><a href="{{URL::to(' + data.new_hotels[sld].property_slug + ')}}"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                    gridHtml += '<li><a href="{{URL::to(' + data.new_hotels[sld].property_slug + ')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                                gridHtml += '</ul>';
                                            gridHtml += '</div>';
                                            gridHtml += '<div class="shop-view-btn">';
                                                gridHtml += '<a class="quick-vew-btn" href="{{URL::to(' + data.new_hotels[sld].property_slug + ')}}">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                }
                            }

                            gridHtml += '</div>';
                            gridHtml += '<script>';
                            gridHtml += '$(".ajax-latest-hotel-slider").slick({';
                                gridHtml += 'dots: false,';
                                gridHtml += 'infinite: true,';
                                gridHtml += 'slidesToShow: 1,';
                                gridHtml += 'slidesToScroll: 1,';
                                gridHtml += 'prevArrow: true,';
                                gridHtml += 'nextArrow: true, autoplay: true,';
                            gridHtml += 'autoplaySpeed: 3000';
                            gridHtml += '});';
                            gridHtml += '<\/script>';
                            gridHtml += '<div class="clearfix"></div>';
                            gridHtml += '<div class="margin-top-50"></div>';

                            if (data.articles[index] && data.articles[index] != 'undefined') {
                                gridHtml += '<div class="col-md-8 col-sm-8 custom-tabs design-tabs-section products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.articles[index].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/' + data.articles[index].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '" class="main-shop-product-name">' + data.articles[index].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                            
                            index = 1;
                            if (data.articles[index] && data.articles[index] != 'undefined') {
                                gridHtml += '<div class="col-md-4 thumb-4 col-sm-4 products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.articles[index].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/' + data.articles[index].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '" class="main-shop-product-name">' + data.articles[index].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                            gridHtml += '<div class="clearfix"></div>';
                            gridHtml += '<div class="margin-top-50"></div>';

                            index = 2;
                            if (data.articles[index] && data.articles[index] != 'undefined') {
                                gridHtml += '<div class="col-md-4 col-sm-4 thumb-5 products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.articles[index].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/' + data.articles[index].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '" class="main-shop-product-name">' + data.articles[index].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                            index = 3;
                            if (data.articles[index] && data.articles[index] != 'undefined') {
                                gridHtml += '<div class="col-md-8 col-sm-8 thumb-6 products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.articles[index].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/' + data.articles[index].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '" class="main-shop-product-name">' + data.articles[index].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                            gridHtml += '<div class="clearfix"></div>';
                            gridHtml += '<div class="margin-top-50"></div>';
                            index = 4;
                            if (data.articles[index] && data.articles[index] != 'undefined') {
                                gridHtml += '<div class="col-md-6 col-sm-6 thumb-7 products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.articles[index].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/' + data.articles[index].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '" class="main-shop-product-name">' + data.articles[index].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                            index = 5;
                            if (data.articles[index] && data.articles[index] != 'undefined') {
                                gridHtml += '<div class="col-md-6 col-sm-6 thumb-8 products-overlay-pannel-main">';
                                    gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">';
                                        gridHtml += '<div class="outer-overlay-hidden">';
                                            gridHtml += '<div class="shop-overlay-outer">';
                                                gridHtml += '<div class="overlay-text">';
                                                    gridHtml += '<div class="overlay-text-inner">';
                                                        gridHtml += '<h2 class="shop-overlay-tittle">' + data.articles[index].title_pos_1 + '</h2>';
                                                    gridHtml += '</div>';
                                                gridHtml += '</div>';
                                                gridHtml += '<img class="img-responsive thumb-image" src="<?php echo asset('uploads/article_imgs'); ?>/' + data.articles[index].featured_image + '" alt=""/>';
                                            gridHtml += '</div>';
                                        gridHtml += '</div>';
                                    gridHtml += '</a>';
                                    gridHtml += '<div class="shop-products-des-pannel">';
                                        gridHtml += '<div class="shop-below-tittle">';
                                            gridHtml += '<a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '" class="main-shop-product-name">' + data.articles[index].title_pos_1 + '</a>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-right-icons">';
                                            gridHtml += '<ul class="shop-icons-list-align">';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>';
                                                gridHtml += '<li><a href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>';
                                            gridHtml += '</ul>';
                                        gridHtml += '</div>';
                                        gridHtml += '<div class="shop-view-btn">';
                                            gridHtml += '<a class="quick-vew-btn" href="<?php echo URL::to('article').'/'; ?>' + data.articles[index].id + '">Quick View<span><i class="fa fa-caret-right" aria-hidden="true"></i></span></a>';
                                        gridHtml += '</div>';
                                    gridHtml += '</div>';
                                gridHtml += '</div>';
                            }
                        gridHtml += '</div>';
                    }

                    if (erase_grid) {
                        $(".articles-sections-container .article-grid").html(gridHtml);
                    }
                    else {
                        $(".articles-sections-container .article-grid").append(gridHtml);
                    }
                }
            });
    }
    }
</script>
<!--Sections-->
@include('layouts/elliot/ai_footer_social')