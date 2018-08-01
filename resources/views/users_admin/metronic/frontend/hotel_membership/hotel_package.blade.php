@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Packages <small>view</small>
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
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Membership &amp; Support Services </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Choose Your Package </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
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
    </div>
	<div class="row">
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
                            <a class="nav-link active" href="#sales_marketing" data-toggle="tab"> 
                                Sales & Marketing 
                            </a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="#reservation_distribution" data-toggle="tab"> 
                                Reservation & Distribution 
                            </a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="#advertising" data-toggle="tab"> 
                                Advertising
                            </a>
                        </li>			
    				</ul>
    				<div class="tab-content">
    					
                            <div class="tab-pane active" id="sales_marketing">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_sales_marketing" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}                                    
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Sales_Marketing")
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_sales_marketing_{{ $k }}_body" aria-expanded="    false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_sales_marketing_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-parent="#m_accordion_3_sales_marketing">
            								<div class="m-accordion__item-content">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                                            <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                                            <h4>Package Modules Include:</h4>
                                                            {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                                            {{--*/ $mod_arr = array(); /*--}}  
                                                            @foreach ($modulesOffered as $moduleRow)
                                                                {{--*/ $mod_arr[] = $moduleRow->module_name; /*--}}                                 
                                                                
                                                            @endforeach  
                                                            {{--*/ $str_module = implode(', ', $mod_arr); echo $str_module; /*--}}
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                    <h6>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="book-btn-sec">
                                                        
                                                        <div class="pull-right" style="margin: 5px;">
                                                            <div>
                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                      
                                                </div>
            								</div>
            							</div>
            						</div>
                                    @endif
                                    {{--*/ $k++; /*--}}
                                    @endforeach
            						<!--end::Item-->     
                                </div>
                            </div>
                            
                            
                            <div class="tab-pane" id="reservation_distribution">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_reservation_distribution" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Reservation_Distribution")
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_reservation_distribution_{{ $k }}_body" aria-expanded="    false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_reservation_distribution_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-parent="#m_accordion_3_reservation_distribution">
            								<div class="m-accordion__item-content">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                                            <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                                            <h4>Package Modules Include:</h4>
                                                            {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                                            {{--*/ $mod_arr = array(); /*--}}  
                                                            @foreach ($modulesOffered as $moduleRow)
                                                                {{--*/ $mod_arr[] = $moduleRow->module_name; /*--}}                                 
                                                                
                                                            @endforeach  
                                                            {{--*/ $str_module = implode(', ', $mod_arr); echo $str_module; /*--}}
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                    <h6>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="book-btn-sec">
                                                        
                                                        <div class="pull-right" style="margin: 5px;">
                                                            <div>
                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                      
                                                </div>
            								</div>
            							</div>
            						</div>
                                    @endif
                                    {{--*/ $k++; /*--}}
                                    @endforeach
            						<!--end::Item-->     
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="advertising">
                                <!--begin::Section-->
            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_advertising" role="tablist">
            						<!--begin::Item-->
                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                    @foreach($packages as $key=>$package)
                                    @if($package->package_category=="Advertising")
            						<div class="m-accordion__item">
            							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_advertising_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_advertising_{{ $k }}_body" aria-expanded="    false">
            								<span class="m-accordion__item-icon">
            									<i class="fa flaticon-user-ok"></i>
            								</span>
            								<span class="m-accordion__item-title">
            									{{$package->package_title}} Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
            								</span>
            								<span class="m-accordion__item-mode"></span>
            							</div>
            							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_advertising_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_advertising_{{ $k }}_head" data-parent="#m_accordion_3_advertising">
            								<div class="m-accordion__item-content">
            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                </div>
                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                    <div class="row">
                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                            <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                                            <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                                            <h4>Package Modules Include:</h4>
                                                            {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                                            {{--*/ $mod_arr = array(); /*--}}  
                                                            @foreach ($modulesOffered as $moduleRow)
                                                                {{--*/ $mod_arr[] = $moduleRow->module_name; /*--}}                                 
                                                                
                                                            @endforeach  
                                                            {{--*/ $str_module = implode(', ', $mod_arr); echo $str_module; /*--}}
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                    <h6>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="book-btn-sec">
                                                        
                                                        <div class="pull-right" style="margin: 5px;">
                                                            <div>
                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                      
                                                </div>
            								</div>
            							</div>
            						</div>
                                    @endif
                                    {{--*/ $k++; /*--}}
                                    @endforeach
            						<!--end::Item-->     
                                </div>
                            </div>
                            
                            
                            
                            
                        
					

					</div>
					<!--end::Section-->
                    <div class="m--clearfix"></div>
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">  
                                <div class="col-lg-12 m--align-right">                     						
                                    <a href="{{url('hotel/cart')}}" class="btn btn-success pull-right">Continue</a>		
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
@stop
{{-- For custom script --}}
@section('custom_js_script')
    @parent
<script>
    function addToCartHotel(PackageID,PackagePrice){
        var PackagePrice=PackagePrice;
        var PackageID=PackageID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                toastr.success("Package added to cart successfully.");
                //alert("Package added to cart successfully.");
            }
        };
        xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
        xhttp.send();
    }
</script>    
@endsection