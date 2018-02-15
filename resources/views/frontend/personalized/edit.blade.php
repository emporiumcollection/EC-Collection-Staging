@extends('frontend.layouts.ev.personalised-service')
@section('title', 'Personalized Service')
@section('css')
<link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/css/ai_persnolizes_responsive.css')}}" />
@stop
@section('content')

<!-- buttons -->
    <div class="col-md-12">
        <div class="col-md-4 hidden-md hidden-lg col-xs-4 col-sm-4">
            <span class="hamburger-menu editorial-res-side-nav-logo hidden-md hidden-lg visible-xs visible-sm" onclick="openNav()"><img src="https://www.emporium-voyage.com/sximo/assets/images/Hamburger-Menu_1.png" alt=""></span>
        </div>
        <div class="col-md-4 col-xs-4 col-sm-4">
            <a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn hidden-md hidden-lg"><i class="fa fa-lock detailfaLock" aria-hidden="true" ></i></a>
        </div>
        <div class="col-md-4 col-xs-4 col-sm-4">
            <a data-popup-id="ev-primary-navigation" href="#" class="video-popup-btn hidden-md hidden-lg"><!--<i class="fa fa-bars hamburgMenu" aria-hidden="true"></i>-->
                <div class="block-content content">
                    <span></span>
                    <span> </span>
                    <span></span>
                </div>
            </a>
        </div>
     </div>
        <!-- buttons -->
        
        <!-- left menu responsive start -->
        
             <!-- content -->
            <div class="col-md-12 hidden-md hidden-lg visible-xs visible-sm">    
                <div id="editorial-siden-nav-res" class="sidenav hidden-md hidden-lg visible-xs visible-sm" style="width: 0px;">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                    <div class=" right-menus ">
                        <div class="row-">
<!--                            <div class="hotels-logo">
                                <h3 class="title"><a href="https://www.emporium-voyage.com">The Dwell Hotel</a><hr class="star-light"></h3>

                            </div>-->
                            <ul>
<!--                                <li>
                                    <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="https://www.emporium-voyage.com/search">
                                        <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input class="bh-search-input typeahead search-navbar search-box tt-hint" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr" type="text"><input class="bh-search-input typeahead search-navbar search-box tt-input" name="s" id="search-navbar" placeholder="Search" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;" type="text"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Geomanist-Regular; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: optimizelegibility; text-transform: uppercase;"></pre><div class="tt-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;"><div class="tt-dataset tt-dataset-states"></div></div></span>
                                    </form>
                                </li>-->

                                                                <li>
                                    <a href="#hotel"> HOTEL MEMBERSHIPS </a>
                                </li>
                                
                                                                <li>
                                    <a href="https://www.emporium-voyage.com/Terms-and-Conditions" data-hotel-option="deisgn_architecture">TERMS AND CONDITIONS</a>
                                </li>
              
                                
                                                                <li>
                                    <a href="https://www.emporium-voyage.com/Impressum" data-hotel-option="restaurant_bar">IMPRINT</a>
                                </li>
                                
                            </ul>
                            <!-- slick space -->
                            <!-- slick space -->
                        </div>
                    </div>
                    <section class="regular slider hidden-md hidden-lg visible-xs visible-sm">
                            <div class="slick-cstm-width">
								<div class="side-bar-why-book-with-us">
									<div class="book-with-us-tittles">
										<h2>Why book with us?</h2>
									</div>
									<ul class="side-bar-book-with-us-list">
																																	<li>
													<h3>Handpicked Selection of Hotels</h3>
													<p>from selected luxury destinations worldwide</p>
												</li>
																							<li>
													<h3>Upgrade and Late Checkout</h3>
													<p>At any Hotel upon Avilability</p>
												</li>
																							<li>
													<h3>Preferred Guest Discounts at New Hotels</h3>
													<p>join our members club</p>
												</li>
																							<li>
													<h3>Free Wifi</h3>
													<p>Guaranteed at all our Partner Hotels</p>
												</li>
																														</ul>
								</div>
							</div>
																					<div class="slick-cstm-width">
								<a href="http://www.bocadolobo.com/en/landing-page/de-market/"><img src="https://www.emporium-voyage.com/uploads/users/advertisement/1.png"></a>
							</div>
														                        </section>
                </div>
                <!-- slick -->
                
                <!-- slick end -->
            </div>
                
                <!-- content -->
        
        <!-- left menu responsive end -->
        
        <!-- booking for bar top -->
            
            
        <!-- booking for bar top -->
        
        
        <div class="wrapper">
            <div class="container-fluid responsiveFluid">
                <div class="row">
   <!--                 <div class="header-logo-image">
                        <img class="img-responsive" src="assets/images/logo-design_1_1.Pampering" alt=""/>
                    </div>
                    <div class="top-progress-bar">
                        <div class="progress-bar-inner"></div>
                    </div>-->
<!--                    <div class="top-nav-align">
                        <ul class="booking-navigation-menues">
                            <li class="active">Holiday Destination</li>
                            <li>Travel Style</li>
                            <li>Details</li>
                            <li>Contact Details</li>
                        </ul>
                    </div>-->
                    <!-- new tabs start -->
                    
                    <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a href="#step-1" type="button" class="btn btn-primary btn-circle holiday-destination">1</a>
                                        <p>Holiday Destination</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-2" type="button" class="btn btn-default btn-circle travel-style" disabled="disabled">2</a>
                                        <p>Travel Style</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-3" type="button" class="btn btn-default btn-circle details" disabled="disabled">3</a>
                                        <p>Details</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-4" type="button" class="btn btn-default btn-circle conatct-details" disabled="disabled">4</a>
                                        <p>Contact Details</p>
                                    </div>
                                </div>
                            </div>
                    
                    <!-- new tabs end -->
             
                        <div class="col-md-12 col-sm-12">
                            <form action="{{URL::to('personalized-service/save')}}" method="POST">
                                <fieldset class="muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">Where do you want to travel?</h2>
                                            <p class="sub-des-heading">You can specify one or more destinations</p>
                                        </div>
                                        <div class="choosen-input-align">
                                            <select name="destinations[]" data-placeholder="Ex: Argentina, South Africa, Cape Town" class="chosen-select-default chosen-select-input-style" multiple tabindex="4">
                                                <?php
                                                if(!empty($destinations)) {
                                                    $_destinations = explode(', ', $row->destinations);
                                                    foreach ($destinations as $destination) {
                                                        echo '<option ', (in_array($destination->id, $_destinations))? 'selected' : '', ' value="'.$destination->id.'">'.$destination->category_name.'</option>'.PHP_EOL;
                                                        if(!empty($destination->sub_destinations)) {
                                                            foreach ($destination->sub_destinations as $sub_destination) {
                                                                echo '<option ', (in_array($sub_destination->id, $_destinations))? 'selected' : '', ' value="'.$sub_destination->id.'">'.$sub_destination->category_name.'</option>'.PHP_EOL;
                                                                if(!empty($sub_destination->sub_destinations)) {
                                                                    foreach ($sub_destination->sub_destinations as $sub_dest) {
                                                                        echo '<option ', (in_array($sub_dest->id, $_destinations))? 'selected' : '', ' value="'.$sub_dest->id.'">'.$sub_dest->category_name.'</option>'.PHP_EOL;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="wrong-selection-pannel">
                                            <p class="sub-des-heading wrong-selected-text">We can not make travel arrangements to "Delhi".</p>
                                        </div>
                                        <div class="suggestions-pannel">
                                            <div class="suggestions-titles-align">
                                                <p class="sub-des-heading suggestions-headin-tittle">The following alternatives could be interesting:</p>
                                            </div>
                                            <ul class="suggestions-pannel-list-align">
                                                <?php
                                                if(!empty($destinations)) {
                                                    foreach ($destinations as $destination) {
                                                        echo '<li><a href="#'.$destination->id.'">'.$destination->category_name.'</a></li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <input type="button" name="next"  data-next-id="travel-style" class="next action-button personalized-btn-deafult progress-bar-btn-increment" value="Continue" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="experience-page-align">
                                        <h2 class="black-heading-big">Inspirations</h2>
                                        <div class="selector-outer-align">
                                            <?php
                                            if(!empty($inspirations)) {
                                                $_inspirations = explode(', ', $row->inspirations);
                                                foreach ($inspirations as $inspiration) {
                                                    ?>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="row">
                                                            <div class="form-group ps-fields-align">
                                                                <label for=""></label>
                                                                <label for="inspiration_{{$inspiration->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$inspiration->category_image)}}');" class="personalized-service-checkbox-label <?php echo (in_array($inspiration->id, $_inspirations))? 'active' : ''; ?>">
                                                                    <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$inspiration->category_name}}
                                                                </label>
                                                                <input id="inspiration_{{$inspiration->id}}" class="personalized-service-checkbox-input" <?php echo (in_array($inspiration->id, $_inspirations))? 'checked' : ''; ?> name="inspirations[]" value="{{$inspiration->id}}" type="checkbox">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <input type="button" name="next"  data-next-id="travel-style" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" data-prev-id ="holiday-destination" holiday-destination class="previous action-button  ps-basic-btn progress-bar-btn-decrement" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="experience-page-align">
                                        <h2 class="black-heading-big">What would you like experience</h2>
                                        <div class="selector-outer-align">
                                            <?php
                                            if(!empty($experiences)) {
                                                $_experiences = explode(', ', $row->experiences);
                                                foreach ($experiences as $experience) {
                                                    ?>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="row">
                                                            <div class="form-group ps-fields-align">
                                                                <label for="experience_{{$experience->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$experience->category_image)}}');" class="personalized-service-checkbox-label <?php echo (in_array($experience->id, $_experiences))? 'active' : ''; ?>">
                                                                    <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$experience->category_name}}
                                                                </label>
                                                                <input id="experience_{{$experience->id}}" class="personalized-service-checkbox-input" <?php echo (in_array($experience->id, $_experiences))? 'checked' : ''; ?> name="experiences[]" value="{{$experience->id}}" type="checkbox">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <input type="button" name="next"  data-next-id="details" class="next action-button personalized-btn-deafult progress-bar-btn-increment" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" data-prev-id="travel-style"  class="previous action-button  ps-basic-btn" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">What is particularly important to you?</h2>
                                            <p class="sub-des-heading">Tell us what you value - the more detailed the better.</p>
                                        </div>
                                        <div class="form-group textarea-left-align">
                                            <textarea class="form-control ps-text-area-style" name="note" placeholder="Further comments or wishes? A concrete trip tour, a special occasion such as A honeymoon or your approximate travel budget."></textarea>
                                        </div> 
                                        <div class="help-hover-icon">
                                            <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Your callback date can be selected in last step"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <input type="button" name="next"  data-next-id="details" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" data-prev-id="travel-style" class="previous action-button  ps-basic-btn progress-bar-btn-decrement" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">How many people travel?</h2>
                                        </div>
                                        <div class="peoples-travel-sec-outer-align col-md-offset-2">
                                            <div class="fileds-main-align">
                                                <div class="col-md-4 col-sm-4">
                                                    <p class="sub-des-heading suggestions-headin-tittle spinner-label">Adults</p>
                                                    <p class="smalldes-label">18* Years</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="ps-adults-handle-counter ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" name="adults" type="text" value="2">
                                                        <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fileds-main-align">
                                                <div class="col-md-4 col-sm-4">
                                                    <p class="sub-des-heading suggestions-headin-tittle spinner-label">Youth</p>
                                                    <p class="smalldes-label">12-17 Years</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="ps-youth-handle-counter ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" name="youth" type="text" value="0">
                                                        <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fileds-main-align">
                                                <div class="col-md-4 col-sm-4">
                                                    <p class="sub-des-heading suggestions-headin-tittle spinner-label">Children</p>
                                                    <p class="smalldes-label">2-11 Years</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="ps-children-handle-counter ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" name="children" type="text" value="0">
                                                        <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fileds-main-align"> 
                                                <div class="col-md-4 col-sm-4">
                                                    <p class="sub-des-heading suggestions-headin-tittle spinner-label">toddlers</p>
                                                    <p class="smalldes-label">under 2 Years</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="ps-toddlers-handle-counter ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" name="toddlers" type="text" value="0">
                                                        <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="next"  data-next-id="details" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" data-prev-id="details" class="previous action-button  ps-basic-btn" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">When would you like to travel?</h2>
                                        </div>
                                        <div class="textarea-left-align">
                                            <div class="get-travel-details">
                                                <div class="form-group">
                                                    <input class="ps-input-style form-control get-earliest-arrival" name="earliest_arrival" type="text" placeholder="Earliest Arrival">
                                                </div>
                                                <div class="form-group">
                                                    <input class="ps-input-style form-control get-checkout-date" name="late_check_out" type="text" placeholder="Late Check Out">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control ps-input-style" name="stay_time">
                                                    <option value="1-2 Weeks">1-2 Weeks</option>
                                                    <option value="2-3 Weeks">2-3 Weeks</option>
                                                    <option value="3-4 Weeks">3-4 Weeks</option>
                                                    <option value="4-5 Weeks">4-5 Weeks</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="help-hover-icon">
                                            <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <input type="button" name="next" data-next-id="conatct-details" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" data-prev-id="details" class="previous action-button  ps-basic-btn" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">Contact Details</h2>
                                            <p class="sub-des-heading margin-bottom-30">Please complete the following information.</p>
                                        </div>
                                        <div class="form-group text-left">
                                            <input class="radio-btn" type="radio" name="salutation" value="Sir">
                                            <label class="radio-inline radio-btn-label">Sir</label>
                                            <input class="radio-btn" type="radio" name="salutation" value="Mrs">
                                            <label class="radio-inline radio-btn-label">Mrs</label>
                                        </div>
                                        <div class="form-group">
                                            <input class="ps-input-style form-control" type="text" name="first_name" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <input class="ps-input-style form-control" type="text" name="surname" placeholder="Surname">
                                        </div>
                                        <div class="form-group">
                                            <input class="ps-input-style form-control" type="text" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <button type="submit" class="next action-button personalized-btn-deafult">Submit</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop
        @section('script')


        <script src=" {{ asset('sximo/assets/js/chosen.jquery.js') }} " type="text/javascript"></script>
        <script src=" {{ asset('sximo/assets/js/init.js') }} " type="text/javascript"></script>
        <script src=" {{ asset('sximo/assets/js/handleCounter.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                // Multi Tab Form
                var current_fs, next_fs, previous_fs;
                var left, opacity, scale;
                var animating;

                $(".next").click(function () {
                    if (animating)
                        return false;
                    animating = true;

                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();

                    $(".ps-progressbar li").eq($(".muti-form-align").index(next_fs)).addClass("active");

                    next_fs.show();
                    current_fs.animate({opacity: 0}, {
                        step: function (now, mx) {
                            scale = 1 - (1 - now) * 0.2;
                            left = (now * 50) + "%";
                            opacity = 1 - now;
                            current_fs.css({
                                'transform': 'scale(' + scale + ')',
                            });
                            next_fs.css({'left': left, 'opacity': opacity});
                        },
                        duration: 800,
                        complete: function () {
                            current_fs.hide();
                            animating = false;
                        },
                        easing: 'easeInOutBack'
                    });
                });

                $(".previous").click(function () {
                    if (animating)
                        return false;
                    animating = true;

                    current_fs = $(this).parent();
                    previous_fs = $(this).parent().prev();
                    $(".ps-progressbar li").eq($(".muti-form-align").index(current_fs)).removeClass("active");
                    previous_fs.show();
                    current_fs.animate({opacity: 0}, {
                        step: function (now, mx) {
                            scale = 0.8 + (1 - now) * 0.2;
                            left = ((1 - now) * 50) + "%";
                            opacity = 1 - now;
                            current_fs.css({'left': left});
                            previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
                        },
                        duration: 800,
                        complete: function () {
                            current_fs.hide();
                            animating = false;
                        },
                        easing: 'easeInOutBack'
                    });
                });

                $(".submit").click(function () {
                    return false;
                })
                
                $('.personalized-service-checkbox-label').click(function (e) {
                    $(this).toggleClass('active').siblings().removeClass('active');
                });
                // Tooltip
                $('[data-toggle="tooltip"]').tooltip();
                //Input Spinner
                var options = {
                    minimum: 1,
                    maximize: 10,
                    onMinimum: function (e) {
                        console.log('reached minimum: ' + e);
                    },
                    onMaximize: function (e) {
                        console.log('reached maximize' + e);
                    }
                };
                
                $('.ps-adults-handle-counter').handleCounter({minimum:1, maximize: 100});
                $('.ps-youth-handle-counter').handleCounter({minimum:0, maximize: 100});
                $('.ps-children-handle-counter').handleCounter({minimum:0, maximize: 100});
                $('.ps-toddlers-handle-counter').handleCounter({minimum:0, maximize: 100});
                
                //Progress Bar
                var clicks = 1;
                $('.progress-bar-btn-increment').on('click', function () {
                    clicks++;
                    var percent = Math.min(Math.round(clicks / 3 * 100), 100);
                    percent = 25 * clicks;
                    $('.progress-bar-inner').width(percent + '%');
                });
                $('.progress-bar-btn-decrement').on('click', function () {
                    clicks--;
                    var percent = Math.min(Math.round(clicks / 3 * 100), 100);
                    percent = 25 * clicks;
                    $('.progress-bar-inner').width(percent + '%');
                });
                //Date Range Picker
                $(".get-travel-details").dateRangePicker({
                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "12-01-2017",
                        format: ' DD.MM.YYYY',
                        separator: ' to ',
                        getValue: function () {
                            if ($('.get-earliest-arrival').val() && $('.get-checkout-date').val())
                                return $('.get-earliest-arrival').val() + ' to ' + $('.get-checkout-date').val();
                            else
                                return '';
                        },
                        setValue: function (s, s1, s2) {
                            $('.get-earliest-arrival').val(s1);
                            $('.get-checkout-date').val(s2);
                        }
                    }
                ).bind('datepicker-first-date-selected', function (event, obj) {
                    $(".get-checkout-date").val('');
                });
                
                /* steps */
                $(".next").click(function(){
                    $('.stepwizard-step').find('a').attr("disabled","disabled");
                    var next_value = $(this).data('next-id');
                    $('.'+next_value).removeAttr('disabled');
                 });
                $(".previous").click(function(){
                    $('.stepwizard-step').find('a').attr("disabled","disabled");
                    var pre_value = $(this).data('prev-id');
                    $('.'+pre_value).removeAttr('disabled');
                 });
                 /* steps */
            });
        </script>
        
        <!-- toggle responsive top bar-->
                <script>
                    $(".TopbarSearch").click(function(){
                        $(".ResponsiveTopbar").toggle();    
                    });
                </script>
        <!-- toggle responsive top bar end-->
        
        
        <!-- responsive left menu toggle -->

        <script>
         function openNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "0";
            }
        </script>
        
        <!-- responsive left menu toggle end -->
            
@stop