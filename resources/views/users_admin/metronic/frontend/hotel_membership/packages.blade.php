@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
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
        <a href="{{ URL::to('hotelpackages')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Membership &amp; Support Services </span> 
        </a> 
    </li>
@stop

@section('content')
    <?php /* <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="main-heading">{{ Lang::get('core.user_packages_heading')}}</h3>
        </div>
    </div>  
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
               <div class="m-alert__icon">
                    <i class="flaticon-exclamation-1"></i>
                    <span></span>
               </div>
               <div class="m-alert__text">                
                    {{ Lang::get('core.user_packages_info')}}
               </div>
            </div>
        </div>
    </div> */ ?>
	<div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Membership &amp; Support Services</h2>
        </div> 
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
            This department is responsible for the membership development engagement, quality compliance and the measurement of key performance indicators. This department also supports contract administration & agreement renewal.
            <br /><br />
The membership development team develops and implements a strategic, regional-based acquisition plan to secure new member hotels/luxury partners and enhance the overall Emporium brand presence. The group actively solicits leads, collaborates with sales offices to evaluate potential new members, and conduct detailed analysis on each hotel applicant before submitting to the executive committee for approval. The objective is to establish mutually beneficial and long-term partnership with our member hotels.
        </div>
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
            <hr />
        </div> 
        <div class="col-md-12 col-xs-12">
       	    <div class="m-portlet m-portlet--full-height">
				<!--<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Choose Your Package
							</h3>
						</div>
					</div>
				</div> -->
				<div class="m-portlet__body">
                    <ul class="nav nav-tabs" role="tablist">
                        
                        <li class="nav-item"> 
                            <a class="nav-link active" href="#membership" data-toggle="tab"> 
                                Membership 
                            </a>
                        </li>
    					<li class="nav-item"> 
                            <a class="nav-link" href="#reservation_distribution" data-toggle="tab"> 
                                Reservation & Distribution 
                            </a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="#sales_marketing" data-toggle="tab"> 
                                Sales & Marketing 
                            </a>
                        </li>                                                                        
                        <li class="nav-item"> 
                            <a class="nav-link" href="#advertising" data-toggle="tab"> 
                                Advertising
                            </a>
                        </li>
    							
    				</ul>
    				<div class="tab-content">
    					    
                            <div class="tab-pane active" id="membership">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_membership" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                    {{--*/ $m=0; /*--}}
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Membership")
                                    
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head <?php echo ($m==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_membership_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_membership_{{ $k }}_body" aria-expanded="    false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} 
                                                @if($package->package_price_type!=1)
                                                    Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                @else
                                                    Price: Price on Request
                                                @endif
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body <?php echo ($m==0) ? 'show' : 'collapse' ?>" id="m_accordion_3_item_membership_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_membership_{{ $k }}_head" data-parent="#m_accordion_3_membership">
            								<div class="m-accordion__item-content">
                                            <div class="row">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                @if($package->package_image!='')
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                @endif
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                @if($package->package_price_type!=1)  
                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                @else
                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                
                                                      
                                                </div>
                                            </div>
                                            
                                            <div class="row" style="margin-top: 10px;">
                                                                                                                                                         
                                                <div class="col-lg-12 m--align-right">
                                                    <div>
                                                    <?php if(in_array($package->id, $order_items)){ ?>
                                                            <a href="{{URL::to('hotelinvoices')}}" class="btn btn-success">View Invoice</a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price_type==1 ? -1 : $package->package_price }});" class="btn btn-success" id="add_to_{{$package->id}}">Add to cart</a>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                               
                                            </div> 
                                               
            								</div>
            							</div>
            						</div>
                                    {{--*/ $m++;  /*--}}
                                    @endif
                                    {{--*/ $k++;  /*--}}
                                    @endforeach
            						<!--end::Item-->
                                    @if($m==0)
                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                        <p>Currently no packages in this section.</p>
                                    </div>
                                    @endif 
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="reservation_distribution">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_reservation_distribution" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                    {{--*/ $sn=0; /*--}}
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Reservation_Distribution")
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head <?php echo ($sn==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_reservation_distribution_{{ $k }}_body" aria-expanded="    false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} 
                                                @if($package->package_price_type!=1)  
                                                Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                @else
                                                    Price: Price on Request
                                                @endif
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body <?php echo ($sn==0) ? 'show' : 'collapse' ?>" id="m_accordion_3_item_reservation_distribution_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-parent="#m_accordion_3_reservation_distribution">
            								<div class="m-accordion__item-content">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                @if($package->package_price_type!=1)  
                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                @else
                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row" style="padding: 10px;">
                                                        
                                                        <div class="col-lg-12 m--align-right">
                                                            <div>
                                                            <?php if(in_array($package->id, $order_items)){ ?>
                                                                    <a href="{{URL::to('hotelinvoices')}}" class="btn btn-success">View Invoice</a>
                                                            <?php }else{ ?>
                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                      
                                                </div>
            								</div>
            							</div>
            						</div>
                                        {{--*/ $sn++;  /*--}}
                                    @endif
                                    {{--*/ $k++; /*--}}
                                    @endforeach
            						<!--end::Item-->
                                    @if($sn==0)
                                        <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                            <p>Currently no packages in this section.</p>
                                        </div>
                                    @endif       
                                </div>
                            </div>
                            
                            <div class="tab-pane " id="sales_marketing">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_sales_marketing" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}} 
                                    {{--*/ $kn=0; /*--}}                                   
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Sales_Marketing")
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head <?php echo $kn==0 ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_sales_marketing_{{ $k }}_body" aria-expanded="    false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} 
                                                @if($package->package_price_type!=1)
                                                    Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                @else
                                                    Price: Price on Request
                                                @endif
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body <?php echo $kn==0 ? 'show' : 'collapse' ?>" id="m_accordion_3_item_sales_marketing_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-parent="#m_accordion_3_sales_marketing">
            								<div class="m-accordion__item-content">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                @if($package->package_price_type!=1)  
                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                @else
                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row" style="padding: 10px;">
                                                        
                                                        @if(isset($package_contracts[$package->id]))                                                        
                                                            @if(count($package_contracts[$package->id]) > 0)
                                                            <div class="col-lg-12 m--align-right">
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-12 m-form__group-sub">
                                                                        <div class="m-checkbox-inline">
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                                                <input type="checkbox" class="rcheckboxinput" name="package_checkboxes_{{$package->id}}" value="1" required="required" data-model-id="contract_model_{{$package->id}}" /> Please accept contracts first.<span></span>
                                                                            </label>
                                                                        </div>
                                                                        <span class="m-form__help"><a href="#" onclick="javascript: return false;" data-toggle="modal" data-target="#contract_model_{{$package->id}}" class="btn btn-primary pull-right">View contracts</a></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif 
                                                        @endif 
                                
                                                        <div class="col-lg-12 m--align-right">
                                                            <div>
                                                                <?php if(in_array($package->id, $order_items)){ ?>
                                                                        <a href="{{URL::to('hotelinvoices')}}" class="btn btn-success">View Invoice</a>
                                                                <?php }else{ ?>
                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                      
                                                </div>
            								</div>
            							</div>
            						</div>
                                        {{--*/ $kn++; /*--}}
                                    @endif
                                    {{--*/ $k++; /*--}}
                                    @endforeach
                                    @if($kn==0)
                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                        <p>Currently no packages in this section.</p>
                                    </div>
                                    @endif  
            						<!--end::Item-->     
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="advertising">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_advertising" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                    {{--*/ $yn=0; /*--}}
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Advertising")
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head <?php echo ($yn==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_advertising_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_advertising_{{ $k }}_body" aria-expanded="false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} 
                                                @if($package->package_price_type!=1)
                                                    Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                @else
                                                    Price: Price on Request
                                                @endif
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body <?php echo ($yn==0) ? 'show' : 'collapse' ?>" id="m_accordion_3_item_advertising_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_advertising_{{ $k }}_head" data-parent="#m_accordion_3_advertising">
            								<div class="m-accordion__item-content">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                @if($package->package_price_type!=1)  
                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                @else
                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row" style="padding: 10px;">
                                                        
                                                        <div class="col-lg-12 m--align-right">
                                                            <div>
                                                            <?php if(in_array($package->id, $order_items)){ ?>
                                                                    <a href="{{URL::to('hotelinvoices')}}" class="btn btn-success">View Invoice</a>
                                                            <?php }else{ ?>    
                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                      
                                                </div>
            								</div>
            							</div>
            						</div>
                                        {{--*/ $yn++; /*--}}
                                    @endif
                                    {{--*/ $k++; /*--}}
                                    @endforeach
            						<!--end::Item-->   
                                    @if($yn==0)
                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                        <p>Currently no packages in this section.</p>
                                    </div>
                                    @endif    
                                </div>
                            </div>

					</div>
					<!--end::Section-->
                    <div class="m--clearfix"></div>
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row"> 
                                @if(count($common_contracts) > 0)
                                <div class="col-lg-12 m--align-right">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12 m-form__group-sub">
                                            <div class="m-checkbox-inline">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                    <input type="checkbox" class="rcheckboxinput" name="package_checkboxes_common" value="1" required="required" data-model-id="common_contract_model" /> Please accept contracts first.<span></span>
                                                </label>
                                            </div>
                                            <span class="m-form__help"><a href="#" onclick="javascript: return false;" data-toggle="modal" data-target="#common_contract_model" class="btn btn-primary pull-right">View contracts</a></span>
                                        </div>
                                    </div>
                                </div>
                                @endif 
                                
                                <div class="col-lg-12 m--align-right">                     						
                                    <a href="{{url('hotel/cart')}}" id="continue_btn" class="btn btn-success pull-right">Continue</a>		
                                </div>
                            </div>
                        </div>
                    </div>
                    
				</div>
                <div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions">							
                        						
					</div>
				</div>
			</div>
        </div>
    </div>
    
    @if(count($package_contracts) > 0)
        @foreach($package_contracts as $p_key=>$si_package_contract)
            <div class="modal fade" id="contract_model_{{$p_key}}" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel{{$p_key}}" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" data-id="{{$p_key}}">
                        <div class="modal-header">
            				<h5 class="modal-title" id="contractModalLabel{{$p_key}}">
            					Contracts
            				</h5>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true">
            						×
            					</span>
            				</button>
            			</div>
                        
                        <div class="modal-body">
                            <div class="m-portlet__body">
                                <div class="m-accordion m-accordion--default m-accordion--solid" id="contract_accordion{{$p_key}}" role="tablist">
                                    <!-- new contracts start -->
                                    @foreach($si_package_contract as $si_contract)
                                        <?php /*@if(!isset($userContracts[$si_contract->contract_id]))*/ ?>
                                            
                                        <div class="m-accordion__item">
                                            <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$p_key}}_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$p_key}}_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                                <span class="m-accordion__item-icon"><i class="fa flaticon-list-3"></i></span>
                                                <span class="m-accordion__item-title">{{$si_contract->title}} <a href="#" class="si_accept_contract text-danger"><i class="r-icon-tag la la-unlock-alt"></i></a></span>
                                                <span class="m-accordion__item-mode"></span>
                                            </div>
                                            
                                            <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$p_key}}_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$p_key}}_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion{{$p_key}}">
                                                <div class="m-accordion__item-content">
                                                    <?php echo $si_contract->description; ?>
                                                </div>
                                            </div>
                                        </div>    
                                        <?php /*@endif */ ?>
                                    @endforeach
                                    <!-- new contracts end -->
                                </div>
                            </div>
                        </div>
                        
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary contractclosebtn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary contractacceptbtn">Accept</button>
            			</div>
                    </div>                        
                </div>
            </div>
        @endforeach
    @endif
    
    {{--*/ $new_contract_ava = false; /*--}}
    @if((count($common_contracts) > 0))
    <div class="modal fade" id="common_contract_model" tabindex="-1" role="dialog" aria-labelledby="commonContractModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content" data-id="common">
    			<div class="modal-header">
    				<h5 class="modal-title" id="commonContractModalLabel">
    					Common Contracts
    				</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        {{--<div class="m-portlet__head"></div>--}}
                        
                        <div class="m-portlet__body">
                            <div class="m-accordion m-accordion--default m-accordion--solid" id="contract_accordion" role="tablist">
                                <!-- already accepted contracts start -->
                               <?php /* @foreach($userContracts as $si_contract)
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa flaticon-list-3"></i></span>
                                            <span class="m-accordion__item-title">{{$si_contract->title}} <a href="#" class="si_accept_contract already_accepted text-success"><i class="r-icon-tag la la-unlock"></i></a></span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        
                                        <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion">
                                            <div class="m-accordion__item-content">
                                                <?php echo $si_contract->description; ?>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach */?>
                                <!-- already accepted contracts end -->
                                
                                <!-- new contracts start -->
                                @foreach($common_contracts as $si_contract)
                                    <?php /*@if(!isset($userContracts[$si_contract->contract_id]))*/ ?>
                                        {{--*/ $new_contract_ava = true; /*--}}
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa flaticon-list-3"></i></span>
                                            <span class="m-accordion__item-title">{{$si_contract->title}} <a href="#" class="si_accept_contract text-danger"><i class="r-icon-tag la la-unlock-alt"></i></a></span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        
                                        <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion">
                                            <div class="m-accordion__item-content">
                                                <?php echo $si_contract->description; ?>
                                            </div>
                                        </div>
                                    </div>    
                                    <?php /*@endif */ ?>
                                @endforeach
                                <!-- new contracts end -->
                            </div>
                        </div>
                    </div>                				
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary contractclosebtn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary contractacceptbtn">Accept</button>
    			</div>
    		</div>
    	</div>
    </div>
    @endif
<!-- Price Request modal popup -->
    <div class="modal fade" id="priceonrequesr_modal" tabindex="-1" role="dialog" aria-labelledby="priceonrequestModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
                {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'priceonrequest_form' ,'files' => true)) !!}
    			<div class="modal-header">
    				<h5 class="modal-title" id="priceonrequestModalLabel">
    					Price On Request
    				</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">                        
                        <div class="m-portlet__body">
                        
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_firstname" class="form-control" placeholder="First name" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_lastname" class="form-control" placeholder="Last name" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_email" class="form-control" placeholder="Email" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_phoneumber" class="form-control" placeholder="Phone Number" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Message</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <textarea class="form-control" name="onrequest_message" id="onrequest_message" rows="4"></textarea>
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                    <div class="col-xl-9 col-lg-9">
                                        <div class="m-checkbox-inline">
            								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
            									<input type="checkbox" id="onrequest_agree" name="onrequest_agree" required="required" />      								
            									I agree that emporium-voyage consultant can connect me directly. 
                                                <span></span>
            								</label>
            							</div>
                                    </div> 
                                </div>
                            </div>
                                                 
                        </div>
                    </div>                				
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" id="contractclosebtn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
    			</div>
                {!! Form::close() !!} 
    		</div>
    	</div>
    </div>
    <!-- End Price Request modal popup -->    
@stop
{{-- For custom style  --}}
@section('style')
    <style>
        .m-content>div:nth-child(even) .row{
            background: none !important;
            padding: 10px 15px;
        }        
    </style>
@endsection

{{-- For custom script --}}
@section('custom_js_script')
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
    @parent
<script>
function removeAndAddIcons(thisObj,isAdd){
    if(isAdd === true){
        thisObj.removeClass('text-danger');
        thisObj.addClass('text-success');
        
        thisObj.find('.r-icon-tag').removeClass('la-unlock-alt');
        thisObj.find('.r-icon-tag').addClass('la-unlock');
    }else{
        thisObj.removeClass('text-success');
        thisObj.addClass('text-danger');
        
        thisObj.find('.r-icon-tag').removeClass('la-unlock');
        thisObj.find('.r-icon-tag').addClass('la-unlock-alt');
    }
}

$(document).ready(function(){ 
    $('#continue_btn').click(function(e){
        var inputexist = ((($('[name="package_checkboxes_common"]').val() != undefined) && ($('[name="package_checkboxes_common"]').val() != 'undefined'))?true:false); 
        
        if(inputexist === true){
            if($('[name="package_checkboxes_common"]').is(":checked") === false){ toastr.error("Please accept contracts before continue!"); return false; }
        }        
    });
    
    $('#priceonrequest_form').validate({
    	submitHandler: function (form) {
    		 $.ajax({
                url:"{{URL::to('priceonrequest')}}",
                type:'POST',
                dataType:'json',
                data:$(form).serializeArray(),                   
                success:function(response){
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        $("#priceonrequesr_modal").modal('hide'); 
                    }
                    else{
                        toastr.error(response.message);
                    }
                }
            });
    		return false;
    	}
    
    });
    
    $(".priceonrequest").click(function(){
       $("#priceonrequesr_modal").modal('show'); 
    });
    
    $('.rcheckboxinput').click(function(e){ 
        var modelId = $(this).data('model-id');
        if($(this).is(":checked") === false){
            $("#"+modelId).find(".si_accept_contract").not('.already_accepted').each(function(){
                removeAndAddIcons($(this),false);
            });
        }else{
            $("#"+modelId).find(".si_accept_contract").not('.already_accepted').each(function(){
                removeAndAddIcons($(this),true);
            });
        }
    });
    
    $(".si_accept_contract").click(function(e){
        e.preventDefault();
        var parent_model = $(this).closest('.modal-content');
        var pid = parent_model.data('id');
        if($(this).hasClass('text-danger')){ removeAndAddIcons($(this),true); }else{ removeAndAddIcons($(this),false); }
        
        
        var ischecked = true;
        parent_model.find(".si_accept_contract").each(function(){
            if($(this).hasClass('text-danger')){ ischecked = false; }
        });
        
        if(ischecked === true){            
            parent_model.find(".contractacceptbtn").trigger('click');
        }else
        {
            if($('[name="package_checkboxes_'+pid+'"]').is(":checked") === true){ $('[name="package_checkboxes_'+pid+'"]').closest('label').trigger('click'); }
        }
        
        return false;
    });
    
   $(".contractacceptbtn").click(function(e){
        e.preventDefault();
        var parent_model = $(this).closest('.modal-content');
        var pid = parent_model.data('id');
        parent_model.find(".si_accept_contract").each(function(){
            removeAndAddIcons($(this),true);
        });
        
        if($('[name="package_checkboxes_'+pid+'"]').is(":checked") === false){ $('[name="package_checkboxes_'+pid+'"]').closest('label').trigger('click'); }
        parent_model.find(".contractclosebtn").trigger('click');
        
        return false;
   });
});

    function addToCartHotel(PackageID,PackagePrice){
        var PackagePrice=PackagePrice;
        var PackageID=PackageID;
        
        var inputexist = ((($('[name="package_checkboxes_'+PackageID+'"]').val() != undefined) && ($('[name="package_checkboxes_'+PackageID+'"]').val() != 'undefined'))?true:false); 
        
        var ischecked = true;
        if(inputexist === true){
            if($('[name="package_checkboxes_'+PackageID+'"]').is(":checked") === false){ ischecked = false; }
        }
        
        if(ischecked === true){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    toastr.success("Package added to cart successfully.");
                    //alert("Package added to cart successfully.");
                }
            };
            xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
            xhttp.send();
        }else
        {
            toastr.error("Please accept package contract before add in cart!");
        }
            
    }
</script>    
@endsection