@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
@stop

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
       	    <div class="m-portlet m-portlet--full-height">
            
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Your Packages
							</h3>
						</div>
					</div>
				</div>
                
				<div class="m-portlet__body">
                    
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <img src="{{URL::to('images/Emporium-Collection_21.jpg')}}" style="width: 100%;" />
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center padding-30">
                                    <h2 class="black-heading-big">Thank You</h2>
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                       
                                </div>  
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 pref-top-pad">
                                    Thank you for submitting your information.                                            
                                </div>
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <hr />        
                                </div>  
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 padding-30 m--align-center"><h2>Order Summary</h2></div>                                                                                                                            
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row padding-30">                                
                                        <div class="col-xs-3 col-sm-3 m--align-center">
                                            First Name: <?php echo $user->first_name; ?>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 m--align-center">
                                            Last Name: <?php echo $user->last_name; ?>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 m--align-center">
                                            E-mail: <?php echo $user->email; ?>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 m--align-center">
                                            Mobile No: <?php echo $user->mobile_number; ?>
                                        </div>
                                    </div>
                                    <div class="row padding-30 m--align-center" style="margin-right: 25px;">                                        
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center"><a href="{{ URL::to('userorderdownloadinvoicepdf/'.$order_id)}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Your Invoice</a></div>
                                        <!--<div class="col-xl-4 col-sm-4 col-md-4 col-lg-4"><a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Hotel-Implementation.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Hotel Requirements Sheet</a></div>
                                        <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4"><a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Property Information.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Property Requirements Sheet</a></div>-->
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 padding-30 m--align-center"><h2>Dashboard</h2></div> 
                        		<div class="col-sm-12 col-md-12 col-xl-12">
                                    
                                    <div class="row" style="margin-left: 0px;">
                                        <div class="setting-box-advert1">
                                            <a href="{{ URL::to('properties') }}">
                                                <i class="grid_icon flaticon-imac"></i>																	
                                    			<span class="grid_link-text">
                                    				Property Management
                                    			</span>
                                    		</a>
                                        </div>
                                        <div class="setting-box-advert2">
                                            <a href="{{ URL::to('reservations') }}">
                                                <i class="grid_icon flaticon-graphic-2"></i>																	
                                    			<span class="grid_link-text">
                                    				Reservation Management
                                    			</span>
                                    		</a>
                                        </div>
                                        <div class="setting-box-advert3">
                                            <a href="{{ URL::to('hotelcontainer')}}">
                                    			<i class="grid_icon flaticon-layers"></i>																	
                                    			<span class="grid_link-text">
                                    				Digital Media Management & Distribution System
                                    			</span>
                                    		</a>
                                        </div>
                                        <div class="setting-box-advert4">
                                            <a href="{{ URL::to('hotelpackages') }}" id="dash_communication">
                                    			<i class="grid_icon flaticon-share"></i>																	
                                    			<span class="grid_link-text">
                                    				Membership &amp; Support Services
                                    			</span>
                                    		</a>
                                        </div>
                                        
                                        
                                        <div class="setting-box-advert5">
                                            <a href="{{URL::to('arrivaldeparture')}}">
                                                <i class="grid_icon flaticon-clock-2"></i>																	
                                    			<span class="grid_link-text">
                                    				Arrivals, Departures &amp; Cancelations
                                    			</span>
                                    		</a>
                                        </div>
                                        <div class="setting-box-advert6">
                                            <a href="{{URL::to('advertising')}}">
                                                <i class="grid_icon flaticon-statistics"></i>																	
                                    			<span class="grid_link-text">
                                    				Advertising
                                    			</span>
                                    		</a>
                                        </div>
                                        <div class="setting-box-advert7">
                                            <a href="{{URL::to('salesreport')}}">
                                    			<i class="grid_icon flaticon-graph"></i>																	
                                    			<span class="grid_link-text">
                                    				Sales Reports
                                    			</span>
                                    		</a>
                                        </div>
                                        <div class="setting-box-advert8">
                                            <a href="{{URL::to('qualityassurances')}}" id="dash_communication">
                                    			<i class="grid_icon flaticon-pie-chart"></i>																	
                                    			<span class="grid_link-text">
                                    				Quality Assurance
                                    			</span>
                                    		</a>
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
@endsection