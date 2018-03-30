
@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')
    <!-- start Slider form section -->

    
    @if(!empty($pageslider))
    <section class="sliderSection termConditionSlider">
      <div id="restaurantSlider" class="carousel" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($pageslider as $key => $slider_row)
              <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
                <div class="carousel-caption">
                  <h1>{{$slider_row->slider_title}}</h1>
                  <p>{{$slider_row->slider_description}}</p>
                  <button type="button" class="button viewGalleryBtn">Contact us</button>
                </div>
              </div>
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
          <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
        </a>
        <a class="right carousel-control" href="#restaurantSlider" data-slide="next">
          <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
        </a>
      </div>
      <span class="scrollNextDiv"><a class="scrollpage" href="#membershpipStepSec">Scroll Down</a></span>
      </section>
    @endif
    
    <!-- End Slider form section -->
    <section id="membershpipStepSec" class="membershpipStepSec">
    <div class="container-fluid">
    <div class="row">
        <div class="col-xs-3">
            <div class="stepNumber ">
                <span>1</span>
                <p>STEP 1</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>2</span>
                <p>STEP 2</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>3</span>
                <p>STEP 3</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber active">
                <span>4</span>
                <p>STEP 4</p>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
            <div class="hotelInfoSection">
    		      
                <div class="col-md-12">
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
                                            <th class="col-md-4 no-padding" colspan="2">Package</th>
                                            <th class="col-md-4 no-padding">Quantity</th>
                                            <th class="col-md-3 no-padding">Price</th>
                                            
                                            <th class="col-md-1 no-padding">Line Total</th>
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
                                            </td>
                                            
                                            <td class="overview-td">1</td>
                                            <td class="overview-td">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($package->package_price,2)}}</td>
                                            <td class="overview-td">{!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($package->package_price,2)}}</td>
                                        </tr>
                                        @endforeach
        								@foreach($adspackages as $package)
        								
        									<tr>
        										<td colspan="2">
        											<div class="product-title-and-remove-option">
        												<span class="product-title">{{$package->space_title}}</span>
        												<a href="javascript:voic(0);" onclick="javascript:removeItemFromCart({{$package->id}},0);"><i class="fa fa-trash"></i></a>
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
                            <div class="row bottom-cart-view-page">

                                
                                <div class="col-md-8 leftsideoverview">
                                  
                                </div>
                                <div class="col-md-4 rightsidevartoverview">
                                     <div class="carttotal">
                                        <span class="label-total">Total (excl. VAT) </span>
                                        <span class="cart-subtotal-amout">{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100)}}</span>


                                        
                                           <span class="label-total">Vat {{ $data["vatsettings"]->content}}%</span>
                                            <span class="cart-subtotal-amout">{!! isset($currency->content)?$currency->content:'$' !!} 

                                            {{  ($orderTotal*$data["vatsettings"]->content)/100 }}</span>
                                       
                                                <span class="order-total-label">
                                                    ------------------<br>
                                                    Order Total<br>
                                                    ------------------
                                                </span>
                                                <span class="cart-subtotal-amout cart-total-amout">
                                                 ----------------------<br>
                                                     {!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($orderTotal,2,'.','')}}
                                                <br>
                                                ----------------------
                                                </span>
                                    

                                     
                                     
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <a class="btn btn-cstmBtn pull-right" href="{{url('hotel/checkout')}}">Proceed To Checkout</a>
                                    </div>
                                </div>
                            </div>
        					@else
        						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Your cart is empty</h5>
                            	
        	                    <div class="cart-big-border">
                            	<div class="cart-small-border"></div>
        	                    <div class="col-sm-12 text-right p-t-50">
                            		<a class="btn btn-cstmBtn pull-right" href="{{url('hotel/package')}}">Continue To Choose Packages </a>
                            	</div>
                            @endif
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
</section>

@endsection

{{--For Right Side Icons --}}
@section('right_side_iconbar')

    @parent
@show

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @parent
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.common_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/membership-css.css') }}" rel="stylesheet">
    
     
@endsection

{{-- For custom style  --}}
@section('custom_css')

    @parent
<style>

.disnon { display:none; }
.hotelInfoSection {
    display: inline-block;
    padding: 3% 4%;!important;
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
.ads-total-price{ font-size: 20px; }

.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
.parsley-required{

    padding: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
    border: 1px solid transparent;
    border-radius: 2px;
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;

}
</style>
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
    <script src="{{ asset('themes/emporium/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>

@endsection

{{-- For custom script --}}
@section('custom_js')
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

{{-- For footer --}}
@section('footer')
    @parent
@endsection