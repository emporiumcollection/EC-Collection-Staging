@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')
<!-- End Slider form section -->

<section style="background-color:#f7f7f7;" class="col-md-12">
    <div class="container-fluid">
 <div class="row" style="background-color:#f7f7f7; min-height: 50px;">&nbsp;</div>
</div>
</section>
<section style="background-color:#f7f7f7;" class="col-md-12" >
    <div class="container-fluid">
    
    <div class="row well">
        <div class="col-md-12">
            @if(!empty($packages))
                       <div class="well col-md-12">
                            <h2>Review your shopping cart</h2>
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
        
                        
        
              <div class="row col-md-6 pull-right">                 
                <div class="well col-md-12 pull-right">
                        <div><hr class="hrDotted "></div>
                        <div class="pull-right"><label>Total (excl. VAT) </label> <label >{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100)}}</label> 
                        </div>
                        <div class="clearfix" ><hr class="hrDotted"></div>

                       
                          <div class="pull-right">
                            <label>Vat {{ $data["vatsettings"]->content}}%</label> 
                            <label >
                                {!! isset($currency->content)?$currency->content:'$' !!} 
                                {{  ($orderTotal*$data["vatsettings"]->content)/100 }}
                               </label> 
                        </div>
                       

                        <div class="clearfix"><hr class="hrDotted"></div>
                        <div class="pull-right">
                        <label>Order Total</label> 
                        <label > {!! isset($currency->content)?$currency->content:'$' !!}  {{number_format($orderTotal,2,'.','')}}</label> 
                        </div>
                        <div><hr class="hrDotted"></div>
                         
                </div>

                <div class="clearfix"></div>
                 <div class="well pull-right col-md-12">
                        <form action="{{URL::to('order-post')}}" method="POST">

                               <input type="hidden" name="finalAmount" value="{{$orderTotal}}">
                                <label>Order Comments</label>
                                <div class="clearfix"><hr class="hrDotted"></div>
                                
                                <textarea name="order_comments" id="order_comments"></textarea>
                               
                                <div>
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
                        <div class="row" style="background-color:#f7f7f7; min-height: 50px;">&nbsp;</div>
                </div>
            </div>
                            
    					@else

                            <div class="well">
                                <h2>Your cart is empty</h2>
                         
                                <div class="col-sm-12 text-right p-t-50">
                                    <a class="btn btn-cstmBtn pull-right" href="{{url('hotel/package')}}">Continue To Choose Packages </a>
                                </div>

                                <div class="cart-big-border">
                                
                              </div>
                             </div> 
    						
                        @endif
                    
                </div>
            </div>
    </div>


</section>


<section style="background-color:#f7f7f7;" class="col-md-12">
 <div class="row" style="background-color:#f7f7f7; min-height: 50px;">&nbsp;</div>

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

.hrDotted {
  border:none;
  border-top:1px dotted #f00;
  color:#fff;
  background-color:#fff;
  height:1px;
  width:100%;

}

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
  
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection