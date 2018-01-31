@extends('frontend.layouts.ev.index')
@section('title', 'Personalized Service')
@section('css')
<link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="header-logo-image">
                        <img class="img-responsive" src="assets/images/logo-design_1_1.Pampering" alt=""/>
                    </div>
                    <div class="top-progress-bar">
                        <div class="progress-bar-inner"></div>
                    </div>
                    <div class="top-nav-align">
                        <ul class="booking-navigation-menues">
                            <li class="active">Holiday Destination</li>
                            <li>Travel Style</li>
                            <li>Details</li>
                            <li>Contact Details</li>
                        </ul>
                    </div>
             
                        <div class="col-md-8 col-sm-8">
                            <form>
                                <fieldset class="muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">Where do you want to travel?</h2>
                                            <p class="sub-des-heading">You can specify one or more destinations</p>
                                        </div>
                                        <div class="choosen-input-align">
                                            <select data-placeholder="Ex: Argentina, South Africa, Cape Town" class="chosen-select chosen-select-input-style" multiple tabindex="4">
                                                <?php
                                                if(!empty($destinations)) {
                                                    foreach ($destinations as $destination) {
                                                        echo '<option value="'.$destination->id.'">'.$destination->category_name.'</option>'.PHP_EOL;
                                                        if(!empty($destinations->sub_destinations)) {
                                                            foreach ($destinations->sub_destinations as $destination) {
                                                                echo '<option value="'.$destination->id.'">--&gt;'.$destination->category_name.'</option>'.PHP_EOL;
                                                                if(!empty($destinations->sub_destinations)) {
                                                                    foreach ($destinations->sub_destinations as $destination) {
                                                                        echo '<option value="'.$destination->id.'">--&gt;--&gt;'.$destination->category_name.'</option>'.PHP_EOL;
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
                                                        echo '<li><a href="#'.$destination->id.'">'.$destination->category_name.'</a></li>">';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <input type="button" name="next" class="next action-button personalized-btn-deafult progress-bar-btn-increment" value="Continue" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="experience-page-align">
                                        <h2 class="black-heading-big">What would you like experience</h2>
                                        <div class="selector-outer-align">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label class="personalized-service-checkbox-label" for="location1"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Be Active</label>
                                                        <input class="personalized-service-checkbox-input" id="location1" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/5-3.jpg');" class="personalized-service-checkbox-label" for="location2"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Relax and Refuel</label>
                                                        <input class="personalized-service-checkbox-input" id="location2" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden.jpg');" class="personalized-service-checkbox-label" for="location3"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>With the family</label>
                                                        <input class="personalized-service-checkbox-input" id="location3" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label class="personalized-service-checkbox-label" for="location4"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Explore something new</label>
                                                        <input class="personalized-service-checkbox-input" id="location4" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden.jpg');" class="personalized-service-checkbox-label" for="location5"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Pampering & Enjoyment</label>
                                                        <input class="personalized-service-checkbox-input" id="location5" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/5-3.jpg');" class="personalized-service-checkbox-label" for="location6"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Time Together</label>
                                                        <input class="personalized-service-checkbox-input" id="location6" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" class="previous action-button  ps-basic-btn progress-bar-btn-decrement" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="experience-page-align">
                                        <h2 class="black-heading-big">Your accomodation</h2>
                                        <div class="selector-outer-align">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/1487942280-6276912.jpg');" class="personalized-service-checkbox-label" for="experience1"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Go Beach Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience1" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/5-3.jpg');" class="personalized-service-checkbox-label" for="experience2"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Go Green Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience2" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label  style="background-image: url('assets/images/Architecture-&-Design.png');"  class="personalized-service-checkbox-label" for="experience3"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Go Urban Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience3" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden (2).jpg');" class="personalized-service-checkbox-label" for="experience4"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Go Infinity Pools</label>
                                                        <input class="personalized-service-checkbox-input" id="experience4" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/1487942280-6276912.jpg');" class="personalized-service-checkbox-label" for="experience5"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Go Spa & Wellness Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience5" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden (2).jpg');" class="personalized-service-checkbox-label" for="experience6"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Go Mountains and Skin Resorts</label>
                                                        <input class="personalized-service-checkbox-input" id="experience6" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/Architecture-&-Design.png');" class="personalized-service-checkbox-label" for="experience7"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Discover Yoga Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience7" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label class="personalized-service-checkbox-label" for="experience8"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Discover culinary Delight Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience8" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/1487942280-6276912.jpg');" class="personalized-service-checkbox-label" for="experience9"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Discover Family Friendly Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience9" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="row">
                                                    <div class="form-group ps-fields-align">
                                                        <label style="background-image: url('assets/images/5-3.jpg');" class="personalized-service-checkbox-label" for="experience10"><span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>Unusual Adventure Hotels</label>
                                                        <input class="personalized-service-checkbox-input" id="experience10" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button personalized-btn-deafult progress-bar-btn-increment" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" class="previous action-button  ps-basic-btn" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">What is particularly important to you?</h2>
                                            <p class="sub-des-heading">Tell us what you value - the more detailed the better.</p>
                                        </div>
                                        <div class="form-group textarea-left-align">
                                            <textarea class="form-control ps-text-area-style" placeholder="Further comments or wishes? A concrete trip tour, a special occasion such as A honeymoon or your approximate travel budget."></textarea>
                                        </div> 
                                        <div class="help-hover-icon">
                                            <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Your callback date can be selected in last step"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" class="previous action-button  ps-basic-btn progress-bar-btn-decrement" value="Previous" />
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
                                                    <div class="ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" type="text" value="50">
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
                                                    <div class="ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" type="text" value="50">
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
                                                    <div class="ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" type="text" value="50">
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
                                                    <div class="ps-handle-counter">
                                                        <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                        <input class="spinner-input" type="text" value="50">
                                                        <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" class="previous action-button  ps-basic-btn" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">When would you like to travel?</h2>
                                        </div>
                                        <div class="textarea-left-align">
                                            <div class="get-travel-details">
                                                <div class="form-group">
                                                    <input class="ps-input-style form-control get-earliest-arrival" type="text" placeholder="Earliest Arrival">
                                                </div>
                                                <div class="form-group">
                                                    <input class="ps-input-style form-control get-checkout-date" type="text" placeholder="Late Check Out">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control ps-input-style">
                                                    <option>1-2 Weeks</option>
                                                    <option>2-3 Weeks</option>
                                                    <option>3-4 Weeks</option>
                                                    <option>4-5 Weeks</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="help-hover-icon">
                                            <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button personalized-btn-deafult" value="Continue" />
                                    <div></div>
                                    <input type="button" name="previous" class="previous action-button  ps-basic-btn" value="Previous" />
                                </fieldset>
                                <fieldset class="hide-form muti-form-align">
                                    <div class="centred-tab-align">
                                        <div>
                                            <h2 class="black-heading-big">Contact Details</h2>
                                            <p class="sub-des-heading margin-bottom-30">Please complete the following information.</p>
                                        </div>
                                        <div class="form-group text-left">
                                            <input class="radio-btn" type="radio" name="optradio">
                                            <label class="radio-inline radio-btn-label">Sir</label>
                                            <input class="radio-btn" type="radio" name="optradio">
                                            <label class="radio-inline radio-btn-label">Mrs</label>
                                        </div>
                                        <div class="form-group">
                                            <input class="ps-input-style form-control" type="text" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <input class="ps-input-style form-control" type="text" placeholder="Surname">
                                        </div>
                                        <div class="form-group">
                                            <input class="ps-input-style form-control" type="text" placeholder="Email">
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
                    e.preventDefault();
                    var $a = $(this);
                    $a.toggleClass('active').siblings().removeClass('active');
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
                $('.ps-handle-counter').handleCounter({maximize: 100});
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
                $('.get-travel-details').dateRangePicker(
                        {

                            selectForward: (Boolean),
                            stickyMonths: (Boolean),
                            startDate: "12-01-2017",
                            format: ' DD.MM.YYYY',
                            separator: ' to ',

                            getValue: function ()
                            {
                                if ($('.get-earliest-arrival').val() && $('.get-checkout-date').val())
                                    return $('.get-earliest-arrival').val() + ' to ' + $('.get-checkout-date').val();
                                else
                                    return '';
                            },
                            setValue: function (s, s1, s2)
                            {
                                $('.get-checkout-date').val(s1);
                                $('.get-earliest-arrival').val(s2);
                            }
                        }
                ).bind('datepicker-first-date-selected', function (event, obj) {
                    $(".get-earliest-arrival").val('');
                });
                
            });
        </script>


@stop