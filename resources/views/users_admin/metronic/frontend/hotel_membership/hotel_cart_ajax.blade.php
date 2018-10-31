@if(!empty($packages))
<div class="m-section" style="width: 100%;">
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
    	{{--*/ $subTotal = 0; $orderTotal = 0; $package_for = array(1, 2); /*--}}
    	@foreach($packages as $package)
		{{--*/ $subTotal += $package->package_price; /*--}}
        <tr>
            <td class="overview-td">
                <img class="product-image-cart" src="{{asset('uploads/packages')}}/{{$package->package_image}}" alt="" width="100"/>
                
            </td>
            <td>
          		<div class="product-title-and-remove-option">
                	<span class="product-title">{{$package->package_title}}</span>
                    <?php if(!in_array($package->package_for, $package_for)){ ?>
                        <a href="javascript:voic(0);" onclick="javascript:removeItemFromCart({{$package->id}},{{ $package->package_price }});"><i class="fa fa-trash"></i></a>
                    <?php } ?>
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
                   <a href="#" onclick="javascript: return false;" data-toggle="modal" data-target="#contract_model_{{$package->id}}">View contracts</a>
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
<div class="m-section" style="width: 100%;">
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
    <?php 
    if((!(\Auth::user()->european))){    
        $orderTotal = $orderTotal - (($orderTotal*$data["vatsettings"]->content)/100); 
    } ?> 
    <tr>
        <td>
        <label>Order Total</label> 
        </td>
        <td>
        <label >{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($orderTotal,2,'.','')}}</label>
        </td> 
    </tr>
    @if($subtract_at_booking_amt > 0)
    <tr>
        <td>
        <label>Subtract this fee from my first booking commission.</label> 
        </td>
        <td>
        <label >{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($subtract_at_booking_amt,2,'.','')}}</label>
        </td> 
    </tr>
    @endif
    
    </table>
    </div>
</div>
</div> 
@else
<div class="m-section" style="width: 100%;">
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
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <div class="row">
            <div class="col-lg-12 m--align-right">                     						
                @if(!empty($packages)) 
                    <a class="btn btn-success" href="#" id="checkout_btn">Proceed To Checkout</a>
                @else
                    <a class="btn btn-success" href="{{url('hotel/package')}}" id="choose_pkg_btn">Continue To Choose Packages </a>
                @endif		
            </div>
        </div>
    </div>
</div>