<?php $active_menu = 'bookings'; ?>
@extends('layouts.customer_app')
 
@section('content')
<section>
    <div class="col-md-3 col-sm-3">
        <div class="row">
            <div class="history-sec-show-hide">
                <div class="booking-page-tiitle-bar">
                    <h2>History</h2>
                </div>
                <div class="main-side-sec-align">
                    <div class="booking-side-des-heading-panel">
                        <p>There is a list of completed and canceled Reservtions</p>
                        <div class="below-example-text">My Bookings</div>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="nav nav-pills history-pills-align">
                        <?php
                        if(!empty($rowData)) {
                            $index = 0;
                            foreach ($rowData as $row) {
                                $date1 = date_create(date('Y-m-d H:i:s', strtotime($row->checkout_date)));
                                $date2 = date_create(date('Y-m-d H:i:s', strtotime($row->checkin_date)));
                                $diff = date_diff($date1, $date2);
                                $number_of_nights = $diff->format("%a");
                                ?>
                                <li class="<?php echo ($index == 0)? 'active' : ''; ?>">
                                    <a data-toggle="pill" href="#booking-tab-<?php echo $index; ?>">
                                        <div class="booking-example-pannel">
                                            <div class="side-booking-side-des-align">
                                                <div class="inner-tick-icon">
                                                    <?php if($row->booking_status == 1): ?>
                                                    <i class="fa tick-icon-check fa-check" aria-hidden="true"></i>
                                                    <?php else: ?>
                                                    <i class="fa red-tick-icon-check fa-times" aria-hidden="true"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="inner-des-align">
                                                    <?php echo $row->category->category_name; ?> from <?php echo date('d.m.Y', strtotime($row->checkin_date)); ?> to <?php echo date('d.m.Y', strtotime($row->checkout_date)), ' ', $number_of_nights; ?> days
                                                </div>
                                            </div>
                                            <div class="side-booking-price-align">
                                                <?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', $row->category->price; ?>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                $index++;
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="hide-btn"><span class="show-hide-graphics"><i class="fa fa-eye" aria-hidden="true"></i></span> Show / Hide Bookings</div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 right-main-profile-show" >
        <div class="row">
            <div class="tab-content">
                <?php
                if(!empty($rowData)) {
                    $index = 0;
                    foreach ($rowData as $row) {
                        $date1 = date_create(date('Y-m-d H:i:s', strtotime($row->checkout_date)));
                        $date2 = date_create(date('Y-m-d H:i:s', strtotime($row->checkin_date)));
                        $diff = date_diff($date1, $date2);
                        $number_of_nights = $diff->format("%a");
                        
                        $vat = (($row->category->price * $number_of_nights) * (20/100));
                        $price = ($row->category->price * $number_of_nights);
                        
                        ?>
                        <div class="tab-pane fade <?php echo ($index == 0)? 'in active' : ''; ?>" id="booking-tab-<?php echo $index; ?>">
                            <div class="booking-page-tiitle-bar">
                                <h2><?php echo $row->props->property_name; ?></h2>
                            </div>
                            <div class="booking-my-profile-sec">
                                <div>
                                    <div class="my-booking-profile-image-align"><img class="img-responsive" src="assets/images/riaan.jpg" alt=""/></div>
                                    <div class="my-booking-text">
                                        <h2><?php echo $row->user_info->title.' '.$row->user_info->first_name.' '.$row->user_info->last_name; ?></h2>
                                        <p><?php echo $row->user_info->email; ?></p>
                                    </div>
                                </div>
                                <div class="booking-order-details-main-align">
                                    <ul class="booking-page-profile-order-details-list">
                                        <li>
                                            <div class="booking-page-order-details">
                                                <div class="left-icon-booking-details">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </div>
                                                <div class="booling-details-text">
                                                    <p><span>Check In:</span> <?php echo date('d M y', strtotime($row->checkin_date)); ?></p> 
                                                    <p><span>Check Out:</span> <?php echo date('d M y', strtotime($row->checkout_date)); ?></p> 
                                                </div>
                                            </div> 
                                        </li>
                                        <li>
                                            <div class="booking-page-order-details">
                                                <div class="left-icon-booking-details">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                </div>
                                                <div class="booling-details-text">
                                                    <p>1 + 1</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="booking-page-tiitle-bar">
                                <p class="booking-des-tittle"><?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', $row->category->price; ?> Payable at the Hotel - <span class="hotel-booking-view-terms"><a href="#">View Terms</a></span></p>
                            </div>
                            <div class="booking-table-outer">
                                <div class="col-md-6">
                                    <div class="booking-table-main-outer-align">
                                        <table class="table bookings-details-page-table table-striped">

                                            <tbody>
                                                <tr>
                                                    <td>Suite Details</td>
                                                    <td><?php echo $row->category->category_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Price/Night</td>
                                                    <td><?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', $row->category->price; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nights</td>
                                                    <td><?php echo $number_of_nights; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Price</td>
                                                    <td><?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', $price; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td><?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', $price; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Vat %20</td>
                                                    <td><?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', $vat; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Payable</td>
                                                    <td><?php echo ($row->category->currency->content!='') ? $row->category->currency->content : '$', ($price + $vat); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="order-completed-box">
                                        <?php if($row->booking_status == 1): ?>
                                        <div class="order-tick-sign"><i class="fa fa-check" aria-hidden="true"></i></div>
                                        <div class="order-completed-text">Order Completed</div>
                                        <?php else: ?>
                                        <div class="order-tick-sign"><i class="fa red-tick-icon-check fa-times" aria-hidden="true"></i></div>
                                        <div class="order-completed-text">Order Pending</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel-group booking-summary-acc-align" id="booking-summary2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="booking-link-style" data-toggle="collapse" data-parent="#booking-summary2" href="#booking-summary-tab2">View Booking Summary</a>
                                        </h4>
                                    </div>
                                    <div id="booking-summary-tab2" class="panel-collapse collapse">
                                        <div class="panel-body booking-summary-pannel">
                                            <div class="booking-summary-main-heading"><h2>Your Selected Preferences</h2></div>
                                            <div class="fields-align">
                                                <p> Have you already stayed in one of our rooms/suites?:<span>Yes</span></p>
                                                <p> Family Name:<span>{Family Name Here}</span></p>
                                            </div>
                                            <div class="fields-align">
                                                <p>Relationship:<span>Self</span></p>
                                            </div>
                                            <div class="fields-align">
                                                <h2>Purpose Of Stay</h2>
                                                <p>Purpose of your stay:<span>Others</span></p>
                                                <p>Do you want to provide us with further details regarding your stay?:<span>{Text Here}</span></p>
                                            </div>
                                            <div class="fields-align">
                                                <h2>DOUBLE DOUBLE preferences</h2>
                                                <p>Desired room temperature:<span>Warm</span></p>
                                                <p>Smoking preference:<span>value</span></p>
                                                <p>Rollaway bed<span>value</span></p>
                                                <p>Crib<span>value</span></p>
                                                <p> Wheelchair accessible:<span>value</span></p>
                                                <p> Generally I am size:<span>value</span></p>
                                            </div>
                                            <div class="fields-align">
                                                <h2>Bedding preferences</h2>
                                                <p>Pillow firmness:<span>Warm</span></p>
                                                <p>Pillow type:<span>value</span></p>
                                                <p>Bed style:<span>value</span></p>
                                                <p>Generally I sleep on the<span>value</span></p>
                                            </div>
                                            <div class="fields-align">
                                                <h2>Lifestyle preferences</h2>
                                                <h3 class="sub-heading">Cultural Interest</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Art</li>
                                                            <li>Nature</li>
                                                            <li>Architecture & Interior Design</li>
                                                            <li>Photography</li>
                                                            <li>Cigars</li>
                                                            <li>Science</li>
                                                            <li>Dance</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Art</li>
                                                            <li>Nature</li>
                                                            <li>Architecture & Interior Design</li>
                                                            <li>Photography</li>
                                                            <li>Cigars</li>
                                                            <li>Science</li>
                                                            <li>Dance</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p>Other, please specify:<span>Warm</span></p>
                                                <h3 class="sub-heading">Sports</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Snorkeling</li>
                                                            <li>Diving</li>
                                                            <li>Sailing</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Tennis</li>
                                                            <li>Golf</li>
                                                            <li>Motorized water sports</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h3 class="sub-heading">Wellbeing</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Spa treatments</li>
                                                            <li>Hair treatments</li>
                                                            <li>Fitness</li>
                                                            <li>Pool</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Yoga</li>
                                                            <li>Pilates</li>
                                                            <li>Meditation</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p>I would prefer my in-room language settings to be:<span>Warm</span></p>
                                            </div>
                                            <div class="fields-align">
                                                <h2>Eating & Drinking preferences</h2>
                                                <h3 class="sub-heading">Dietary regime</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Vegetarian</li>
                                                            <li>Halal</li>
                                                            <li>Kosher</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Gluten-free</li>
                                                            <li>Ovo-lactarian</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p>Favourite dishes:<span>Value</span></p>
                                                <p>Food allergies:<span>Value</span></p>
                                                <p>Known allergies:<span>Value</span></p>
                                                <h3 class="sub-heading">Snacks</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Savory snacks</li>
                                                            <li>Any sweet snacks</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Chocolate based pastries</li>
                                                            <li>Fruit based pastries</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h3 class="sub-heading">Hot beverages</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Espresso</li>
                                                            <li>Cafe au Lait</li>
                                                            <li>Tea</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Herbal tea</li>
                                                            <li>Hot chocolate</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h3 class="sub-heading">Sodas</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Coca</li>
                                                            <li>Diet Coke</li>
                                                            <li>Pepsi</li>
                                                            <li>Diet Pepsi</li>
                                                            <li>Still Water </li>   
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul>
                                                            <li>Orange Soda</li>
                                                            <li>Lemon Soda</li>
                                                            <li>Served with lemon</li>
                                                            <li>Served with ice cubes</li>
                                                            <li>Sparkling Water</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p> Preferred aperitif: Value Other remarks for our upcoming visit:<span>Value</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="personized-booking-sec">
                                <div class="col-md-12 col-sm-12">
                                    <h2 class="personlized-heading">Get Personalized Service</h2>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a class="personized-booking-links" href="http://design-locations.biz/book-property/miss-clara-by-nobis?property=105&roomType=&arrive=27.05.2017&destination=&booking_adults=1&booking_children=0">Book Again</a>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a class="personized-booking-links" href="http://design-locations.biz/our-collection/miss-clara-by-nobis">Contact Hotel</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $index++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="booking-res-mob-menu-align">
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="row">
                <div class="dashboard-page-right-nav-align">
                    <nav class="navbar navbar-inverse dashboard-left-main-nav-outer-align">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dashboard-navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>                        
                            </button>
                        </div>
                        <div class="collapse navbar-collapse dashboard-navigation-style right-menu-align" id="dashboard-navigation">
                            <ul class="nav navbar-nav dashboard-menu-align">
                                <li class="list-box disabled-box">
                                    Automatic Confirmation
                                    <div class="disabled-btn">Disabled</div>
                                </li>
                                <li><a class="active" href="#"><span class="list-menu-style"><i class="fa fa-plus" aria-hidden="true"></i></span>New Booking</a></li>
                                <li><a href="#"><span class="list-menu-style"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>Order History</a></li>
                                <li><a href="#"><span class="list-menu-style"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Bookings</a></li>
                                <li><a href="#"><span class="list-menu-style"><i class="fa fa-ban" aria-hidden="true"></i></span>Canceled</a></li>
                                <li><a href="#"><span class="list-menu-style"><i class="fa fa-history" aria-hidden="true"></i></span>History</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $(".hide-btn").click(function () {
            $('.history-sec-show-hide').toggle(function () {
                $(".right-main-profile-show").toggleClass("expanded-div");
            });
        });
    });
</script>
@endsection
