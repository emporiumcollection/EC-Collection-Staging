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
    	{{--*/ $subTotal = 0; $orderTotal = 0; $package_for = array(2); /*--}}
    	@foreach($packages as $package)
        @if($package->package_price_type!=1)
		{{--*/ $subTotal += $package->package_price; /*--}}
        @endif
        <tr>
            <td class="overview-td">
            @if($package->package_image!='')
                <img class="product-image-cart" src="{{asset('uploads/packages')}}/{{$package->package_image}}" alt="" width="100"/>
            @endif    
            </td>
            <td>
          		<div class="product-title-and-remove-option">
                	<span class="product-title"><b>{{$package->package_title}}</b></span>
                    <?php if(!in_array($package->package_for, $package_for)){ 
                            if($user->own_hotel_setup==0){    
                    ?>
                        
                        <a href="javascript:void(0);" onclick="javascript:removeItemFromCart({{$package->id}});"><i class="fa fa-trash"></i></a>
                    <?php }elseif(($user->own_hotel_setup==1) && ($package->package_for !=1) ){ ?>
                        <a href="javascript:void(0);" onclick="javascript:removeItemFromCart({{$package->id}});"><i class="fa fa-trash"></i></a>
                    <?php } } ?>
                </div>
                <div>
                
                    <p>{!! nl2br($package->package_description) !!}</p>
                  
                
                </div>
            </td>
            
            <td class="overview-td m--align-center">1</td>
            <td class="overview-td">
            @if($package->package_price_type!=1)
                <span class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($package->package_price,2)}}</span>
            @else
                Price on Request
            @endif
            </td>
            <td class="overview-td">
            @if($package->package_price_type!=1)
                <span class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($package->package_price,2)}}</span>
            @else
                Price on Request
            @endif
            </td>
        </tr>
        @endforeach
		
        {{--*/ $orderTotal = $subTotal; /*--}}
    </tbody>
</table>
</div>       
</div>
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
    <div class="col-md-6 col-sm-12 m--pull-right">
    <table class="table">
    <tr>
        <td>
        <label>Total (excl. VAT) </label> 
        </td>
        <td>
        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{ number_format(number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100), 2, '.', '')}}
        </label>
        </td>
    </tr>
                           
    <tr>
        <td>
        <label>Vat {{(\Auth::user()->european) ? 'Inclusive' : 'Exclusive'}} {{ $data["vatsettings"]->content}}%</label> 
        </td>
        <td>
        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format(($orderTotal*$data["vatsettings"]->content)/100 , 2, '.', '')}}</label>
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
        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($orderTotal,2,'.','')}}</label>
        </td> 
    </tr>
    @if($subtract_at_booking_amt > 0)
    <tr>
        <td>
        <label>Subtract this fee from my first booking commission.</label> 
        </td>
        <td>
        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($subtract_at_booking_amt,2,'.','')}}</label>
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