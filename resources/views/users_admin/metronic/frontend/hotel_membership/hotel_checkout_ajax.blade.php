@if(!empty($packages))
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" >Package</th>                                    
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Line Total</th>
                </tr>
            </thead>
            <tbody>
            	{{--*/ $subTotal = 0; $orderTotal = 0; /*--}}
            	@foreach($packages as $package)
                @if($package->package_price_type!=1)
    			{{--*/ $subTotal += $package->package_price; /*--}}
                @endif
                <tr>                    
                    <td>
                    	<div class="product-title-and-remove-option">
                        	<span class="product-title"><b>{{$package->package_title}}</b></span>
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
    			@foreach($adspackages as $package)
    			<tr>
                    <td>
    					<div class="product-title-and-remove-option">
    						<span class="product-title">{{$package->space_title}}</span>
                        </div>
                    </td>
                    <td class="overview-td">
    					{!! isset($currency->content)?$currency->content:'&euro;' !!}
    					@if(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpc')
    						{{ number_format($package->space_cpc_price,2,'.','') . '/' . $package->space_cpc_num_clicks .' Click' }}
    					@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpm')
    						{{ number_format($package->space_cpm_price,2,'.','') . '/' . $package->space_cpm_num_view .' Views' }}
    					@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpd')
    						{{ number_format($package->space_cpd_price,2,'.','') . '/' . $package->space_cpm_num_days .' Days' }}
    					@endif
    				</td>
                    <td class="overview-td">{{\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_days']}}
                    </td>
                    <td class="overview-td">
    					@if(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpc')
    						{{--*/ $prc = number_format($package->space_cpc_price,2,'.','') /*--}}
    					@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpm')
    						{{--*/ $prc = number_format($package->space_cpm_price,2,'.','') /*--}}
    					@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpd')
    						 {{--*/ $prc = CommonHelper::calc_price($package->space_cpd_price,$package->space_cpm_num_days,\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_days']) /*--}} 
    					@endif
    					{!! isset($currency->content)?$currency->content:'&euro;' !!} {{$prc}}
    				</td>
                </tr>
    			{{--*/ $subTotal += $prc; /*--}}
                @endforeach
                {{--*/ $orderTotal = $subTotal; /*--}}
            </tbody>
        </table>
    </div>       
</div>
<div class="m--clearfix"></div>
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <div class="col-md-6 col-sm-12 m--pull-right">
            <table class="table">
                <tr>
                    <td>
                        <label>Total (excl. VAT) </label> 
                    </td>
                    <td>
                        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{ number_format(number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100), 2)}}</label>                            
                    </td>
                </tr>
                                       
                <tr>
                    <td>
                        Vat {{(\Auth::user()->european) ? 'Inclusive' : 'Exclusive'}} {{ $data["vatsettings"]->content}}% 
                    </td>
                    <td>
                        <label class="m--pull-right">
                        {!! isset($currency->content)?$currency->content:'&euro;' !!} 
                        {{  number_format(($orderTotal*$data["vatsettings"]->content)/100,2,'.','') }}
                        </label>                              
                    </td> 
                </tr>
                <?php 
                    if(!(\Auth::user()->european)){    
                        $orderTotal = $orderTotal - (($orderTotal*$data["vatsettings"]->content)/100); 
                    } 
                ?> 
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
                {{--*/ $orderTotal = $orderTotal - $subtract_at_booking_amt; /*--}}
                @endif
                
            </table>
        </div>
    </div>
</div> 
<div class="m--clearfix"></div>
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        
        <div class="col-md-4 col-sm-12 m--pull-right" style="padding-bottom: 50px;">
        <form action="{{URL::to('wizard-order-post')}}" method="POST" class="m-form m-form--fit m-form--label-align-right">

            <input type="hidden" name="finalAmount" value="{{$orderTotal}}">
            
            <div class="form-group m-form__group">                                
                <label>Order Comments</label>                                
                <textarea name="order_comments" id="order_comments" class="form-control m-input"></textarea>
            </div>
            @if($orderTotal > 0)
            <div class="form-group m-form__group">
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_4KFTrHSWQ3FVkkfBwoQutZSC"
                    data-amount="{{$orderTotal*100}}"
                    data-name="emporium-voyage.com"
                    data-currency="EUR"
                    data-description="Luxury Travel Redefined"
                    data-image="{{ \URL::to('sximo/assets/images/Emporium-Voyage.png') }}" 
                    data-locale="auto">
                </script>
            </div>
            @else
            <div class="form-group m-form__group m--pull-right">
                <a class="btn btn-primary" href="#" id="finish_btn">Submit</a>
            </div>
            @endif
        </form>
        </div>        
        
    </div>
</div>
@else
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <h2>Your cart is empty</h2>
 
        <div class="col-sm-12 text-right p-t-50">
            <a class="btn btn-primary pull-right" href="#" id="choose_pkg_btn">Continue To Choose Packages </a>
        </div>

        <div class="cart-big-border"></div>
     </div>
 </div> 
@endif 