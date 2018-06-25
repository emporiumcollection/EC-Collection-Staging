@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')


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

                </div>
              </div>
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
          <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
          <span>previous</span>
        </a>
        <a class="right carousel-control" href="#restaurantSlider" data-slide="next">
          <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
        </a>
      </div>
      <span class="scrollNextDiv"><a class="scrollpage" href="#orderDashboard">Scroll Down</a><span>Next</span>
      </span>
      </section>
    @endif
<section id="orderDashboard" class="col-md-12 pull-left" >
<div class="row">&nbsp;</div>

<div class="well col-md-12" style="background-color:#f7f7f7;">

<table class="table table-striped table-bordered" >
	<tbody>

			<tr>
				<td width='80%' class='label-view text-right'>Order Id</td>
				<th># {{ $order->id }} </th>

			</tr>

			<tr>
				<td width='80%' class='label-view text-right'>Invoice No.</td>
				<th># {{ $order->invoice_num }} </th>

			</tr>

			<tr>
				<td width='80%' class='label-view text-right'>Created</td>
				<th>{{ $order->created }} </th>

			</tr>

			<tr>
				<td width='80%' class='label-view text-right'>Status</td>
				<th>{{ $order->status }} </th>

			</tr>

			<tr>
				<td width='80%' class='label-view text-right'>Comments</td>
				<th>{{ $order->comments }} </th>

			</tr>
	</tbody>
</table>

@if(!empty($order_item_detail))
	<div id="item-pnl" class="col-md-12">
		<div class="row items-pnl-head">
			<div class="col-sm-1 col">No.</div>
			<div class="col-sm-7 col">PACKAGES</div>
			<div class="col-sm-2 col" style="text-align:center;">QTY</div>
			<div class="col-sm-2 col" style="text-align:center;">PRICE</div>
		</div>
		{{--*/
				$qty = 1;
				$qtyPr = 1;
			   $Totprice = 0;
			   $nos = 1;
			/*--}}
		@foreach($order_item_detail as $detail)
			<div class="row items-pnl-body" id="item-row">
				<div class="fieldwrapper">
					<div class="col-sm-1 col">{{$nos}}</div>
					<div class="col-sm-7 col"><b>{{$detail->pckname}}</b> @if($detail->pckcontent!='') <br> {{$detail->pckcontent}} @endif

					@if($detail->package_modules!='')
							<div >
                                @if($detail->package_modules !="" && $detail->package_modules!="NULL")

                                  <h5>Module Access purchased in this package are:</h5>
                                  {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$detail->package_modules))->get();/*--}}
                                  @foreach ($modulesOffered as $moduleRow)

                                    <p><h6>Module Name: {{ $moduleRow->module_name}}</h5></p>
                                    <p>Module Note: {{ $moduleRow->module_note}}</p>

                                   @endforeach

                                @endif
                                </div>


					@endif
					</div>


					<div class="col-sm-2 col" style="text-align:center;">{{$detail->qty}}</div>
					<div class="col-sm-2 col" style="text-align:center;">{{$def_currency->content . $detail->pckprice}}</div>
				</div>
			</div>
			{{--*/ $qtyPr = $detail->pckprice * $qty;
				$Totprice = $Totprice + $qtyPr;
				$nos++;
			/*--}}
		@endforeach
		<div class="row items-pnl-body" id="item-row">
			<div class="fieldwrapper">
				<div class="col-sm-11 col" style="text-align:right;">Total (Excl. VAT)</div>
				<div class="col-sm-1 col" style="text-align:center;">{{$def_currency->content . ($Totprice -(($Totprice*$data["vatsettings"]->content)/100))}}</div>
			</div>
		</div>
		<div class="row items-pnl-body" id="item-row">
			<div class="fieldwrapper">
				<div class="col-sm-11 col" style="text-align:right;">VAT( {{ $data["vatsettings"]->content}} )%</div>
				<div class="col-sm-1 col" style="text-align:center;">{{$def_currency->content . (($Totprice*$data["vatsettings"]->content)/100)}}</div>
			</div>
		</div>
		<div class="row items-pnl-body" id="item-row">
			<div class="fieldwrapper">
				<div class="col-sm-11 col" style="text-align:right;">Total</div>
				<div class="col-sm-1 col" style="text-align:center;">{{$def_currency->content . $Totprice}}</div>
			</div>
		</div>
	</div>
@endif
</div>

<div class="row">&nbsp;</div>
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
.input-group-addon {
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 4px;
	}

	#item-pnl .input-group-addon
	{
		padding:6px 9px;
	}
	.btn {
		 height: 22px !important;
	}

	#item-pnl .items-pnl-body {
		border-top: 1px solid #ccc;
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