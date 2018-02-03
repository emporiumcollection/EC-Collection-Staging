
@extends('frontend.layouts.ev.customer')
@section('content')
<style type="text/css">
    
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
	.disnon { display:none; }

</style>
<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                    <div class="container-fluid">


                    	       <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a  type="button" class="btn btn-default btn-circle cursor" >3</a>
                                        <p>Step 3</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">4</a>
                                        <p>Step 4</p>
                                    </div>
                                </div>
                            </div>
                        <div class="row equalize sm-equalize-auto">
                            
                        </div>
                    </div>
                </section>


<div class="container">
	<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Advertisements Package</h5>
	@if (!empty($packages))
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<td>Package</td>
						<td>Type</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Line Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					
					@foreach($packages as $key=>$package)
						<tr>
							<td>{{$package->space_title}}</td>
							<td>
								<select class="bg-white medium-input" onchange="changeprice(this.value)">
									<option value="CPC">CPC Target Clicks - {{$package->space_cpc_num_clicks}}</option>
									<option value="CPM">CPM Target View - {{$package->space_cpm_num_view}}</option>
									<option value="CPD">CPD Target Days - {{$package->space_cpm_num_days}}</option>
								</select>
							</td>
							<td>
								<input type="hidden" name="pacprice" id="pacprice" value="{{ number_format($package->space_cpc_price,2) }}" />
								<p id="CPC">{!! isset($currency->content)?$currency->content:'$' !!} <span class="price"> {{ number_format($package->space_cpc_price,2) }}</span></p>
								<p id="CPM" class="disnon">{!! isset($currency->content)?$currency->content:'$' !!} <span class="price">{{ number_format($package->space_cpm_price,2) }}</span></p>
								<p id="CPD" class="disnon">{!! isset($currency->content)?$currency->content:'$' !!}<span class="price"> {{ number_format($package->space_cpd_price,2) }}</span>
								</p>
							</td>
							
							<td><input type="number" value="1" min="1" class="bg-white medium-input"/></td>
							<td>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->space_cpc_price,2) }}</td>
							<td><a class="customGoldBtn btn nextBtn" rel="{{$package->id}}"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>  <a class="customGoldBtn btn nextBtn"> <i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
						</tr>                             
		 			@endforeach	
				</tbody>
			</table>
		</div>
		@endif
		<div class="col-sm-12 text-right">
		    <a class="customGoldBtn btn nextBtn" href="{{url('hotel/cart')}}">Continue  </a>
		</div>

  </div>
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
@endsection
 <!-- contact email aside -->
 <script>


function addToCartHotel(packagePrice,PackageID){
    

        var packagePrice=packagePrice;
        var PackageID=PackageID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Package added to cart successfully.");
        }
        };
        xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart')}}?cart[package][id]="+PackageID+"&cart[package][price]="+packagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
        xhttp.send();

}

function changeprice(type)
{
	if(type!='')
	{
		$('#CPC').hide();
		$('#CPD').hide();
		$('#CPM').hide();
		$('#'+type).show();
		$('#pacprice').val($.trim($('#' + type + ' .price').text()));
	}
}

 </script>


