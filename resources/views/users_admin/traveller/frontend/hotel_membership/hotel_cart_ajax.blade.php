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
		{{--*/ $subTotal += $package->package_price; /*--}}
        <tr>
            <td class="overview-td">
                @if($package->package_image!='')
                    <img class="product-image-cart" src="{{asset('uploads/packages')}}/{{$package->package_image}}" alt="" width="100"/>
                @endif    
            </td>
            <td>
          		<div class="product-title-and-remove-option">
                	<span class="product-title"><b>{{$package->package_title}}</b></span>
                    <a href="javascript:void(0);" onclick="javascript:removeItemFromCart({{$package->id}});"><i class="fa fa-trash"></i></a>                    
                </div>
                <div>                
                    <p>{!! nl2br($package->package_description) !!}</p>              
                </div>
            </td>
            
            <td class="overview-td m--align-center">1</td>
            <td class="overview-td">
                <span class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($package->package_price,2)}}</span>
            </td>
            <td class="overview-td">
                <span class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($package->package_price,2)}}</span>
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
         
        <tr>
            <td>
            <label>Order Total</label> 
            </td>
            <td>
            <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($orderTotal,2,'.','')}}</label>
            </td> 
        </tr>
        
        
    
    </table>
    </div>
</div>
</div> 
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <div class="col-md-12 col-sm-12">
            <div class="m-radio-list">
				<label class="m-radio">
				     <input type="radio" name="checkouttype" value="business" class="rdocheckouttype" <?php echo $user->checkout_type=="business" ? 'checked="checked"' : ''; ?> />
                        Checkout as a Company
                     <span></span>
				</label>
                <label class="m-radio">
				     <input type="radio" name="checkouttype" value="private" class="rdocheckouttype" <?php echo $user->checkout_type=="private" ? 'checked="checked"' : ''; ?> />
                        Checkout as a Private Person
                     <span></span>
				</label>
			</div>
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