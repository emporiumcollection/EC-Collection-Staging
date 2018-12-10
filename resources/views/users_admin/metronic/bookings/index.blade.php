@extends('users_admin.metronic.layouts.app')

@section('page_name')
    My Reservations
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> My Reservations </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
        @foreach ($rowData as $row)
        {{--*/ 
            $arrival_day = '';
            $arrival_month = '';
            $arrival_year = '';
            $departure_day = '';
            $departure_month = '';
            $departure_year = '';
        /*--}}
            @if(!empty($row->checkin_date))
                {{--*/
                 
                    $arrival_day = date('j', strtotime($row->checkin_date));
                    $arrival_month = date('M', strtotime($row->checkin_date));
                    $arrival_year = date('Y', strtotime($row->checkin_date));
                    
                /*--}}
            @endif
             @if(!empty($row->checkout_date))
                {{--*/
                 
                    $departure_day = date('j', strtotime($row->checkout_date));
                    $departure_month = date('M', strtotime($row->checkout_date));
                    $departure_year = date('Y', strtotime($row->checkout_date));
                    
                /*--}}
            @endif
            {{--*/
                    $total_price = 0;
                    $reservation_price = $row->price; 
                    $reserved_rooms = $row->reserved_rooms;                           
                    if(!empty($reserved_rooms)){
                        foreach($reserved_rooms as $room){
                            $total_price += ($row->number_of_nights * $reservation_price);
                        }
                    }
                    
                    $room_type_id= $reserved_rooms[0]->type_id;
                    
                    $commission_due = $total_price * ($row->props->commission / 100);
                    $grand_total = $commission_due + $total_price;
                    
                    $img = $row->category_image->imgsrc.'/'.$row->category_image->file_name;
                    
                    $book_again = 'book-property/'.$row->props->property_slug.'?property='.$row->props->id.'&roomType='.$room_type_id.'&arrive=&departure=&booking_adults=1&booking_children=0';
                    
            /*--}}
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
        		
        		<div class="m-portlet__body">
        			<div class="m-widget28"> <?php //echo '<pre />'; print_r($rowData); ?>
        				<div class="m-widget28__pic m-portlet-fit--sides" style="background: url('{{$img}}'); background-size: cover;">
                            <div class="overlay"></div>
                        </div>
        				<div class="m-widget28__container">
        					<!-- begin::Nav pills -->
        					<ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Book Again</div>
        							<a class="nav-link a_white dash-res-view" href="{{Url::to($book_again)}}" >
        								View
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Arrival</div>
        							<a class="nav-link a_white" data-toggle="pill" href="#menu21">
        								<span class="day_size_big">{{$arrival_day}}</span> {{$arrival_month}} {{$arrival_year}}
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
                                    <div class="top-heading">Departure</div>
        							<a class="nav-link a_white" data-toggle="pill" href="#menu31">
        								<span class="day_size_big">{{$departure_day}}</span> {{$departure_month}} {{$departure_year}}
        							</a>
        						</li>
        					</ul>
        					<!-- end::Nav pills -->
                            
                             
                            <!-- begin::Tab Content -->                            
        					<div class="m-widget28__tab tab-content">
        						<div id="menu11" class="m-widget28__tab-container tab-pane active">
        							<div class="m-widget28__tab-items">                                        
        								<div class="m-widget28__tab-item">
        									<span>
        										Hotel Name
        									</span>
        									<span>
        										{{ $row->props->property_name }} / {{ $row->category->category_name }}
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Booking Confirmation Number
        									</span>
        									<span>
        										DL-<?php echo date('d.m.y', strtotime($row->created_date)); ?>-{{ $row->id }}
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Total Charges
        									</span>
        									<span>
        										&euro;{{ $grand_total }}
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Hotel Terms
        									</span>
        									<span>
        										<a href="#" data-toggle="modal" data-target="#hotel_term_popup"> Show hotel terms</a> 
        									</span>
                                            {{--*/ $url = 'traveller/bookings/show/'.$row->id; /*--}}
                                            <a href="{{Url::to($url)}}" id="show_more">View Reservation</a>
        								</div>
        							</div>
        						</div>
        					</div>                            
        					<!-- end::Tab Content -->
                            
                                    
            					
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        @endforeach
    </div>
    
    <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="hotel_term_popup" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="viewModalLabel">
    					Hotel Terms
    				</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        <ul>
                            <li>
                                I have read the <a href="{{Url::to('privacy-policy')}}">Privacy Policy</a>. <span class="font-italic">I agree that my personal data will be collected and stored electronically and used electronically to make this reservation with emporium-voyage and the respective partner hotel.</span>
                                <div class="m--clearfix"></div>
                                <span class="font-italic" style="clear: both;">Note: You may revoke your consent at any time by e-mail to <a href="mailto:info@emporium-voyage.com">info@emporium-voyage.com</a> or from your settings section in your account admin.</span>
                            </li>
                            <li>
                                <span class="font-italic">I agree to receive booking confirmations via email or phone and acknowledge that i can change my communication methods from my personal account preferences.</span>
                            </li>
                            <li>
                                <span class="font-italic">I agree to the emporium-voyage&trade;  <a href="{{Url::to('terms-and-conditions')}}">terms and conditions</a> pertaining to the reservation.</span>
                            </li>
                        </ul>
                    </div>                				
    			</div>
    			<div class="modal-footer">  
                    <button type="button" class="btn btn-secondary" id="viewclosebtn" data-dismiss="modal">Close</button>                    
    			</div>
    		</div>
    	</div>
    </div>    
    <!--end: modal pop up--> 

@stop

@section('custom_js_script')
    <script>
    $(document).ready(function () {

        $('.do-quick-search').click(function () {
            $('#SximoTable').attr('action', '{{ URL::to("bookings/multisearch")}}');
            $('#SximoTable').submit();
        });

    });
</script>		
@stop