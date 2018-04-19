
@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')
   <!-- terrace suit slider sec -->
@if (!empty($packages))
<div class="HamYardHotelSection">
  <div>
     <div id="HamYardHotelSlider" class="carousel slide HamYardHotelSlider" data-ride="carousel">
        <div class="carousel-inner">

            {{--*/ $k=0; $tottyp = count($packages); /*--}}
             @foreach($packages as $key=>$package)
           <div style="background-image: url({{URL::to('uploads/packages/'.$package->package_image)}});" @if($k==0) class="item active" @else class="item" @endif>
             <div class="carousalCaption">
               <h3>{{$package->package_title}}</h3>
               <h2>Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}</h2>
               <p>{!! nl2br($package->package_description) !!}</p>
             </div>
           </div>

           {{--*/ $k++; /*--}}
                                                
        @endforeach
           
        </div>
          <div class="HamYardHotelSliderOptions">
           
            <div class="terraceSuitindicator">
              <div class="terraceSuitarrow">
                <div class="terraceSuitCounter">
                  <p> </p>
                  <div class="num"></div>
                </div>
                <a class="left left1 carousel-control" href="#HamYardHotelSlider" data-slide="prev">
                  <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="icon">
                </a>
                <a class="right carousel-control" href="#HamYardHotelSlider" data-slide="next">
                  <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="icon">
                </a>
              </div>
            <ol class="carousel-indicators">
            {{--*/ $klist=0; $tottyp = count($packages); /*--}}
             @foreach($packages as $key=>$package)
              <li data-target="#HamYardHotelSlider" data-slide-to="{{$klist}}" @if($klist==0) class="active" @endif><img src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="Image"></li>             

              {{--*/ $klist++; /*--}}
                                                
            @endforeach
            </ol>
            <div class="showMoreSec"><button type="button" class="btn buttonDefault">SHOW MORE</button></div>
          </div>
        </div>
      </div>
  </div>
</div>
@endif

<section style="background-color:#f7f7f7;">
  <div class="container-fluid">
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>1</span>
                <p>STEP 1</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber active">
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
        <div class="col-xs-2">
            <div class="stepNumber">
                <span>4</span>
                <p>STEP 4</p>
            </div>
        </div>
    </div> 
</div>
</section>

<!-- terrace suit slider sec -->


  <section id="membershpipStepSec" class="membershpipStepSec">
    <div class="container-fluid">
    <!--Accordan Code -->
    <div class="row">

    <div>
    @if (!empty($packages))
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              

            {{--*/ $k=1; $tottyp = count($packages); /*--}}
            @foreach($packages as $key=>$package)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading{{ $k }}">
                  <h4 class="panel-title">
                    <a  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $k }}" {{($k==1) ? 'aria-expanded="true" ' : ' aria-expanded="false" class="collapsed"'}} aria-controls="collapse{{ $k }}">
                      {{$package->package_title}}  :: {{ $package->id }} :: Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
                    </a>
                  </h4>
                </div>
                <div id="collapse{{ $k }}" class="panel-collapse collapse {{($k==1) ? 'in ' : ''}}" role="tabpanel" aria-labelledby="heading{{ $k }}">
                  <div class="panel-body">        
                        <div>
                            <div  style="width:20%; padding-right: 1%;" class="pull-left">
                                <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" >



                             

                            </div>
                            <div class="pull-right" style="width:70%">
                                <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}} </p>  
                                <p>Package Details: {!! nl2br($package->package_description) !!}</p>
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
                                 @if($package->package_price_type==0)
                                <div class="book-btn-sec"><b> 
                                    {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </b>
                                 <div class="pull-right" >
                                <div>
                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn-cstmBtn">Add to cart</a>

                                </div>
                                </div>

                                </div>

                   @elseif($package->package_price_type==1)
                   
                            <div class="book-btn-sec">

                                  
                                   
                                 <div class="pull-left" >
                                    <div>
                                        <a href="javascript:void(0);"  class="customGoldBtn btn nextBtn">Price On Request</a>

                                    </div>
                                </div>
                                 <div class="pull-right" >
                                    <div>
                                        <a href="{{ \URL::to('Impressum') }}"  class="customGoldBtn btn nextBtn">Contact for buying</a>

                                    </div>
                                </div>

                                </div>

                          @endif      
                            </div>
                           
                       </div>
                  </div>
                </div>
            </div>


                {{--*/ $k++; /*--}}
                                                            
             @endforeach

             <div>
                <div class="row">&nbsp;</div>
                <div class="packagePriceSec">
                    <a href="{{url('hotel/advertiser')}}" class="btn btn-cstmBtn pull-right">Continue</a>
                </div>
                                        
            </div>
            </div>

            @endif
    </div>
    <!-- end accrodan code -->
    </div>
     </div>


<!-- Show More Popup -->



<div class="showMorePopup fullWidthPopup">
  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-4 col-md-6">
              
          </div>
          <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
            <div class="showMoreContent">
              <h1>TERRACE SUITE</h1>
              <ul>
                <li>• 145sqm (1560sqft) </li>
                <li>• Two King Beds </li>
                <li>• Roof Top View </li>
                <li>• Top Floor with terrace </li>
                <li>• Open plan lounge, dining area and kitchen </li>
                <li>• Individual Design </li>
                <li>• Complimentary Wifi </li>
                <li>• Air Conditioning </li>
                <li>• LCD TV and DVD </li>
                <li>• Writing desk </li>
                <li>• Shower and Bathtub </li>
                <li>• Rik Rak by Kit Kemp Bathroom Amenities </li>
                <li>• Bluetooth Bose Units </li>
                <li>• Sleeps 5 with extra bed</li>
              </ul>
              <p>A spectacular two bedroom fifth floor suite at 145sqm or 1560sqf. The vast living/dining room has high ceilings with full floor-to-ceiling windows and a terrace with views of the courtyard and London skyline. The spacious living room has a powder room, writing desk and a sleek designed Boffi kitchen. There are two spacious bedrooms each with a king beds and the en-suite bathrooms have a walk-in shower, large central bath and flat screen TV. Each of the bedrooms have a king bed with the en-suite bathroom that is beautifully designed with 2 basins, a bath tub and a separate shower with exclusive Rik Rak bath products designed by Kit Kemp. One rollaway allowed to sleep 5.</p>
              <div class="shoMoreButtonSection">
                <h2>€4141</h2>
                <a href="javascript:void(0);" class="button">BOOK Now</a>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>



<div class="whiteoverlay"></div>
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
    <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
    
@endsection

{{-- For custom style  --}}
@section('custom_css')
 @parent
<style>
.hotel-book-now {
                background: #ABA07C;
                color: #fff;
                font-size: 25px;
                height: 71px;
                margin: 0px 0px 10px 3px;
                opacity: 1;
                overflow-wrap: break-word;
                padding: 27px 5px;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
                z-index: 99;
                float: left;
            }
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
.membershpipStepSec{
      padding: 20px 0 0
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
        function addToCartHotel(PackageID,PackagePrice){    

        var PackagePrice=PackagePrice;
        var PackageID=PackageID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Package added to cart successfully.");
        }
        };
        xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
        xhttp.send();

}
</script>    
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection




