@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Account  <small>Enter Your Info</small>
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
            <span class="m-nav__link-text"> Choose Packages </span> 
        </a> 
    </li>
@stop

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
       	    <div class="m-portlet m-portlet--full-height">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Choose Your Package
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
					<!--begin::Section-->
					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3" role="tablist">
						<!--begin::Item-->
                        {{--*/ $k=1; $tottyp = count($packages); /*--}}
                        @foreach($packages as $key=>$package)
						<div class="m-accordion__item">
							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_{{ $k }}_body" aria-expanded="    false">
								<span class="m-accordion__item-icon">
									<i class="fa flaticon-user-ok"></i>
								</span>
								<span class="m-accordion__item-title">
									{{$package->package_title}}  :: {{ $package->id }} :: Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
								</span>
								<span class="m-accordion__item-mode"></span>
							</div>
							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_{{ $k }}_head" data-parent="#m_accordion_3">
								<div class="m-accordion__item-content">
									<div  style="width:20%; padding-right: 1%;" class="pull-left">
                                        <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                    </div>
                                    <div class="pull-right" style="width:70%">
                                        <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                        <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                        <div>
                                        @if($package->package_modules !="" && $package->package_modules!="NULL")                              
                                          <h4>Module Offered in this packages are:</h4>
                                          {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                          @foreach ($modulesOffered as $moduleRow)                                  
                                            <p><h5>Module Name: {{ $moduleRow->module_name}}</h5></p>
                                            <p>Module Note: {{ $moduleRow->module_note}}</p>
                                            <p>Module Description: {!! nl2br($moduleRow->module_desc) !!}</p>
                                          @endforeach                                   
                                        @endif
                                        </div>
                                        @if($package->package_price_type==0)
                                        <div class="book-btn-sec">
                                            <b>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </b>
                                            <div class="pull-right" style="margin: 5px;">
                                                <div>
                                                    <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
            
                                        @elseif($package->package_price_type==1)                   
                                        <div class="book-btn-sec">
                                            <div class="pull-left" >
                                                <div>
                                                    <a href="javascript:void(0);"  class="customGoldBtn btn btn-info nextBtn">Price On Request</a>
                                                </div>
                                            </div>
                                            <div class="pull-right" >
                                                <div>
                                                    <a href="{{ \URL::to('Impressum') }}"  class="customGoldBtn btn btn-info nextBtn">Contact for buying</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif      
                                    </div>
								</div>
							</div>
						</div>
                        @endforeach
						<!--end::Item--> 

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