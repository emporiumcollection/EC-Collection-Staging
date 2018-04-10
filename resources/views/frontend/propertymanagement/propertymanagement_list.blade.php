
@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')

<section>
<div class="row col-md-12">
	&nbsp;

</div>

  <div class="well">
  <!-- Nav tabs <i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{URL::to('customer/profile')}}">Account Settings</a></li>
	<li role="presentation"  class="active"><a href="{{URL::to('hotel/propertymanagement')}}" aria-controls="propertymanagementlist" role="tab" data-toggle="tab">Property Management</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="propertymanagementlist">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Property Name</th>
					<th>Property City</th>
					<th>Website</th>
					<th>Email</th>
					<th>Funktion</th>
				</tr>
			</thead>
			<tbody>
			
				@if(!empty($properties))
					@foreach($properties as $prop)
						<tr>
							<td>{{$prop->property_name}}</td>
							<td>{{$prop->city}}</td>
							<td>{{$prop->website}}</td>
							<td>{{$prop->email}}</td>
							<td><a  href="{{ URL::to('hotel/propertymanagement/property-detail/'.$prop->id.'?return=') }}" class="tips btn btn-xs btn-success" title="{{ \Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a></td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
   
    
  </div>

</div>
   
   
</section>
    <!-- PARSLEY -->
    
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


