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
    			{{--*/ $subTotal += $package->package_price; /*--}}
                <tr>                    
                    <td>
                    	<div class="product-title-and-remove-option">
                        	<span class="product-title">{{$package->package_title}}</span>
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
               
                    <td class="overview-td">1
                    </td>
                         <td class="overview-td">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($package->package_price,2)}}</td>
                    <td class="overview-td">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($package->package_price,2)}}</td>
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
    					{!! isset($currency->content)?$currency->content:'$' !!}
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
    					{!! isset($currency->content)?$currency->content:'$' !!} {{$prc}}
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
        <div class="col-md-4 col-sm-12 m--pull-right">
            <table class="table">
                <tr>
                    <td>
                        <label>Total (excl. VAT) </label> 
                    </td>
                    <td>
                        <label>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100)}}</label>                            
                    </td>
                </tr>
                                       
                <tr>
                    <td>
                        Vat {{ $data["vatsettings"]->content}}% 
                    </td>
                    <td>
                        {!! isset($currency->content)?$currency->content:'$' !!} 
                        {{  ($orderTotal*$data["vatsettings"]->content)/100 }}                                
                    </td> 
                </tr>
                
                <tr>
                    <td>
                        <label>Order Total</label> 
                    </td>
                    <td>
                        {!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($orderTotal,2,'.','')}}
                    </td> 
                </tr>
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