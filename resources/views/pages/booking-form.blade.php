<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Booking Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        {{-- <link href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}" rel="stylesheet" type="text/css"/> --}}
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jasor-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/crousal-book-form.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/booking-form.css')}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('sximo/assets/css/ai_bookingform_responsive.css')}}" />
        
        <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
        
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        
        <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
        
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        {{-- <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script> --}}
        
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jasor.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jssor.slider-22.2.10.mini.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/gen_validatorv4.js')}}" type="text/javascript"></script>

        <style>
            .draggable-room-node {
                background-color: #fff;
                width: 151px;
            }
            #ai-custom-villa-booking-Carousel .carousel-inner {
                overflow: visible;
            }
            #ai-custom-villa-booking-Carousel .carousel-inner.overflow-hidden {
                overflow: hidden;
            }
            .compare-villa-box-inner-text.droppable {
                height: 598px;
                padding: 10px;
            }
            .description {
                display: none;
            }
            .compare-villa-box-inner-text.droppable .description {
                display: block;
            }
            .your-contact-detail-form .display-inline-block > div.text-danger {
                color: #a94442;
            }
            .date-picker-wrapper.no-shortcuts.no-gap.two-months {
                top: 585px !important;
            }
            .font-italic{
                font-style: italic;
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
    <body>
        
        <script>
$(function () {
    $(".draggable").draggable({
        disabled: true,
        revert: false,
        helper: "clone"
    });
    $(".droppable").droppable({
        drop: function (event, ui) {
            $(this).html('<span onclick="$(this).parent().empty();">&times;</span>');
            $(this).append($(ui.draggable).clone());
        }
    });
    $('#ai-custom-villa-booking-Carousel').on('slide.bs.carousel', function () {
        $(this).find('.carousel-inner').addClass("overflow-hidden");
    });
    $('#ai-custom-villa-booking-Carousel').on('slid.bs.carousel', function () {
        $(this).find('.carousel-inner').removeClass("overflow-hidden");
    });
});
        </script>
        <?php 
        $bg_img = '';
        if(!empty($propertyDetail['propimage'][0]->file_name)){
            $bg_img = $propertyDetail['propimage'][0]->imgsrc.$propertyDetail['propimage'][0]->file_name;
        } 
        ?>
        <div class="" style="background-attachment: fixed; background-image: url('<?php echo $bg_img; ?>'); background-repeat: no-repeat; background-size: cover; min-height: 100vh;">
            <div class="container">
                <div class="form-custom-width">
                      <a href="{{ redirect()->back()->getTargetUrl() }}" class="arrowlefttop radarrow rad-left rad-top"><img src="{{ asset('themes/emporium/images/editorial-left-arrow.png')}}" alt="Icon" /></a>
                      <a href="{{ redirect()->back()->getTargetUrl() }}" class="timestop radarrow rad-right rad-top">&times;</a>
                    {{-- <a href="#"><img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" alt="" class="img-responsive new-book-form-hotel-logo" style="width: 50%;" /></a> --}}
                      <a href="#"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="" class="img-responsive new-book-form-hotel-logo" style="width: 50%;" /></a>
                    <form id="frontend_booking" action="javascript:save_reserve_forms_data('frontend_booking');" >
                        <!--<form id="frontend_booking">-->
                        <div id="booking-form-accordion" class="panel-group booking-form-villa">
                            <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}" />
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click0" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse1">YOUR STAY</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your Stay</h2>
                                        <div class="booking-form-all-fields">
                                            <div>
                                                <ul class="booking-form-dates" id="two-inputs">
                                                    <div id="t-middel-picker" class="t-datepicker">
                                                    
                                                        <li>
                                                            <div class="booking-form-heading">Arrival Date</div>
                                                            <div class="t-check-in"></div>
                                                        </li>
                                                        <li>
                                                            <div class="booking-form-heading">Departure Date</div>
                                                            <div class="t-check-out"></div>
                                                        </li>
                                                    
                                                        <?php /* <ul class="booking-form-dates" id="two-inputs">
                                                            <li>
                                                                <div class="booking-form-heading">Arrival Date</div>
                                                                <input  id="date-range-arrive" size="20" name="booking_arrive" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}">
                                                            </li>
                                                            <li>
                                                                <div class="booking-form-heading">Departure Date</div>
                                                                <input  id="date-range-destination" size="20" name="booking_destination" value="{{ ($departure!='') ? $departure : '' }}">
                                                            </li>
                                                        </ul>  */ ?>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="right-input-align">
                                                <?php
                                                $number_of_nights = '';
                                                if($arrive_date != '' && $departure != '') {
                                                    $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure)));
                                                    $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
                                                    $diff = date_diff($date1, $date2);
                                                    $number_of_nights = $diff->format("%a");
                                                    $number_of_nights++;
                                                }
                                                ?>
                                                <div class="booking-form-heading">Number of Nights(s)</div>
                                                <input id="number_of_nights" min="0" name="number_of_nights" type="number" value="{{$number_of_nights}}">
                                            </div>
                                        </div>
                                        <div class="booking-form-all-fields-row-2">
                                            <div class="input-field1">
                                                ROOMS
                                            </div>
                                            <div class="input-field2">
                                                <div class="booking-form-heading">Number of adults(s)</div>
                                                <select name="booking_adults[]" class="booking-form-select-inputs-style">
                                                    <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
                                                    <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
                                                    <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>

                                                    <option {{ ($adults!='' && $adults==4) ? 'selected' : '' }}>4</option>
                                                    <option {{ ($adults!='' && $adults==5) ? 'selected' : '' }}>5</option>
                                                     <option {{ ($adults!='' && $adults==6) ? 'selected' : '' }}>6</option>
                                                </select>
                                            </div>
                                            <div class="right-input-align2">
                                                <div class="booking-form-heading">Number of Children</div>
                                                <select name="booking_children[]" class="number_of_children booking-form-select-inputs-style">
                                                    <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
                                                    <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
                                                    <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
                                                    <option {{ ($childs!='' && $childs==3) ? 'selected' : '' }}>3</option>
                                                    
                                                    <option {{ ($childs!='' && $childs==4) ? 'selected' : '' }}>4</option>
                                                    <option {{ ($childs!='' && $childs==5) ? 'selected' : '' }}>5</option>
                                                    <option {{ ($childs!='' && $childs==6) ? 'selected' : '' }}>6</option>
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <a href="#" class="add-new-room-btn booking-add-room">ADD ROOM</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <!--                                        <div id="accordion-speical-code">
                                                                                    <div class="panel panel-default">
                                                                                        <div class="panel-heading">
                                                                                            <h4 class="panel-title">
                                                                                                <a  data-toggle="collapse" data-parent="#accordion-speical-code" href="#collapse-special1">Special Code</a>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div id="collapse-special1" class="panel-collapse collapse">
                                                                                            <div class="panel-body">
                                                                                                <input class="custom-booking-input-field"  type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="panel panel-default">
                                                                                        <div class="panel-heading">
                                                                                            <h4 class="panel-title">
                                                                                                <a  data-toggle="collapse" data-parent="#accordion-speical-code" href="#collapse-special2">Special Offer</a>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div id="collapse-special2" class="panel-collapse collapse">
                                                                                            <div class="panel-body">
                                                                                                Design Location Special Offer
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                        <input type="button" class="step-first validate-btn" value="BOOK YOUR STAY">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click1" data-prevent-click="1" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse2">YOUR ROOM</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div id="ai-custom-villa-booking-Carousel" class="carousel slide ai-custom-crousal-alignment">
                                            <div class="carousel-inner">
                                                @if(!empty($propertyDetail['typedata']))
                                                {{--*/ $first_index = true; /*--}}
                                                {{--*/ $row_index = 0; /*--}}
                                                <div class="item active">
                                                    <ul class="thumbnails ai-custom-corusal-style">
                                                        @foreach($propertyDetail['typedata'] as $key => $type)
                                                        @if (isset($propertyDetail['roomimgs'][$type->id][0]))
                                                        {{--*/ $row_index = $row_index + 1; /*--}}
                                                        <li class="span3">
                                                            <label class="draggable-room-node draggable" for="roomType{{$type->id}}">
                                                                <div class="thumbnail">
                                                                    <img class="img-responsive" src="{{$propertyDetail['roomimgs'][$type->id][0]->imgsrc.$propertyDetail['roomimgs'][$type->id][0]->file_name}}" alt=""/>
                                                                </div>
                                                                <div class="caption">
                                                                    <h4>{{$type->category_name}}</h4>
                                                                    @if($type->price!='')
                                                                    <div class="hotel-slider-price">
                                                                        @if($discount_apply!='')
                                                                            {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}}
                                                                            <br />Discount 10% {{($currency->content!='') ? $currency->content : '$'}} {{ ($type->price) * 10 / 100 }}
                                                                            <br /> {{($currency->content!='') ? $currency->content : '$'}} {{ $type->price - (($type->price) * 10 / 100) }}
                                                                        @else
                                                                            {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}}         
                                                                        @endif
                                                                    </div>
                                                                    @endif
                                                                    <div class="description">{{$type->room_desc}}</div>
                                                                </div>
                                                            </label>
                                                            <input id="roomType{{$type->id}}" onclick="$('.roomTypeName').html('{{$type->category_name}}');" type="radio" {{(($_REQUEST['roomType'] == $type->id) || $first_index === true)? 'checked' : ''}} name="roomType" value="{{$type->id}}" />
                                                                   {{--*/ $first_index = false; /*--}}
                                                        </li>
                                                        @if(($key % 3) == 0 && $key != 0 && count($propertyDetail['typedata']) > $row_index)
                                                    </ul>
                                                </div>
                                                <div class="item">
                                                    <ul class="thumbnails ai-custom-corusal-style">
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="control-box">                            
                                                <a data-slide="prev" href="#ai-custom-villa-booking-Carousel" class="carousel-control left villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""></a>
                                                <a data-slide="next" href="#ai-custom-villa-booking-Carousel" class="carousel-control right villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""></a>
                                            </div>  

                                        </div>

                                        <a class="hidden booking-add-room margin-bottom-45 compare-villa-show-btn" href="javascript:void(0);">COMPARE HOTELS</a>
                                        <!-- Compare Villa -->
                                        <div class="clearfix"></div>
                                        <div class="compare-villa-show-hide">
                                            <div class="compare-villa-close-btn">
                                                Please drag and drop the villas that you wish to compare below
                                            </div>
                                            <div>
                                                <div class="col-md-3 col-sm-3 compare-villa-box">
                                                    <div class="row">
                                                        <div class="compare-villa-box-inner-text droppable">Drop the Villa of your choice in this space</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 compare-villa-box">
                                                    <div class="row">
                                                        <div class="compare-villa-box-inner-text droppable">Drop the Villa of your choice in this space</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 compare-villa-box">
                                                    <div class="row">
                                                        <div class="compare-villa-box-inner-text droppable">Drop the Villa of your choice in this space</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Compare Villa -->
                                        <div id="jssor_1"  style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:400px;overflow:hidden;visibility:hidden;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                            <div data-u="slides" class="custom-thum-style" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
                                                @foreach($propertyDetail['propimage'] as $propimage):
                                                @
                                                <div>
                                                    <img class="img-responsive" src="{{$propimage->imgsrc.$propimage->file_name}}" alt=""/>
                                                    <div data-u="thumb">
                                                        <img src="{{$propimage->imgsrc.$propimage->file_name}}" alt=""/>
                                                        <div class="title_back"></div>
                                                        <div class="title">
                                                            {{$propimage->file_title}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach;
                                            </div>
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort16" style="position:absolute;left:0px;bottom:0px;width:600px;height:100px;" data-autocenter="1">
                                                <!-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div data-u="thumbnailtemplate" class="t"></div>
                                                    </div>
                                                </div>
                                                <!-- Thumbnail Item Skin End -->
                                            </div>
                                            <!-- Bullet Navigator -->
                                            <div data-u="navigator" class="jssorb03" style="bottom:116px;right:16px;">
                                                <!-- bullet navigator item prototype -->
                                                <div data-u="prototype" style="width:21px;height:21px;">
                                                    <div data-u="numbertemplate"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Jssor Slider -->
                                        <div class="below-slider-text">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <h4>{{$propertyDetail['data']->property_name}}</h4>
                                                    <p>{{$propertyDetail['data']->about_property}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {{$propertyDetail['data']->rooms_suites_desciription}}
                                                <!--                                            <ul class="below-villa-slider-list">
                                                                                                <li>240 sqm one-bedroom stilt villa (2,583 sqft)</li>
                                                                                                <li>12.5-metre private infinity pool</li>
                                                                                                <li>Generous overwater decks with ocean or lagoon views</li>
                                                                                            </ul>-->
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="villa-see-more-details-btn">
                                            <a class ="villa-see-more-toggle" href="javascript:void(0);">See more details</a>
                                            <div class="clearfix"></div>
                                            <p>{{$propertyDetail['data']->architecture_desciription}}</p>
                                            <!--                                        <div class="villa-see-more-list">
                                                                                        <div class="col-md-4">
                                                                                            <ul>
                                                                                                <li>King size bed</li>
                                                                                                <li>Bathroom with his and her part, bathtub and separate shower </li>
                                                                                                <li>Cheval Blanc bath amenities, hair amenities by Leonor Greyl</li>
                                                                                                <li>Separate dressing room</li>
                                                                                                <li>Independent toilet</li>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <ul>
                                                                                                <li>12.5-metre-long private infinity pool</li>
                                                                                                <li>Outdoor dining pergola</li>
                                                                                                <li>Outdoor shower</li>
                                                                                                <li>TV, music, lighting and air-conditioning controlled through iPad</li>
                                                                                                <li>DVD player and airplay system</li>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <ul>
                                                                                                <li>Wi-fi and cable internet</li>
                                                                                                <li>In-room safe </li>
                                                                                                <li>Private bar</li>
                                                                                                <li>Pillow menu</li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>-->
                                        </div>
                                        <div class="form-group">
                                            <input type="button" class="step-2 margin-top-25 validate-btn" value="SUBMIT YOUR ROOM">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click2" data-prevent-click="1" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse3">YOUR PREFERENCES</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your Wishes</h2>
                                        <div class="form-group">
                                            <div class="your-preferences-des-text">
                                                <p>Kindly specify any preferences or special requests you may have in
                                                    order to help us best prepare for your coming stay with us.
                                                </p>
                                                <div>
                                                    <p>Have you already stayed in one of our rooms/suites?
                                                        <span class="float-right-text">
                                                            <input name="already_stayed" value="Yes" type="radio">
                                                            <label>Yes</label>
                                                            <input name="already_stayed" value="No" checked="checked" type="radio">
                                                            <label>No</label>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="show-hide-preferences-sec">
                                                <p>ROOMS<span class="arrival-time-show-hide"><a class="pre-show-btn" href="javascript:void(0)">Please specify your arrival time</a></span></p>
                                                <div class="preferences-hide-area margin-bottom-10 margin-top-10">
                                                    <div>
                                                        <label>Expected arrival time</label>
                                                        <select name="arrival_time_hh" class="two-inputs-style1 booking-form-select-inputs-style">
                                                            <option>hh</option>
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                            <option>13</option>
                                                            <option>14</option>
                                                            <option>15</option>
                                                            <option>16</option>
                                                            <option>18</option>
                                                            <option>19</option>
                                                            <option>21</option>
                                                            <option>22</option>
                                                            <option>23</option>
                                                        </select>
                                                        <select name="arrival_time_mm" class="two-inputs-style1 booking-form-select-inputs-style">
                                                            <option>mm</option>
                                                            <option>0</option>
                                                            <option>15</option>
                                                            <option>30</option>
                                                            <option>45</option>
                                                        </select>
                                                    </div>
                                                    <div class="margin-top-25">
                                                        <label>We would like assistance organizing our transfers  <input name="organizing_transfers" value="Yes" type="checkbox"></label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin-top-25">
                                                    <label>Family Name</label>
                                                    <input type="text" name="bp_first_name" class="input-style-2" placeholder="First Name">
                                                    <input type="text" name="bp_last_name" class="input-style-2" placeholder="Last Name">
                                                    <a class="specify-preferences-tooggle" href="javascript:void(0)">Specify preferences</a>
                                                </div>
                                                <div style="display: block;" class="box-inner-bg margin-top-25 specify-preferences-list-hide">
                                                    <p>Preferences of</p>
                                                    <div>
                                                        <label class="single-label-width">Relationship</label>
                                                        <select name="relationship" class="click-preferences-panel-btn-1 single-inputs-style1 booking-form-select-inputs-style">
                                                            <option></option>
                                                            <option>Self</option>
                                                            <option>Child</option>
                                                            <option>Family</option>
                                                            <option>Partner</option>
                                                            <option>Friend</option>
                                                        </select>
                                                    </div>
                                                    <div id="accordion-preferences-of-inner">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="preferences-panel-btn-1 collapsed" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne1">Purpose of stay</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne1" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div>
                                                                        <label class="single-label-width">Purpose of your stay</label>
                                                                        <select name="purpose_of_stay" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option>Annual holiday</option>
                                                                            <option>Anniversary</option>
                                                                            <option>Honeymoon</option>
                                                                            <option>Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-25">
                                                                        <div class=""><label>Do you want to provide us with further details regarding your stay?</label></div>
                                                                        <textarea name="stay_details" class="click-preferences-panel-btn-2 form-control margin-top-10" rows="5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed preferences-panel-btn-2"  data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne2"><span class="roomTypeName">{{$propertyDetail['typedata'][0]->category_name}}</span> preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne2" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div>
                                                                        <label class="single-label-width">Desired room temperature</label>
                                                                        <select name="desired_room_temperature" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Standard (20-21°)</option>
                                                                            <option>Warm (22-23°)</option>
                                                                            <option>Cold (18-19°)</option>
                                                                            <option>No Air-conditionning please</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Smoking preference</label>
                                                                        <select name="smoking_preference" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Smoking</option>
                                                                            <option>Non Smoking</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Rollaway bed</label>
                                                                        <input name="rollaway_bed" value="Yes" type="checkbox" class="single-check-box">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Crib</label>
                                                                        <input name="crib" value="Yes" type="checkbox" class="single-check-box">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Wheelchair accessible</label>
                                                                        <input name="wheelchair_accessible" value="Yes" type="checkbox" class="single-check-box">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Generally I am size</label>
                                                                        <select name="generally_am_size" class="click-preferences-panel-btn-3 single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Extra Small</option>
                                                                            <option>Small</option>
                                                                            <option>Medium</option>
                                                                            <option>Large</option>
                                                                            <option>Extra Large</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed preferences-panel-btn-3" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne3">Bedding preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne3" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div>
                                                                        <label class="single-label-width">Pillow firmness</label>
                                                                        <select name="pillow_firmness" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Firm</option>
                                                                            <option>Soft</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Pillow type</label>
                                                                        <select name="pillow_type" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Feather</option>
                                                                            <option>Foam</option>
                                                                            <option>Hypoallergenic</option>
                                                                            <option>Synthetic</option>
                                                                            <option>Orthopedic</option>
                                                                            <option>Pregnancy pillow</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Bed style</label>
                                                                        <select name="bed_style" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Sheet only</option>
                                                                            <option>Duvet</option>
                                                                            <option>Sheet & Duvet</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Generally I sleep on the</label>
                                                                        <select name="generally_sleep_on" class="click-preferences-panel-btn-4 single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option value="Right side of the bed">Right side of the bed</option>
                                                                            <option value="Left side of the bed"></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed preferences-panel-btn-4" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne4">Lifestyle preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne4" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <p>Cultural Interests</p>
                                                                    <div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="art" value="Yes" type="checkbox">
                                                                                <label>Art</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="architecture_interior_design" value="Yes" type="checkbox">
                                                                                <label>Architecture & Interior Design</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="cigars" value="Yes" type="checkbox">
                                                                                <label>Cigars</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="dance" value="Yes" type="checkbox">
                                                                                <label>Dance</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="fashion" value="Yes" type="checkbox">
                                                                                <label>Fashion</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="gastronomy" value="Yes" type="checkbox">
                                                                                <label>Gastronomy</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="literature" value="Yes" type="checkbox">
                                                                                <label>Literature</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="music" value="Yes" type="checkbox">
                                                                                <label>Music</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="nature" value="Yes" type="checkbox">
                                                                                <label>Nature</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="photography" value="Yes" type="checkbox">
                                                                                <label>Photography</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="science" value="Yes" type="checkbox">
                                                                                <label>Science</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="technology" value="Yes" type="checkbox">
                                                                                <label>Technology</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="travel" value="Yes" type="checkbox">
                                                                                <label>Travel</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="watches" value="Yes" type="checkbox">
                                                                                <label>Watches</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="wines_spirits" value="Yes" type="checkbox">
                                                                                <label>Wines & Spirits</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Other, please specify :</label>
                                                                        <input name="other_interests" class="single-input-style" type="text">
                                                                    </div>
                                                                    <p class="margin-top-25">Sports</p>
                                                                    <div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="snorkeling" value="Yes" type="checkbox">
                                                                                <label>Snorkeling</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="diving" value="Yes" type="checkbox">
                                                                                <label>Diving</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="sailing" value="Yes" type="checkbox">
                                                                                <label>Sailing</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="tennis" value="Yes" type="checkbox">
                                                                                <label>Tennis</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="golf" value="Yes" type="checkbox">
                                                                                <label>Golf</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="motorized_water_sports" value="Yes" type="checkbox">
                                                                                <label>Motorized water sports</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="margin-top-25">Wellbeing</p>
                                                                    <div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="spa_treatments" value="Yes" type="checkbox">
                                                                                <label>Spa treatments</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="hair_treatments" value="Yes" type="checkbox">
                                                                                <label>Hair treatments</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="fitness" value="Yes" type="checkbox">
                                                                                <label>Fitness</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="pool" value="Yes" type="checkbox">
                                                                                <label>Pool</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="yoga" value="Yes" type="checkbox">
                                                                                <label>Yoga</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="pilates" value="Yes" type="checkbox">
                                                                                <label>Pilates</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="meditation" value="Yes" type="checkbox">
                                                                                <label>Meditation</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">I would prefer my in-room language settings to be:</label>
                                                                        <select name="prefer_language" class="click-preferences-panel-btn-5 single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>English</option>
                                                                            <option>German</option>
                                                                            <option>French</option>
                                                                            <option>Italian</option>
                                                                            <option>Other</option>
                                                                        </select>
                                                                        <div class="clearfix"></div>
                                                                        <label class="single-label-width"></label>
                                                                        <input style="display: none;" class="prefer_language_other single-inputs-style1" name="prefer_language_other" placeholder="Specify language" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed preferences-panel-btn-5" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne5">Eating & Drinking preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne5" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <p>Dietary regime</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input name="vegetarian" value="Yes" type="checkbox">
                                                                            <label>Vegetarian</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="halal" value="Yes" type="checkbox">
                                                                            <label>Halal</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="kosher" value="Yes" type="checkbox">
                                                                            <label>Kosher</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="gluten_free" value="Yes" type="checkbox">
                                                                            <label>Gluten-free</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="ovo_lactarian" value="Yes" type="checkbox">
                                                                            <label>Ovo-lactarian</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Favourite dishes</label>
                                                                        <input name="favourite_dishes" class="single-input-style" type="text">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Food allergies</label>
                                                                        <input name="food_allergies" class="single-input-style" type="text">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Known allergies</label>
                                                                        <input name="known_allergies" class="single-input-style" type="text">
                                                                    </div>
                                                                    <p class="margin-top-25">Snacks</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input name="savory_snacks" value="Yes" type="checkbox">
                                                                            <label>Savory snacks</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="any_sweet_snacks" value="Yes" type="checkbox">
                                                                            <label>Any sweet snacks</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="chocolate_based_pastries" value="Yes" type="checkbox">
                                                                            <label>Chocolate based pastries</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="fruit_based_pastries" value="Yes" type="checkbox">
                                                                            <label>Fruit based pastries</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="margin-top-25">Fruits</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input name="seasonal_fruits" value="Yes" type="checkbox">
                                                                            <label>Seasonal fruits</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="exotic_fruits" value="Yes" type="checkbox">
                                                                            <label>Exotic fruits</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="dried_fruits_and_nuts" value="Yes" type="checkbox">
                                                                            <label>Dried fruits and nuts</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="margin-top-25">Hot beverages</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input name="espresso" value="Yes" type="checkbox">
                                                                            <label>Espresso</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="cafe_au_lait" value="Yes" type="checkbox">
                                                                            <label>Cafe au Lait</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="tea" value="Yes" type="checkbox">
                                                                            <label>Tea</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="herbal_tea" value="Yes" type="checkbox">
                                                                            <label>Herbal tea</label>
                                                                        </div>
                                                                        <div>
                                                                            <input name="hot_chocolate" value="Yes" type="checkbox">
                                                                            <label>Hot chocolate</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div>
                                                                        <p  class="margin-top-25">Sodas</p>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="coca" value="Yes" type="checkbox">
                                                                                <label>Coca</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="diet_coke" value="Yes" type="checkbox">
                                                                                <label>Diet Coke</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="pepsi" value="Yes" type="checkbox">
                                                                                <label>Pepsi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="diet_pepsi" value="Yes" type="checkbox">
                                                                                <label>Diet Pepsi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="still_water" value="Yes" type="checkbox">
                                                                                <label>Still Water</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input name="orange_soda" value="Yes" type="checkbox">
                                                                                <label>Orange Soda</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="lemon_soda" value="Yes" type="checkbox">
                                                                                <label>Lemon Soda</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="served_with_lemon" value="Yes" type="checkbox">
                                                                                <label>Served with lemon</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="served_with_ice_cubes" value="Yes" type="checkbox">
                                                                                <label>Served with ice cubes</label>
                                                                            </div>
                                                                            <div>
                                                                                <input name="sparkling_water" value="Yes" type="checkbox">
                                                                                <label>Sparkling Water</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Preferred aperitif:</label>
                                                                        <select name="preferred_aperitif" class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Red wine</option>
                                                                            <option>White wine</option>
                                                                            <option>Champagne</option>
                                                                            <option>Cocktails</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Other remarks for our upcoming visit:</label>
                                                                        <input name="upcoming_visit_remarks" class="single-input-style" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" class="step-3 margin-top-25 validate-btn" value="SUBMIT YOUR PREFERENCES">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-prevent-click="1" class="click3" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse4">YOUR CONTACT DETAILS</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your Contact Details</h2>
                                        <div class="break-border-bottom">
                                            <div class="your-contact-detail-form">
                                                <div class="contact-form-alignment">
                                                    <div>
                                                        <input type="radio" name="our-contact-details" class="reserving-for-my-self-radio-btn">
                                                        <label>I am reserving for myself</label>
                                                        <?php if($is_logged_in == 'false'): ?>
                                                        <div class="reveal-if-active login-form-container">
                                                            <div class="reserving-myself-inner">
                                                                <p>If you already have an account, please <span class="login-bold-text">login</span> to use the existing contact details </p>
                                                                <ul class="contact-form-input-list">
                                                                    <li>
                                                                        <div class="booking-form-heading">Email</div>
                                                                        <input id="lf-email" type="text">
                                                                        <div id="lf-email-alert-msg" class="text-danger"></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="booking-form-heading">Password</div>
                                                                        <input id="lf-password" type="password" value="">
                                                                        <div id="lf-password-alert-msg" class="text-danger"></div>
                                                                    </li>
                                                                    <li>
                                                                        <a class="lf-submit-btn btn-ok-contact-submit" href="#">Login</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="login-form-alert-message"></div>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="align-with-radio">
                                                        <input type="radio" name="our-contact-details" class="guest-reserve-radio-btn">
                                                        <label>I am reserving on behalf of someone else</label>
                                                        <div class="reveal-if-active">
                                                            <div class="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="your-contact-detail-sec-show-hide">
                                                    <h3 class="">Your Contact Details</h3>
                                                    <div class="margin-top-10 display-inline-block">
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">Title *</div>
                                                            <select name="title" class="select-width-88 booking-form-select-inputs-style">
                                                                <option value="0"></option>
                                                                <option>Mr.</option>
                                                                <option>Mrs.</option>
                                                                <option>Miss</option>
                                                            </select>
                                                        </div>
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">Last name *</div>
                                                            <input name="last_name" class="default-input-style margin-right-26" type="text">
                                                        </div>
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">First Name *</div>
                                                            <input name="first_name" class="default-input-style margin-right-26" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <div>Birthday </div>
                                                        <div class="margin-right-15 display-inline-block">
                                                            <select name="birthday_dd" class="select-width-88 booking-form-select-inputs-style">
                                                                <option>DD</option>
                                                                <?php
                                                                for($i = 1; $i <= 31; $i++) {
                                                                    echo '<option>'.$i.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="margin-right-15 display-inline-block">
                                                            <select name="birthday_mm" class="select-width-88 booking-form-select-inputs-style">
                                                                <option>MM</option>
                                                                <?php
                                                                for($i = 1; $i <= 12; $i++) {
                                                                    echo '<option>'.$i.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="margin-right-15 display-inline-block">
                                                            <select name="birthday_yyyy" class="select-width-88 booking-form-select-inputs-style">
                                                                <option>YYYY</option>
                                                                <?php
                                                                for($i = date('Y'); $i >= 1920; $i--) {
                                                                    echo '<option>'.$i.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--<div class="fields-end-border"></div>-->
                                                    <div>
                                                        <a class="secondry-address-toggle hidden" href="javascript:void(0);">Secondary Address</a>
                                                        <div class="secondry-class-list">
                                                            <div class="margin-top-10">
                                                                <label class="margin-right-15">Address *</label>
<!--                                                                <select class="display-inline-block select-width-200 booking-form-select-inputs-style">
                                                                    <option>00</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                </select>-->
                                                                <div class="margin-top-25">
                                                                    <input name="address" class="form-control default-input-style margin-right-26" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10 display-inline-block">
                                                                <div class="display-inline-block">
                                                                    <div class="">City *</div>
                                                                    <input name="city" class="default-input-style margin-right-10 width-285" type="text">
                                                                </div>
                                                                <div class="display-inline-block">
                                                                    <div class="">Zip Code *</div>
                                                                    <input name="zip_code" class="default-input-style margin-right-26 select-width-88" type="text">
                                                                </div>
                                                                <div class="display-inline-block">
                                                                    <div class="">Country *</div>
                                                                    <select name="country" class="select-width-161 booking-form-select-inputs-style">
                                                                        <option></option>
                                                                        <option>America</option>
                                                                        <option>India</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="fields-end-border"></div>
                                                        </div>
                                                        <div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="margin-top-10 display-inline-block">
                                                                        <div class="display-inline-block">
                                                                            <div class="">Land Line *</div>
                                                                            <input name="landline_code" class="default-input-style margin-right-15 width-68" type="text">
                                                                        </div>
                                                                        <div class="display-inline-block">
                                                                            <input name="landline_number" class="default-input-style  select-width-200" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="margin-top-10 display-inline-block">
                                                                        <div class="display-inline-block">
                                                                            <div class="">Mobile *</div>
                                                                            <input name="mobile_code" class="default-input-style margin-right-10 width-68" type="text">
                                                                        </div>
                                                                        <div class="display-inline-block">
                                                                            <input name="mobile_number" class="default-input-style   select-width-200" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Email **</div>
                                                                <input name="email" class="default-input-style margin-right-10 width-285" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="margin-top-25 display-inline-block">
                                                            <div class="margin-bottom-10">Your preferred means of communication</div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" value="Mailing Address" type="radio">
                                                                <label>Mailing Address</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" checked="" value="Email" type="radio">
                                                                <label>Email</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" value="Land Line" type="radio">
                                                                <label>Land Line</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" value="Mobile" type="radio">
                                                                <label>Mobile</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Account Details -->
                                                    <div class="your-account-sec">
                                                        <h4 class="account-tittle">Your account</h4>
                                                        <p>To facilitate future bookings, we invite you to create a 
                                                            personal account by entering a password.
                                                        </p>
                                                        <div class="margin-top-10">
                                                            <label class="single-label-width">Password</label>
                                                            <input class="single-input-style" name="password" type="password">
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <label class="single-label-width">Confirm the password</label>
                                                            <input class="single-input-style" name="confirm_password" type="password">
                                                        </div>
                                                    </div>
                                                    <div class="partition-border-bottom"></div>
                                                    <!--Account Details -->
                                                    <!-- Guest Contact Details -->
                                                    <div class="guest-contact-detail-sec">
                                                        <h3 class="">Your Guest Details</h3>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="single-label-width">Title</div>
                                                                <select name="guest_title" class="select-width-88 booking-form-select-inputs-style">
                                                                    <option value="0"></option>
                                                                    <option>Mr.</option>
                                                                    <option>Mrs.</option>
                                                                    <option>Miss</option>
                                                                </select>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <div class="single-label-width">Last name</div>
                                                                <input name="guest_last_name" class="default-input-style margin-right-26" type="text">
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <div class="single-label-width">First Name</div>
                                                                <input name="guest_first_name" class="default-input-style margin-right-26" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <div>Birthday </div>
                                                            <div class="margin-right-15 display-inline-block">
                                                                <select name="guest_birthday_dd" class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>DD</option>
                                                                    <?php
                                                                    for($i = 1; $i <= 31; $i++) {
                                                                        echo '<option>'.$i.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="margin-right-15 display-inline-block">
                                                                <select name="guest_birthday_mm" class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>MM</option>
                                                                    <?php
                                                                    for($i = 1; $i <= 12; $i++) {
                                                                        echo '<option>'.$i.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="margin-right-15 display-inline-block">
                                                                <select name="guest_birthday_yyyy" class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>YYYY</option>
                                                                    <?php
                                                                    for($i = date('Y'); $i >= 1920; $i--) {
                                                                        echo '<option>'.$i.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--<div class="fields-end-border"></div>-->
                                                        <div>
                                                            <a class="secondry-address-toggle hidden" href="javascript:void(0);">Secondary Address</a>
                                                            <div class="secondry-class-list">
                                                                <div class="margin-top-10">
                                                                    <label class="margin-right-15">Address</label>
                                                                    <select name="guest_address" class="display-inline-block select-width-200 booking-form-select-inputs-style">
                                                                        <option></option>
                                                                        <option>personal</option>
                                                                        <option>professional</option>
                                                                    </select>
                                                                    <div class="margin-top-25">
                                                                        <input class="form-control default-input-style margin-right-26" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="margin-top-10 display-inline-block">
                                                                    <div class="display-inline-block">
                                                                        <div class="">City</div>
                                                                        <input name="guest_city" class="default-input-style margin-right-10 width-285" type="text">
                                                                    </div>
                                                                    <div class="display-inline-block">
                                                                        <div class="">Zip Code</div>
                                                                        <input name="guest_zip_code" class="default-input-style margin-right-26 select-width-88" type="text">
                                                                    </div>
                                                                    <div class="display-inline-block">
                                                                        <div class="">Country</div>
                                                                        <select name="guest_country" class="select-width-161 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>America</option>
                                                                            <option>India</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="fields-end-border"></div>
                                                            </div>
                                                            <div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="margin-top-10 display-inline-block">
                                                                            <div class="display-inline-block">
                                                                                <div class="">Land Line</div>
                                                                                <input name="guest_landline_code" class="default-input-style margin-right-15 width-68" type="text">
                                                                            </div>
                                                                            <div class="display-inline-block">
                                                                                <input name="guest_landline_number" class="default-input-style  select-width-200" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="margin-top-10 display-inline-block">
                                                                            <div class="display-inline-block">
                                                                                <div class="">Mobile</div>
                                                                                <input name="guest_mobile_code" class="default-input-style margin-right-10 width-68" type="text">
                                                                            </div>
                                                                            <div class="display-inline-block">
                                                                                <input name="guest_mobile_number" class="default-input-style   select-width-200" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10 display-inline-block">
                                                                <div class="display-inline-block">
                                                                    <div class="">Email</div>
                                                                    <input name="guest_email" class="default-input-style margin-right-10 width-285" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Guest Contact Details -->
                                                    <!-- Credit card details section-->
                                                    <div class="credit-card-details-sec">
                                                        <div class="bk-notice">No Booking or credit card fees. Your credit card is needed to guarantee your booking. All charges will be made by the hotel.</div>
                                                        <h4>Your credit card details</h4>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Type of card</div>
                                                                <select name="card_type" class="input_card_type display-inline-block width-285 booking-form-select-inputs-style">
                                                                    <option value="0"></option>
                                                                    <option>American Express</option>
                                                                    <option>MasterCard</option>
                                                                    <option>Visa</option>
                                                                </select>
                                                                <div class="crd_card_type_alert_msg text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Credit card number *</div>
                                                                <input name="card_number" autocomplete="off" class="input_card_number default-input-style margin-right-10 width-285" type="text">
                                                                <div class="crd_card_number_alert_msg text-danger"></div>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <div class="">Expiry date *</div>
                                                                <select name="expiry_month" class="input_expiry_month select-width-88  margin-right-26 booking-form-select-inputs-style">
                                                                    <option value="0"></option>
                                                                    <option>January</option>
                                                                    <option>February</option>
                                                                    <option>March</option>
                                                                    <option>April</option>
                                                                    <option>May</option>
                                                                    <option>June</option>
                                                                    <option>July</option>
                                                                    <option>August</option>
                                                                    <option>September</option>
                                                                    <option>October</option>
                                                                    <option>November</option>
                                                                    <option>December</option>
                                                                </select>
                                                                <div class="crd_expiry_month_alert_msg text-danger"></div>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <select name="expiry_year" class="input_expiry_year select-width-88 booking-form-select-inputs-style">
                                                                    <option value="0"></option>
                                                                    <?php
                                                                    for ($i = date('Y'); $i < (date('Y') + 50); $i++) {
                                                                        echo '<option>'.$i.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <div class="crd_expiry_year_alert_msg text-danger"></div>
                                                            </div>
                                                        </div>
                                                        <p class="margin-top-25">This credit card will be charged applicable deposit fees 
                                                            as described in Terms & Conditions and may be used in 
                                                            the event of late cancellation or no-show.
                                                        </p>
                                                    </div>
                                                    <!-- Credit card details section-->
                                                </div>
                                                <input type="button" class="step-4 margin-top-25 validate-btn" value="SUBMIT CONTACT DETAILS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-prevent-click="1" class="click4" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse5">CONFIRMATION</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <!--Terms and conditions-->
                                            <div class="margin-top-25 terms-conditiond-sec">
                                                <h4 class="margin-bottom-15">Terms And Conditions</h4>
                                                <input class="our_term_n_conditions_check_box" name="term_n_conditions" value="On" type="checkbox">
                                                <label>
                                                    I have read the <a href="{{Url::to('privacy-policy')}}">Privacy Policy</a>. <span class="font-italic">I agree that my personal data will be collected and stored electronically and used electronically to make this reservation with emporium-voyage and the respective partner hotel.</span>  <?php /* <a data-toggle="modal" data-target="#our_term_n_conditions_modal" href="#">emporium-voyage</a> */ ?> 
                                                    <br />
                                                    <span class="font-italic">Note: You may revoke your consent at any time by e-mail to <a href="mailto:info@emporium-voyage.com">info@emporium-voyage.com</a> or from your settings section in your account admin.</span>
                                                </label>
                                                <div id="our_term_n_conditions_modal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" onclick="javascript:$('.our_term_n_conditions_check_box').prop('checked', true);" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Terms And Conditions</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
					<div class="col-md-12">
						<h1>TERMS AND CONDITIONS</h1>	
						<p><strong>GENERAL TERMS AND CONDITIONS</strong></p><br>
						<p><strong>A. SCOPE OF APPLICATION</strong></p>
						<p>These Terms and Conditions apply to the use of the the Design-Locations website and all bookings of hotels via the reservation system of Design-Locations, Eisolzriederstrasse 12, 80999 München</p>
						<br>
						<p><strong>B.GENERAL USE OF THE DESIGN-LOCATIONS WEBSITE</strong></p>
						<p>On the Design-Locations websites you can search for the availability and rates of hotels and rooms of your choice at dates defined by you for a specific number of travellers. Design-Locations reserves the right to discontinue it's websites at any time.</p><br>
<br>
						
						<p><strong>B.1. HOTEL CONTENT AND CATEGORIES</strong><br></p>All information about a hotel and the descriptions of a hotel are based on the hotel's own assessment. All content about a hotel that is displayed on the Design-Locations websites is provided to Design-Locations by the respective hotel and Design-Locations acts as content provider for the hotel only and is thus not responsible for content, any omissions or typographical errors referring to a hotel. As far as displayed on the Design-Locations websites the internationally used hotel classification into stars offers noncommittal information about the hotel's standard, in consideration of self-assessment by the hotel which was provided by the hotel.<p></p><br>
<br>
						
						<p><strong>B.2. PRICES AND TAXES</strong></p><br>
All prices displayed on the Design-Locations websites are current, day prices, shown in the name of the individual hotel and are valid for all bookings made via the reservation system of Design-Locations as described below in section C. All prices have been provided by the hotel and Design-Locations acts as content provider for the hotel only and is thus not responsible for any errors of prices referring to a hotel<p></p><br>

<p>For Germany, prices displayed on the Design-Locations websites always include service charges and VAT. For other countries regulations and rules regarding taxes differ. Please note, that a visitor's tax might apply in certain locations. In some countries, a local tax and/or a service charge is levied on the travel price or room rate. The amount of this tax changes all the time and can’t generally be estimated but requires specific information like the exact period of stay, number of people staying etc. to be calculated. Thus any information regarding such taxes is always noncommittal, as long as you do not enter specific travel dates. When you make a booking as per below Section C. the applicable taxes will in any case be displayed.
</p><br>

<p>Complimentary room upgrades and late check-outs as part of the Design-Locations Community benefits are subject to availability. Hotels reserve the right to discontinue the offer at anytime. </p><br>

<p>Obvious errors and mistakes (including misprints) are not binding.
</p><br>
<br>
						<p><strong>C. REGISTRATION</strong></p>
						<p>You can register on the Design-Locations website. If you voluntarily provide personal data as part of such registration, it will be used to pre-fill the personal details form upon making a booking, and/or be used to provide you with more refined topics in our communications, should you have opted in to any of our newsletters. You can cancel your registration with Design-Loctions at any time. Please send an according e-mail to legal@design-locations.biz</p>
						  <br>
						
						<p><strong>D.  AUTO LOG IN</strong></p>
						<p>You may choose to stay logged in on our website. We will then will store your login information in a cookie, i.e. a small text file, on your computer so that you do not have to authenticate upon return to our website but will be automatically logged in ("auto log in"). The cookie and thereby the auto log in expires automatically after 60 days. Further information about other cookies is available in our privacy policy..</p>
						<br>
						
						<p><strong>E.  ACCOMMODATION CONTRACT AND PAYMENT </strong></p>
						<p>If you make a booking through Design-Locations reservation system the accommodation contract comes into effect between you and the hotel of your choice. You pay the confirmed price directly in the hotel. Any claims and obligations out of the accommodation contract only exist between you and the chosen Hotel. Design-Locations does not enter into the contract with you about the accommodation. Rates available and any booking made via the Design-Locations reservation system can’t be combined with other offers or promotions, Unless specifically offered on our Booking Page, such can include Spa Bookings</p><br>
						
						<p>Bookings take place according to the best and currently Design-Locations day price in each case. This price is submitted directly by the hotel for the arrival date chosen, and is shown in the name of the hotel. Available Design-Location's last-minute, seasonal, weekend or special prices will be considered automatically during the booking. Please be advised converted rates using the website currency converter are based on an estimation of that days exchange rate.</p>
						
						<p><strong>E.1. MAKING A BOOKING </strong></p>
						<p>If you want to make a booking after your availability search, you will have to fill in personal details about you and your credit card details. The credit card details are required to guarantee your booking, the charges will be made by the hotel. If you are logged in to your account the personal details will be pre-filled. By clicking the button “CONFIRM REGISTRATION. Charged upon arrival” you make a binding offer to book the selected room. Prior to making the booking, i.e. prior to clicking the button, you can identify any errors in the data you have provided directly on the website and correct them by clicking “edit” next to the hotel and room description.</p><br>
						
						<p>Every booking offer you make will be forwarded to the corresponding hotel and any messages from the hotel to you, particularly the confirmation of your booking will be forwarded to you via Design-Locations as carrier of the message. Design-Locations shall have a relationship with you and the hotel only as an independent third party and shall not be a partner, trustee, representative or sub-contractor either for you or the hotel. Also, the hotel shall not be a sub-contractor or vicarious agent of Design-Locations. As soon as you receive the booking confirmation from the hotel via the Design-Locations reservation system, you have entered into a contract with the hotel and the booking is binding. You will receive a customer booking reference number together with the confirmation of your booking. The use of the Design-Locations reservation system is free of charge for you. Bookings are not transferable to any other person and can not be transferred or exchanged for cash or credit.</p>
						<br>
						
						<p><strong>E.2. CANCELATIONS </strong></p>
						<p>You do not have a statutory right of withdrawal from a booking as per Sec. 312 g para 2 no. 9 of the German Civil Code (BGB).</p><br>
						<p>However, a hotel may voluntarily offer a right to cancel or change a booking for selected offers in the Design-Locations reservation system. Any such right will be displayed in the order form before you make your order. Where a hotel voluntarily grants such right to cancel or to change a booking in the Design-Locations reservation system, any such changes and cancellations have to be carried out via the Design-Locations online system or via the Design-Locations reservation number (see www.design-locations.com) to be fully effective. In case of a change or cancellation carried out directly at the hotel, Design-Locations cannot provide any information concerning possible discrepancies concerning the date of the cancellation or the fact of cancellation as such</p><br>
						
						<p><strong>E.3. STORING AND ACCESSIBILITY OF THE CONTRACT </strong></p>
						<p>We will store your booking information and the terms and conditions applicable to the booking (collectively referred to as “contract”). The current version of our terms and conditions is available for you at https://www.design-locations.biz/terms. We also store older version of our terms and conditions. You can access your booking information also after the booking via your Design-Locations account.
						
						</p><p><strong>F. LIABILITY</strong></p>
						<p>- In case of intent or gross negligence on part of Design-Locations or by its agents or vicarious agents in performance Design-Locations shall be liable according to the provisions of applicable law. The same applies in case of breach of an essential contractual obligation (an obligation that must be fulfilled to enable the correct execution of the agreement and which the customer may usually trust and may trust that it will be fulfilled); however, to the extent such breach was unintentionally Design-Locations liability shall be limited to typical damages foreseeable under the contract.</p><br>
						
						<p>- Design-Locations liability for culpable damage to life, body or health as well as our liability under the Product Liability Act shall remain unaffected.</p>
						
						<p>- Any liability not expressly provided for above shall be disclaimed. Particularly Design-Locations disclaims any liability for the reproduction of this website through a third party website or access to this website obtained through a third party website or any user’s home page, which reproduction misstates or omits any of the information or limitations and conditions on the room rates and products offered through this website</p><br>
						
						
						<p><strong>G. INTELLECTUAL PROPERTY</strong></p>
						<p>All trademarks (including, but not limited to, the Design-Locations trade mark, reproductions of Design-Locations logo), copyright, database rights and other intellectual property rights in the materials on this website (as well as the organisation and layout of this website) together with the underlying software code are owned either directly by Design-Locations or by its licensors. Without Design-Locations’ prior written permission, you may not copy, modify, alter, publish, broadcast, distribute, sell or transfer any material on this website or the underlying software code whether in whole or in part. However, the contents of this website may be downloaded, printed or copied for your personal non-commercial use. The Design-Locations logo is a registered trademark and is the property of Design-Locations and may not be used or reproduced without Design-Locations’ express written permission.</p><br>
						
						<p>Data transfer into other data carriers, even part of it, or it's use for a different purpose to the one designated here, is only permitted with the explicit permission of Design-Locations, except where explicitly permitted by applicable law.</p><br>
						
						<p><strong>H. GOVERNING LAW AND PLACE OF JURISDICTION</strong></p>
						<p>All legal relation between you and Design-Locations shall exclusively be governed by the laws of the Federal Republic of Germany. If you act as a consumer and have entered into a contract while residing in another country, the application of mandatory law of such country shall not be affected by the previous sentence</p><br>
						
						<p>If you are a trader or an entity of public law, the competent courts in Munich shall have jurisdiction for all disputes. Design-Locations shall, however, also be entitled to sue you at your general venue.</p><br>
						
						<p><strong>I. MISCELLANEOUS</strong></p>
						<p>The invalidity or unenforceability of any of these Terms and Conditions shall not affect, impair or invalidate any of the remaining terms and conditions.</p><br>
						
						<p>The website is owned and operated by Design-Locations.The website can be used, registrations and bookings can be made and in the English language. </p><br>
						
						<p>Plattform of The European Commission for online dispute resolution: www.ec.europa.eu/consumers/odr</p><br>
						
						
						
												<p><strong>Last Update: April 2017</strong></p>
					</div>
				</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="clearfix"></div>
                                                <?php if(!empty($hotel_terms_n_conditions) && trim($hotel_terms_n_conditions->terms_n_conditions) != ''): ?>
                                                <input class="hotel_term_n_conditions_check_box" name="hotel_term_n_conditions" value="On" type="checkbox">
                                                <label>
                                                    I agree to my personal data being stored and used to make this reservation <a data-toggle="modal" data-target="#hotel_term_n_conditions_modal" href="#">emporium-voyage</a>
                                                </label>
                                                <div id="hotel_term_n_conditions_modal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" onclick="javascript:$('.hotel_term_n_conditions_check_box').prop('checked', true);" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">{{$propertyDetail['data']->property_name}} Terms And Conditions</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $hotel_terms_n_conditions->terms_n_conditions; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                
                                                <div class="clearfix"></div>
                                                <input class="hotel_offer_personal_preferences_check_box" name="hotel_offer_personal_preferences" value="On" type="checkbox">
                                                <label>
                                                    <span class="font-italic">I agree to receive booking confirmations via email or phone and acknowledge that i can change my communication methods from my personal account preferences.</span>
                                                </label>
                                                <div class="clearfix"></div>
                                                <input class="emporium_voyage_term_n_conditions_check_box" name="emporium_voyage_term_n_conditions" value="On" type="checkbox">
                                                <label>
                                                    <span class="font-italic">I agree to the emporium-voyage&trade;  <a href="{{Url::to('terms-and-conditions')}}">terms and conditions</a> pertaining to the reservation.</span>
                                                </label>
                                                
                                            </div>
                                            <!--Terms and conditions-->
                                            <div class="partition-border-bottom"></div>
                                            <div class="validations">
                                                <div id="frontend_booking_term_n_conditions_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_emporium_voyage_term_n_conditions_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_hotel_offer_personal_preferences_errorloc" class="error_strings text-danger"></div>
                                                
                                                <div id="frontend_booking_booking_arrive_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_booking_destination_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_number_of_nights_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_title_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_first_name_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_last_name_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_landline_code_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_landline_number_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_mobile_code_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_mobile_number_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_email_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_password_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_confirm_password_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_card_type_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_card_number_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_expiry_month_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_expiry_year_errorloc" class="error_strings text-danger"></div>
                                            </div>
                                            <!--Terms and conditions-->
                                            <input type="submit" class="step-5 margin-top-25 validate-btn" value="SUBMIT CONFIRMATION">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        <style>
            .booking-form-dates .t-check-in,.t-check-out{
                width: 100% !important;
            }
            .booking-form-dates .t-dates{                
                border: 1px solid #b3b3b3 !important;
                background: #fff !important;
                color: #000 !important;
            }
            #number_of_nights{
                height: 37px !important;
            }
        </style>
        <script>
            $(document).ready(function () {
                var arrive_date = '{{$book_arrive_date}}';
                var departure = '{{$book_departure}}';
                
                var chk_date = ''; 
                if(arrive_date != '' && arrive_date != '1970-01-01' && arrive_date != 'null'){
                    
                    var dt = new Date(arrive_date);
                    var t_chk_v_year = dt.getFullYear(); 
                    var t_chk_v_month = dt.getMonth(); 
                    var t_chk_v_day = dt.getDate(); 
                    chk_date = new Date(t_chk_v_year,t_chk_v_month,t_chk_v_day)
                }
                var chk_out_date = ''; 
                if(departure != '' && departure != '1970-01-01' && departure != 'null'){
                    var dt_out = new Date(departure);
                    var t_chk_v_out_year = dt_out.getFullYear(); 
                    var t_chk_v_out_month = dt_out.getMonth(); 
                    var t_chk_v_out_day = dt_out.getDate(); 
                    chk_out_date = new Date(t_chk_v_out_year,t_chk_v_out_month,t_chk_v_out_day);
                }
                
                
                $('#t-middel-picker').tDatePicker({
                    'numCalendar':'2',
                    'autoClose':true,
                    'durationArrowTop':'200',
                    'formatDate':'mm-dd-yyyy',
                    'titleCheckIn':'Arrival',
                    'titleCheckOut':'Departure',
                    'inputNameCheckIn':'booking_arrive',
                    'inputNameCheckOut':'booking_destination',
                    'titleDateRange':'days',
                    'titleDateRanges':'days',
                    'iconDate':'<i class="fa fa-calendar"></i>',
                    'limitDateRanges':'365',
                    'dateCheckIn':chk_date,
                    'dateCheckOut':chk_out_date,
                }).on('afterCheckOut',function(e, dateCO) {
                    s1 = dateCO[0];
                    s2 = dateCO[1];
                    var start = new Date(moment(s1).format('YYYY-MM-DD'));
                    var end = new Date(moment(s2).format('YYYY-MM-DD'));
                    var diff = new Date(end - start);
                    var days = diff/1000/60/60/24;
                    $('#number_of_nights').val(days + 1);                    
                });
/*                $('#two-inputs').dateRangePicker({
                    selectForward: (Boolean),
                    stickyMonths: (Boolean),
                    startDate: "<?php echo date('Y-m-d'); ?>",
                    format: 'YYYY-MM-DD',
                    autoClose: "true",
                    separator: ' to ',
                    getValue: function () {
                        if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                            return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                        else
                            return '';
                    },
                    setValue: function (s, s1, s2) {
                        var start = new Date(moment(s1).format('YYYY-MM-DD'));
                        var end = new Date(moment(s2).format('YYYY-MM-DD'));
                        var diff = new Date(end - start);
                        var days = diff/1000/60/60/24;
                        $('#number_of_nights').val(days + 1);
                        $('#date-range-arrive').val(moment(s1).format('DD.MM.YYYY'));
                        $('#date-range-destination').val(moment(s2).format('DD.MM.YYYY'));
                    }
                }).bind('datepicker-first-date-selected', function (event, obj) {
                    $("#date-range-destination").val('');
                }); */
            });
        </script>
        <script>
            $(document).ready(function () {
                $("header .menu > a").click(function (event) {
                    event.preventDefault();
                    $(this).parent().find("ul").toggle("slow");
                });
                $(".pre-show-btn").click(function () {
                    $(".preferences-hide-area").stop().toggle(1000);
                });
                $(".specify-preferences-tooggle").click(function () {
                    $(".specify-preferences-list-hide").toggle(1000);
                });
                $(".villa-see-more-list").hide(1000);
                $('.villa-see-more-toggle').click(function () {
                    var link = $(this);
                    $('.villa-see-more-list').slideToggle('slow', function () {
                        if ($(this).is(':visible')) {
                            link.text('Hide Details');
                        } else {
                            link.text('Show Details');
                        }
                    });
                });
                $(".secondry-class-list").hide(1000);
                $('.secondry-address-toggle').click(function () {
                    $(".secondry-class-list").toggle(1000);
                });

                $(".your-contact-detail-sec-show-hide").hide(1000);
                $(".guest-reserve-radio-btn").click(function () {
                    $(".your-contact-detail-sec-show-hide").show(1000);
                    $(".guest-contact-detail-sec").show(1000);
                });
                $(".reserving-for-my-self-radio-btn").click(function () {
                    $(".your-contact-detail-sec-show-hide").show(1000);
                    $(".guest-contact-detail-sec").hide(1000);
                });
                $('.btnNext').click(function () {
                    $('.nav-tabs > .active').next('li').find('a').trigger('click');
                });

                $('.btnPrevious').click(function () {
                    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
                });
                $(".compare-villa-show-btn").click(function () {
                    $(".draggable").draggable({
                        disabled: false
                    });
                    $(".compare-villa-show-hide").show(1000);
                    $(".compare-villa-show-btn").hide(1000);
                    $("#jssor_1").hide(1000);
                    $(".below-slider-text").hide(1000);
                });
                $(".compare-villa-close-btn").click(function () {
                    $(".draggable").draggable({
                        disabled: true
                    });
                    $(".compare-villa-show-hide").hide(1000);
                    $(".compare-villa-show-btn").show(1000);
                    $("#jssor_1").show(1000);
                    $(".below-slider-text").show(1000);
                });
                $(".step-first").click(function (event) {
                    event.preventDefault();
                    $(".click1").data("prevent-click", "0");
                    $(".click1").trigger("click");
                });

                $(".click1").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });

                $(".step-2").click(function (event) {
                    event.preventDefault();
                    $(".click2").data("prevent-click", "0");
                    $(".click2").trigger("click");
                });

                $(".click2").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });

                $(".step-3").click(function (event) {
                    event.preventDefault();
                    $(".click3").data("prevent-click", "0");
                    $(".click3").trigger("click");
                });

                $(".click3").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });

                $(".step-4").click(function (event) {
                    event.preventDefault();
                    
                    var errors = false;
                    
                    if($(".input_card_type").val() == '0') {
                        $(".crd_card_type_alert_msg").html("Please select card type");
                        errors = true;
                    }
                    else {
                        $(".crd_card_type_alert_msg").html("");
                    }
                    
                    if($(".input_card_number").val() == '') {
                        $(".crd_card_number_alert_msg").html("Please enter card number");
                        errors = true;
                    }
                    else if(isNaN($(".input_card_number").val())) {
                        $(".crd_card_number_alert_msg").html("Please enter valid card number");
                        errors = true;
                    }
                    else if($(".input_card_number").val().length != 16) {
                        $(".crd_card_number_alert_msg").html("Please enter valid card number");
                        errors = true;
                    }
                    else {
                        $(".crd_card_number_alert_msg").html("");
                    }
                    
                    if($(".input_expiry_month").val() == '0') {
                        $(".crd_expiry_month_alert_msg").html("Please select month");
                        errors = true;
                    }
                    else {
                        $(".crd_expiry_month_alert_msg").html("");
                    }
                    
                    if($(".input_expiry_year").val() == '0') {
                        $(".crd_expiry_year_alert_msg").html("Please select year");
                        errors = true;
                    }
                    else {
                        $(".crd_expiry_year_alert_msg").html("");
                    }
                    
                    if(errors == false) {
                        $(".click4").data("prevent-click", "0")
                        $(".click4").trigger("click");
                    }
                });

                $(".click4").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });
            });
            var FormStuff = {
                init: function () {
                    this.applyConditionalRequired();
                    this.bindUIActions();
                },
                bindUIActions: function () {
                    $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);
                },
                applyConditionalRequired: function () {
                    $(".require-if-active").each(function () {
                        var el = $(this);
                        if ($(el.data("require-pair")).is(":checked")) {
                            el.prop("required", true);
                        } else {
                            el.prop("required", false);
                        }
                    });
                }
            };
            FormStuff.init();
            
            function radRemoveRooms(rrobj){
                if(((typeof $(rrobj).closest('.parent-rad-div').html()) != undefined) && ((typeof $(rrobj).closest('.parent-rad-div').html()) != 'undefined')){
                    $(rrobj).closest('.parent-rad-div').remove();
                }
                
                return false;
            }
            
            $(document).ready(function () {
                $(".add-new-room-btn").click(function (event) {
                    event.preventDefault();

                    var html = '<div class="parent-rad-div"><div class="input-field1">';
                    html += 'ROOMS  <a href="#" class="rad-booking-trash-icon" onclick="return radRemoveRooms(this);"><i class="fa fa-trash"></i></a>';
                    html += '</div>';
                    html += '<div class="input-field2">';
                    html += '<div class="booking-form-heading">Number of adults(s)</div>';
                    html += '<select name="booking_adults[]" class="booking-form-select-inputs-style">';
                    html += '<option>0</option>';
                    html += '<option>1</option>';
                    html += '<option>2</option>';
                    html += '<option>3</option>';
                    html += '</select>';
                    html += '</div>';
                    html += '<div class="right-input-align2">';
                    html += '<div class="booking-form-heading">Number of Children</div>';
                    html += '<select name="booking_children[]" class="booking-form-select-inputs-style">';
                    html += '<option>0</option>';
                    html += '<option>1</option>';
                    html += '<option>2</option>';
                    html += '</select>';
                    html += '</div>';
                    html += '<div class="clearfix"></div></div>';
                    $(this).before(html);
                });
                
                $(".click-preferences-panel-btn-1").change(function() {
                    $(".preferences-panel-btn-1").trigger("click");
                });
                $(".click-preferences-panel-btn-2").blur(function() {
                    $(".preferences-panel-btn-2").trigger("click");
                });
                $(".click-preferences-panel-btn-3").change(function() {
                    $(".preferences-panel-btn-3").trigger("click");
                });
                $(".click-preferences-panel-btn-4").change(function() {
                    $(".preferences-panel-btn-4").trigger("click");
                });
                $(".click-preferences-panel-btn-5").change(function() {
                    if($(this).val() == 'Other') {
                        $(".prefer_language_other").show();
                    }
                    else {
                        $(".prefer_language_other").hide();
                        $(".preferences-panel-btn-5").trigger("click");
                    }
                });
                $(".prefer_language_other").blur(function() {
                    $(".preferences-panel-btn-5").trigger("click");
                });
                $(".lf-submit-btn").click(function( event ) {
                    event.preventDefault();
                    if($("#lf-email").val() == '') {
                        $("#lf-email-alert-msg").html("Please enter email");
                    }
                    else {
                        $("#lf-email-alert-msg").html("");
                    }
                    if($("#lf-password").val() == '') {
                        $("#lf-password-alert-msg").html("Please enter password");
                    }
                    else {
                        $("#lf-password-alert-msg").html("");
                    }
                    if($("#lf-email").val() != '' && $("#lf-password").val() != '') {
                        $.ajax({
                            url: "{{ URL::to('_ajax_login')}}",
                            data: "email=" + $("#lf-email").val() + "&password=" + $("#lf-password").val(),
                            type: "POST",
                            success: function (data, textStatus, jqXHR) {
                                
                                if(data == 'already_logged_in') {
                                    $(".login-form-alert-message").html("You are already logged in.");
                                    $(".login-form-container").fadeOut(3000);
                                }
                                else if(data == 'user_not_active') {
                                    $(".login-form-alert-message").html("Your Account is not active.");
                                }
                                else if(data == 'account_is_blocked') {
                                    $(".login-form-alert-message").html("Your Account is BLocked.");
                                }
                                else if(data == 'logged_in') {
                                    $(".login-form-alert-message").html("You are logged in successfully.");
                                    $(".login-form-container").fadeOut(3000);
                                }
                                else if(data == 'invalid_details') {
                                    $(".login-form-alert-message").html("Your username/password combination was incorrect.");
                                }
                                else {
                                    $(".login-form-alert-message").html("An error occured please try again.");
                                }
                            },
                            error: function () {
                                $(".login-form-alert-message").html("An error occured please try again.");
                            }
                        });
                    }
                });
                $(".number_of_children").change(function (){
                    $(".step-first").trigger("click");
                });
            });

            function save_reserve_forms_data(formid) {
                if (formid != '') {
                    $.ajax({
                        url: "{{ URL::to('add_new_room_booking')}}",
                        type: "post",
                        data: $('#' + formid).serializeArray(),
                        dataType: "json",
                        success: function (data) {
                            var html = '';
                            if (data.status == 'error') {
                                alert('error');
                            } else {
                                window.location.href = "{{ URL::to('bookings')}}";
                            }
                        }
                    });
                }
            }
            $(document).ready(function () {
            var frmvalidator = new Validator("frontend_booking");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();
            
            frmvalidator.addValidation("term_n_conditions", "shouldselchk=On", "You must agree with our terms and conditions.");
            
            frmvalidator.addValidation("emporium_voyage_term_n_conditions", "shouldselchk=On", "You must agree to emporium-voyage.");
            frmvalidator.addValidation("hotel_offer_personal_preferences", "shouldselchk=On", "You must agree to personal preferences.");
            
//            frmvalidator.addValidation("hotel_term_n_conditions", "shouldselchk=On", "You must agree with hotel terms and conditions.");
            //frmvalidator.addValidation("booking_arrive2", "req", "Please enter arrival date.");
            frmvalidator.addValidation("booking_arrive", "req", "Please enter arrival date.");
            frmvalidator.addValidation("booking_destination", "req", "Please enter departure date.");
            frmvalidator.addValidation("number_of_nights", "dontselect=0", "Please select number of nights.");
            frmvalidator.addValidation("title", "dontselect=0", "Please select title.");
            frmvalidator.addValidation("first_name", "req", "Please enter first name.");
            frmvalidator.addValidation("last_name", "req", "Please enter last name.");
            frmvalidator.addValidation("landline_code", "req", "Please enter landline code.");
            frmvalidator.addValidation("landline_number", "req", "Please enter landline number.");
            frmvalidator.addValidation("mobile_code", "req", "Please enter mobile code.");
            frmvalidator.addValidation("mobile_number", "req", "Please enter mobile number.");
            frmvalidator.addValidation("email", "req", "Please enter email address.");
            frmvalidator.addValidation("email", "email", "Please enter valid email address.");
            frmvalidator.addValidation("card_number", "req", "Please enter card number.");
            frmvalidator.addValidation("card_type", "dontselect=0", "Please select card type.");
            frmvalidator.addValidation("expiry_month", "dontselect=0", "Please select expiry month.");
            frmvalidator.addValidation("expiry_year", "dontselect=0", "Please select expiry year.");
            <?php if($is_logged_in == 'false'): ?>
            frmvalidator.addValidation("password", "req", "Please enter password.");
            frmvalidator.addValidation("confirm_password", "eqelmnt=password", "Password doesn't matach.");
            <?php endif; ?>
            });
        </script>
        <!--include('layouts/elliot/ai_booking-page')-->
    </body>
</html>