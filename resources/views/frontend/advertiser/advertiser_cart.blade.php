
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

@section('content')

<section style="background-color:#f7f7f7;">
    <div class="container-fluid">
    <div class="row">
        <div class="col-xs-6">
            <div class="stepNumber ">
                <span>1</span>
                <p>STEP 1</p>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="stepNumber active">
                <span>2</span>
                <p>STEP 2</p>
            </div>
        </div>
            
    </div>
</div>
</section>
<section >
<div class="col-md-12">
    <div class="row" style="background-color:#f7f7f7;">
           <div class="col-xs-12">
                <div>
                    @if(!empty($packages))
                    <h5>Your Packages</h5>
                    
                    <div class="cart-big-border">
                    <div class="cart-small-border"></div>
                    </div>
                    <div class="tbale-form">
                        <table class="table-width-custom">
                            <thead>
                                <tr>
                                    <th class="col-md-2 no-padding">Package</th>
                                    <th class=" col-md-2no-padding">Price</th>
                                    <th class=" col-md-2no-padding">Quantity</th>
                                    <th class=" col-md-2 no-padding">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--*/ $prc = 0; $orderTotal = 0; /*--}}
                                @foreach($packages as $package)
                                
                                <tr>
                                    <td>
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
                                @endforeach
                                {{--*/ $orderTotal = $prc; /*--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="row bottom-cart-view-page">
                        <div class="col-md-6"> </div>
                        <div class="col-md-4">
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
                            <div class="col-sm-8 text-right">
                                <a class="customGoldBtn btn nextBtn " href="{{url('advertiser/checkout')}}">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
                    @else
                        <h5>Your cart is empty</h5>
                        
                        <div class="cart-big-border">
                        <div class="cart-small-border"></div>
                        <div class="col-sm-12 text-right p-t-50">
                            <a class="customGoldBtn btn nextBtn" href="{{url('advertiser/package')}}">Continue To Choose Packages </a>
                        </div>
                      </div>
                    @endif
          
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
            
            window.location="{{ URL::to('advertiser/cart')}}";
        }
        };
        xhttp.open("GET", "{{ URL::to('removecartitem')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=advert", true);
        xhttp.send();

    }
</script>    
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection