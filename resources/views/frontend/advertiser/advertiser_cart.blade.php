
@extends('frontend.layouts.ev.customer')
@section('content')
<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
    <div class="col-md-12">
    <div class="container">
		<div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a type="button" class="btn btn-default btn-circle cursor">2</a>
                    <p>Step 2</p>
                </div>
            </div>
		</div>

		<div class="row equalize sm-equalize-auto" id="step-1">
            <div class="col-md-12 sm-clear-both wow fadeInLeft">
                <div class="cartover-view-main margin-five-top">
                	@if(!empty($packages))
                    <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Your Packages</h5>
                    
                    <div class="cart-big-border">
                    <div class="cart-small-border"></div>
                    </div>
                    <div class="tbale-form">
                        <table class="table-width-custom">
                            <thead>
                                <tr>
                                    <th class="col-md-4 no-padding">Package</th>
                                    <th class="col-md-3 no-padding">Price</th>
                                    <th class="col-md-4 no-padding">Quantity</th>
                                    <th class="col-md-1 no-padding">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            	{{--*/ $subTotal = 0; $orderTotal = 0; /*--}}
                            	@foreach($packages as $package)
								
                                <tr>
                                    <td>
										<div class="product-title-and-remove-option">
											<span class="product-title">{{$package->space_title}}</span>
											<a href="#">Remove</a>
                                        </div>
                                    </td>
                                    <td class="overview-td">
										{!! isset($currency->content)?$currency->content:'$' !!}
										@if(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpc')
											{{ number_format($package->space_cpc_price,2) . '/' . $package->space_cpc_num_clicks .' Click' }}
										@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpm')
											{{ number_format($package->space_cpm_price,2) . '/' . $package->space_cpm_num_view .' Views' }}
										@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpd')
											{{ number_format($package->space_cpd_price,2) . '/' . $package->space_cpm_num_days .' Days' }}
										@endif
									</td>
                                    <td class="overview-td">{{\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_days']}}
                                    </td>
                                    <td class="overview-td">
										@if(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpc')
											{{--*/ $prc = number_format($package->space_cpc_price,2) /*--}}
										@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpm')
											{{--*/ $prc = number_format($package->space_cpm_price,2) /*--}}
										@elseif(\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_pacakge_type']=='cpd')
											 {{--*/ $prc = CommonHelper::calc_price($package->space_cpd_price,$package->space_cpm_num_days,\session()->get('hotel_cart')['advert_advert']['package']['content']['ads_days']) /*--}} 
										@endif
										{!! isset($currency->content)?$currency->content:'$' !!} {{$prc}}
									</td>
                                </tr>
                                @endforeach
                                {{--*/ $orderTotal = $prc; /*--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="row bottom-cart-view-page">
                        <div class="col-md-8 leftsideoverview">
                            <!--<h6 class="ai-6-heading ev-regural-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100">Coupon Code</h6>
                            <p>Enter your valid coupon or<br/>
                            promo code here to redeem<br/>
                            your discount
                            </p>
                            <form class="copon-form">
                                <input class="code-inout-block" type="text" placeholder="Enter Code">
                                <input class="code-submit" type="submit" value="Apply Coupon">
                            </form>-->
                        </div>
                        <div class="col-md-4 rightsidevartoverview">
                            <div class="carttotal">
                                <span class="label-total">Cart Subtotal</span>
                                <span class="cart-subtotal-amout">{!! isset($currency->content)?$currency->content:'$' !!} {{number_format($orderTotal,2)}}</span>
                                <!--<span class="cart-discount-label">No coupon</span>
                                <span class="cart-subtotal-amout">$0.00</span>-->
                                <span class="order-total-label">Order Total</span>
                                <span class="cart-subtotal-amout cart-total-amout">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($orderTotal,2)}}</span>
                            </div>
                            <div class="col-sm-12 text-right">
                                <a class="customGoldBtn btn nextBtn " href="{{url('advertiser/checkout')}}">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
					@else
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Your cart is empty</h5>
                    	
	                    <div class="cart-big-border">
                    	<div class="cart-small-border"></div>
	                    <div class="col-sm-12 text-right p-t-50">
                    		<a class="customGoldBtn btn nextBtn" href="{{url('advertiser/package')}}">Continue To Choose Packages </a>
                    	</div>
                    @endif
                </div>
            </div>
        </div>
    </div>


</div>
</section>
@endsection
@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">
<style>
.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}

.cart-small-border {
      height: 2px;
    width: 200px;
    background: #ABA07C;
    margin-top: -2px;
    z-index: 0;
}
.cart-big-border {
  
    width: 100%;
    background: #eaeaea;
    /* margin-top: -5px; */
    height: 2px;
    z-index: 9999;
}
.customGoldBtn {
    background-color: #ABA07C;
    border: none;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    font-family: Geomanist-Regular;
}
.customGoldBtn .btn i { margin-left: 0;}
.p-t-50{padding-top: 50px;}
.p-b-50{padding-bottom: 50px;}
</style>
@endsection

@section('script')

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
<!-- animation -->
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
<!-- swiper carousel -->
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

<!-- images loaded -->
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
         
@endsection