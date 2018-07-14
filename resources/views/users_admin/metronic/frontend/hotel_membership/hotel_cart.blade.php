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
            <span class="m-nav__link-text"> Account </span> 
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
								Your Packages
							</h3>
						</div>
					</div>
				</div>
                
				<div class="m-portlet__body">
                    @if(!empty($packages))
                    <div class="m-section">
                    <div class="m-section__content">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #f4f3f8;">
                                <th scope="col" colspan="2">Package</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                
                                <th scope="col">Line Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        	{{--*/ $subTotal = 0; $orderTotal = 0; /*--}}
                        	@foreach($packages as $package)
							{{--*/ $subTotal += $package->package_price; /*--}}
                            <tr>
                                <td class="overview-td">
                                    <img class="product-image-cart" src="{{asset('uploads/packages')}}/{{$package->package_image}}" alt="" width="100"/>
                                    
                                </td>
                                <td>
                              		<div class="product-title-and-remove-option">
                                    	<span class="product-title">{{$package->package_title}}</span>
                                        <a href="javascript:voic(0);" onclick="javascript:removeItemFromCart({{$package->id}},{{ $package->package_price }});"><i class="fa fa-trash"></i></a>
                                    </div>
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
                                </td>
                                
                                <td class="overview-td">1</td>
                                <td class="overview-td">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($package->package_price,2)}}</td>
                                <td class="overview-td">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($package->package_price,2)}}</td>
                            </tr>
                            @endforeach
							
                            {{--*/ $orderTotal = $subTotal; /*--}}
                        </tbody>
                    </table>
                    </div>       
                    </div>
                    <div class="m-section">
                        <div class="m-section__content">
                        <div class="col-md-4 col-sm-12 m--pull-right">
                        <table class="table">
                        <tr>
                            <td>
                            <label>Total (excl. VAT) </label> 
                            </td>
                            <td>
                            <label >{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100)}}
                            </label>
                            </td>
                        </tr>
                                               
                        <tr>
                            <td>
                            <label>Vat {{ $data["vatsettings"]->content}}%</label> 
                            </td>
                            <td>
                            <label >{!! isset($currency->content)?$currency->content:'$' !!} {{  ($orderTotal*$data["vatsettings"]->content)/100 }}</label>
                            </td> 
                        </tr>
                        
                        <tr>
                            <td>
                            <label>Order Total</label> 
                            </td>
                            <td>
                            <label >{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($orderTotal,2,'.','')}}</label>
                            </td> 
                        </tr>
                        </table>
                        </div>
                    </div>
                    </div> 
                    @else
                    <div class="m-section">
                        <div class="m-section__content">
                            <h2>Your cart is empty</h2>
                     
                            <div class="cart-big-border"></div>
                            
                            <div class="row"> 
                                <div class="col-lg-12 m--align-right">
                                    
                                </div>
                            </div>
                         </div>
                         
                     </div> 
                    @endif
                    <div class="m--clearfix"></div>
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">  
                                <div class="col-lg-12 m--align-right">                     						
                                    @if(!empty($packages)) 
                                        <a class="btn btn-success" href="{{url('hotel/checkout')}}">Proceed To Checkout</a>
                                    @else
                                        <a class="btn btn-success" href="{{url('hotel/package')}}">Continue To Choose Packages </a>
                                    @endif		
                                </div>
                            </div>
                        </div>
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
      
function removeItemFromCart(PackageID,PackagePrice){
    

        var PackagePrice=PackagePrice;
        var PackageID=PackageID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            window.location="{{ URL::to('hotel/cart')}}";
        }
        };
        xhttp.open("GET", "{{ URL::to('removecartitem')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
        xhttp.send();

    }

</script>    
@endsection