@extends('frontend.layouts.ev.customer')
@section('content')
<style>
#formerrors { color:#ffec0cf2;}
.input-hidden {
  position: absolute;
  left: -9999px;
}

input[type=radio]:checked + label>img {
  border: 1px solid #fff;
  box-shadow: 0 0 3px 3px #090;
}

/* Stuff after this is only to make things more pretty */
input[type=radio] + label>img {
  border: 1px dashed #444;
  width: 128px;
  height: 128px;
  transition: 500ms all;
}

input[type=radio]:checked + label>img {
  transform: 
    rotateZ(-2deg) 
    rotateX(2deg);
}


</style>
<section>

    <div>

  <!-- Nav tabs <i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{URL::to('hotel/propertymanagement')}}">Account Settings</a></li>
	<li role="presentation"  class="active"><a href="{{URL::to('hotel/propertymanagement/list')}}" aria-controls="propertymanagementlist" role="tab" data-toggle="tab">Property Management</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane " id="propertymanagementlist">
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
							<td><a  href="{{ URL::to('properties/update/'.$prop->id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ \Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a></td>
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

@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('script')
<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
<!-- animation -->
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
<!-- swiper carousel -->
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

<!-- images loaded -->
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection