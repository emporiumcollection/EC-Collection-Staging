@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Hotel Details
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
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Reservation & Distribution </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Properties </span> 
        </a> 
    </li>
@stop

@section('content')
  
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        @if(!empty($pageslider))
        <div id="Carousel" class="carousel slide">
             
            <ol class="carousel-indicators">
                @foreach($pageslider as $key => $slider_row)
                <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                @endforeach
            </ol>
             
            <!-- Carousel items -->
            <div class="carousel-inner">
            @foreach($pageslider as $key => $slider_row)    
            <div class="item {{($key == 0)? 'active' : ''}}">
            	<div class="row">
            	  <div class="col-md-12">
                    <a href="{{$slider_row->slider_link}}" class="thumbnail">                            
                        <div class="b2c-banner-text">{{$slider_row->slider_title}}</div>
                        <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}" style="max-width:100%;" />
                    </a>
                  </div>                	  
            	</div><!--.row-->
            </div><!--.item-->
            @endforeach 
             
            </div><!--.carousel-inner-->
            <a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
            <a data-slide="next" href="#Carousel" class="right carousel-control">></a>
        </div><!--.Carousel-->
        @endif
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center padding-30">
        Welcome yo Your Hotel PMS
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
    </div>
        {{--*/ $is_commission_popup = false; $hotelWiseContracts = array(); /*--}}
        @foreach ($rowData as $row)
            {{--*/
            $comcontract = array();
            if(isset($hotels_commission_contracts[$row->id])){ $comcontract = $hotels_commission_contracts[$row->id]; }
            elseif(count($common_commission_contract) > 0){ $comcontract = $common_commission_contract; }
            
            $acceptedHotelContracts = array();
            if(isset($userContracts[$row->id])){ $acceptedHotelContracts = $userContracts[$row->id]; }
            
            $hotelcontract = array();
            $fhotelcontract = array();
            $hcontract_ids = array();
            if(isset($hotels_contracts[$row->id])){ $fhotelcontract = $hotels_contracts[$row->id]; }
            $fhotelcontract = array_merge($fhotelcontract,$common_contracts);
            foreach($fhotelcontract as $tkey=>$shotelcontrat){
                if(!isset($acceptedHotelContracts[$shotelcontrat->contract_id])){
                    $hotelcontract[$tkey] = $shotelcontrat;
                    $hcontract_ids[] = $shotelcontrat->contract_id;
                }
            }
            /*--}}
            
            @if((count($hotelcontract) > 0))
            {{--*/ $hotelWiseContracts[$row->id] = array('hotel_name'=>$row->property_name,'contracts'=>$hotelcontract); /*--}}
            <!--start:: hotel contracts alert -->
            <div class="col-md-12 col-xs-12">
                <div class="m-alert m-alert--icon m-alert--outline alert alert-danger" role="alert">
                    <div class="m-alert__icon"><i class="la la-warning"></i></div>
                    <div class="m-alert__text"><strong>{{$row->property_name}}'s Contracts!</strong> Some contracts are pending for acceptance!</div>
                    <div class="m-alert__actions">
                        <button type="button" class="btn btn-danger btn-sm m-btn m-btn--pill m-btn--wide" data-toggle="modal" data-target="#contract_model_{{$row->id}}">View All</button>
                        <button type="button" class="btn btn-danger btn-sm m-btn m-btn--pill m-btn--wide acceptcontractbtn" data-id="{{$row->id}}" data-contract-ids="{{implode(',',$hcontract_ids)}}">Accept All</button>
                    </div>
                </div>
            </div>
            <!--end:: hotel contracts alert -->
            @endif
            
            <div class="col-md-12 col-xs-12 m--align-center"> 
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 padding-30"><a href="#" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Setup Documentation</a></div>
            </div>
            
            <div class="col-md-12 col-xs-12">                    
                    @if((count($comcontract) > 0) && (!isset($commission_contracts[$row->id])))
                    {{--*/ $is_commission_popup = true; /*--}}
                    <!--start:: contracts popup -->
                    <?php /* <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--rounded-force commission-popup-main-div">
                        <div class="m-portlet col-sm-8 col-lg-8 inner-r-div">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title"><h3 class="m-portlet__head-text">{{$comcontract->title}}</h3></div>
                                </div>
                            </div>
                            
                            <div class="m-portlet__body">
                                <div class="m-scrollable m-scroller ps ps--active-y" data-scrollable="true" data-height="200" data-scrollbar-shown="true" style="height: 200px; overflow: hidden;">
                                    <?php echo $comcontract->description; ?>                                   
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                                    <div class="ps__rail-y" style="top: 0px; height: 200px; right: 4px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 87px;"></div></div>
                                </div>
                            </div>
                            
                            <div class="m-portlet__foot">
								<div class="row align-items-center">
									<div class="col-lg-12 m--align-right">
                                        <div class="m-form__group form-group">
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--bold m-radio--state-brand">
                                                    <input type="radio" name="commission_type" value="full" /> Full ({{(float) $comcontract->full_availability_commission}}%)
                                                    <span></span>
                                                </label>
                                                
                                                <label class="m-radio m-radio--bold m-radio--state-brand">
                                                    <input type="radio" name="commission_type" value="partial" /> Partial ({{(float) $comcontract->partial_availability_commission}}%)
                                                    <span></span>
                                                </label>
                                                
                                                <button type="submit" class="btn btn-success accept-btn" data-id="{{$row->id}}" data-contract-id="{{$comcontract->contract_id}}">Accept</button>
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
                        </div>
                    </div> */ ?>
                    <!--end:: contracts popup start -->
                    @endif
                    
                    <!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<span class="m-switch m-switch--outline m-switch--success switch-btn-bot-pad">
    									<label>
    										<input type="checkbox" name="switch_property" id="switch_property" />
    										<span></span>
    									</label>
    								</span>                                    
								</div>
							</div>
                            <div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
										<a href="{{ URL::to('properties/show/'.$row->id.'?return='.$return)}}" title="View Online" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
											<i class="fa fa-globe m--font-light"></i>
										</a>
										
									</li>
								</ul>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
										<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
											<i class="fa fa-bars m--font-light"></i>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="m-nav">
															<li class="m-nav__section m-nav__section--first">
																<span class="m-nav__section-text">
																	Quick Actions
																</span>
															</li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties/update/'.$row->id.'?return='.$return) }}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Hotel/Property
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/types')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Room Types
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/rooms')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Rooms
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/seasons')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Seasons
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/calendar')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Calender
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/price')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Price
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_documents')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Property Documents
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/property_images')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Images
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="{{ URL::to('properties_settings/'.$row->id.'/gallery_images')}}" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Galleries
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="#" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Become Featured
																	</span>
																</a>
														    </li> 
                                                            <li class="m-nav__item">
																<a href="#" class="m-nav__link">
																	<i class="m-nav__link-icon"></i>
																	<span class="m-nav__link-text">
																		Get Help
																	</span>
																</a>
														    </li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="m-widget17">
								<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
									<div class="m-widget17__chart" style="height:360px;">
                                        
                                        <div class="" style="background: url(http://staging.emporium-voyage.com/uploads/container_user_files/locations/hh/property-images/64070036634-63502574132.jpeg); width: 100%; background-size: cover; height:300px; opacity: 50%;">
                                        <div class="hotel_name">
                                            {{$row->property_name}}
                                        </div>
                                        </div>								
									</div>
								</div>
								<div class="m-widget17__stats">
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											    <a href="{{ URL::to('properties/update/'.$row->id.'?return='.$return) }}">																	
                                        			<span class="m-nav__link-text">
                                        				Hotel/Property
                                        			</span>
                                        		</a>
                                                 <br />
                                                <div style="margin-top: 20px; font-size: 15px;">Start here</div>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="{{ URL::to('properties_settings/'.$row->id.'/property_documents')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Property Documents
                                        			</span>
                                        		</a>
											</span>
											
										</div>
									</div>
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="{{ URL::to('properties_settings/'.$row->id.'/types')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Room Types
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="{{ URL::to('properties_settings/'.$row->id.'/property_images')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Images
                                        			</span>
                                        		</a>
											</span>
											
										</div>
									</div>
                                    <div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/rooms')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Rooms
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/gallery_images')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Galleries
                                        			</span>
                                        		</a>	
											</span>
											
										</div>
									</div>
                                    <div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/seasons')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Seasons
                                        			</span>
                                        		</a>
											</span>
											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="#">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Become Featured
                                        			</span>
                                        		</a>
											</span>											
										</div>
									</div>
                                    <div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
											     <a href="{{ URL::to('properties_settings/'.$row->id.'/price')}}">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Price
                                        			</span>
                                        		</a>
											</span>											
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												
											</span>
											<span class="m-widget17__subtitle">
												<a href="#" class="m-nav__link">
                                        			<i class="m-nav__link-icon"></i>
                                        			<span class="m-nav__link-text">
                                        				Get Help
                                        			</span>
                                        		</a>
											</span>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Activity-->
            </div>
        @endforeach
        
</div>

@foreach($hotelWiseContracts as $key=>$siHotelContract)
{{--*/ $hotelName =  $siHotelContract["hotel_name"]; $hotelContracts =  $siHotelContract["contracts"]; /*--}}
<div class="modal fade" id="contract_model_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel{{$key}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" data-id="{{$key}}">
            <div class="modal-header">
                <h5 class="modal-title" id="contractModalLabel{{$key}}">{{$hotelName}}'s Contracts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            
            <div class="modal-body">
                <div class="m-portlet__body">
                    <div class="m-accordion m-accordion--default m-accordion--solid" id="contract_accordion{{$key}}" role="tablist">
                        <!-- new contracts start -->
                        @foreach($hotelContracts as $si_contract)
                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$key}}_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$key}}_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                    <span class="m-accordion__item-icon"><i class="fa flaticon-list-3"></i></span>
                                    <span class="m-accordion__item-title">{{$si_contract->title}} <a href="#" class="si_accept_contract text-success"><i class="r-icon-tag la la-unlock"></i></a></span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>
                                
                                <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$key}}_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$key}}_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion{{$key}}">
                                    <div class="m-accordion__item-content">
                                        <?php echo $si_contract->description; ?>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- new contracts end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <style type="text/css">
        .box-property{
            background-color: #fff; padding: 10px; margin: 10px 20px; text-align: center; font-size: 15px;
        }
        .m-pertlet_head-switch-btn{
            vertical-align: middle;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-line-pack: start;
            align-content: flex-start;
        }
        .switch-btn-bot-pad label{
            margin-bottom: 0px;
        }
        .m-widget17 .m-widget17__visual .m-widget17__chart{
            padding-top: 5rem;
        }
        .hotel_name{
            position: relative;
            color: #000;
            background: #fff;
            /* width: 50%; */
            text-align: center;
            margin: 0px auto;
            /* padding-top: 50px; */
            /* margin-top: 50px; */
            font-size: 25px;
            opacity: 0.6;
        }
        .m-widget17 .m-widget17__stats .m-widget17__items.m-widget17__items-col1{
            width: 20% !important;
        }
        .m-widget17 .m-widget17__stats .m-widget17__items .m-widget17__item{
            height: 9em;
        }
        .m-widget17 .m-widget17__stats .m-widget17__items .m-widget17__item .m-widget17__subtitle{
            text-align: center;
            margin-left: 0px;
        }
        .commission-popup-main-div{ background-color: rgba(0, 0, 0, 0.5); position: absolute; z-index: 2; left: 0; right: 0; }
        .commission-popup-main-div .inner-r-div{ margin: 10% auto; }
    </style>
@endsection
@section('custom_js_script')
<script>
$(document).ready(function () {
    
    $(".acceptcontractbtn").click(function(e){
        e.preventDefault();
        var btnObj = $(this);
        //loader start
        btnObj.prop('disabled',true);
        btnObj.html('Processing...');
        btnObj.addClass('m-loader m-loader--light m-loader--right');
        //End
        var hotelId = btnObj.data('id');
        var contractId = btnObj.data('contract-ids');
        
        var fdata = new FormData();
            fdata.append("hotel_id",hotelId);
            fdata.append("contract_id",contractId);
            
        $.ajax({
            type:"POST",
            url:"{{URL::to('properties/savehotelcontract')}}",
            dataType:'json',
            contentType: false,
            processData: false,
            data:fdata,                
            success: function(response){
                if(response.status == 'success'){
                    toastr.success(response.message);
                    btnObj.closest(".m-alert").parent().hide();
                }
                else{
                    if((typeof response.errors) != 'undefined'){
                        $.each(response.errors,function(index, value){
                            toastr.error(value);
                        });
                    }
                    
                    //loader start
                    btnObj.prop('disabled',false);
                    btnObj.html('Accept All');
                    btnObj.removeClass('m-loader m-loader--light m-loader--right');
                    //End                                                
                }
            },
            error: function(e){
                //loader start
                btnObj.prop('disabled',false);
                btnObj.html('Accept All');
                btnObj.removeClass('m-loader m-loader--light m-loader--right');
                //End
                toastr.error("Unexpected error occurred!");
            }
        });
        
        return false;
    });
    
    @if($is_commission_popup === true)
    $(".accept-btn").click(function(e){
        e.preventDefault();
        var btnObj = $(this);
        //loader start
        btnObj.prop('disabled',true);
        btnObj.html('Processing...');
        btnObj.addClass('m-loader m-loader--light m-loader--right');
        //End
        var parentDiv = $(this).closest(".form-group");
        var ischeckedc = parentDiv.find('[name="commission_type"]').is(":checked");
        if(ischeckedc === true){
            var hotelId = btnObj.data('id');
            var contractId = btnObj.data('contract-id');
            var comType = parentDiv.find('[name="commission_type"]:checked').val();
            //console.log(hotelId+' : '+contractId+' : '+comType);
            var fdata = new FormData();
            fdata.append("hotel_id",hotelId);
            fdata.append("contract_id",contractId);
            fdata.append("commission_type",comType);
            $.ajax({
                type:"POST",
                url:"{{URL::to('properties/savecommissioncontract')}}",
                dataType:'json',
                contentType: false,
                processData: false,
                data:fdata,                
                success: function(response){
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        parentDiv.closest(".commission-popup-main-div").hide();
                    }
                    else{
                        if((typeof response.errors) != 'undefined'){
                            $.each(response.errors,function(index, value){
                                toastr.error(value);
                            });
                        }
                        
                        //loader start
                        btnObj.prop('disabled',false);
                        btnObj.html('Accept');
                        btnObj.removeClass('m-loader m-loader--light m-loader--right');
                        //End                                                
                    }
                },
                error: function(e){
                    //loader start
                    btnObj.prop('disabled',false);
                    btnObj.html('Accept');
                    btnObj.removeClass('m-loader m-loader--light m-loader--right');
                    //End
                    toastr.error("Unexpected error occurred!");
                }
            });
        }else{
            //loader start
            btnObj.prop('disabled',false);
            btnObj.html('Accept');
            btnObj.removeClass('m-loader m-loader--light m-loader--right');
            //End
            toastr.error("Please select hotel availablity!");
        }
        
        return false;
    });
    @endif
    
    $("#switch_property").click(function(){
      if($("#switch_property").is(":checked")){
        
      }else{
        
      }      
    });
});
function change_option(row,filed_name,row_id,act)
{
	if(row_id!='' && row_id>0)
	{
		$.ajax({
		  url: "{{ URL::to('enable_diable_propertystatus')}}",
		  type: "post",
		  data: 'filed_name='+filed_name+'&row_id='+row_id+'&action='+act,
		  success: function(data){
			if(data!='error')
			{
				if(act==1)
				{
					$(row).removeClass('btn-danger');
					$(row).addClass('btn-success');
					$(row).children( "i.fa" ).removeClass('fa-times');
					$(row).children( "i.fa" ).addClass('fa-check');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',0)");
					$(row).attr("title","Click to Disable");
					$(row).attr("data-original-title","Click to Disable");
				}
				else if(act==0)
				{	
					$(row).removeClass('btn-success');
					$(row).addClass('btn-danger');
					$(row).children( "i.fa" ).removeClass('fa-check');
					$(row).children( "i.fa" ).addClass('fa-times');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',1)");
					$(row).attr("title","Click to Enable");
					$(row).attr("data-original-title","Click to Enable");
				}
			}
		  }
		});
	}
}
</script>
@stop
