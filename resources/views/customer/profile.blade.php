
@extends('frontend.layouts.ev.customer')
@section('content')
<style>
#formerrors { color:#ffec0cf2;}
.input-hidden {
  position: absolute;
  left: -9999px;
}


</style>

@if(Session::has('messagetext'))	  
		   {!! Session::get('message') !!}
	@endif	
	<ul>
		@foreach($errors->all() as $error)
			<li class="alert alert-danger parsley">{{ $error }}</li>
		@endforeach
	</ul>
<div class="col-sm-12">

  <!-- Nav tabs <i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My Account</a></li>
    @if($info->group_id==7)
		 <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Advertising</a></li>
	 
	@elseif($info->group_id==5)
		<li role="presentation"><a href="{{URL::to('hotel/propertymanagement')}}">Property management</a></li>
		<li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Reservation management</a></li>
		<li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Memberships</a></li>
		<li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Advertising</a></li>
	@else
		<li  role="presentation" class="<?php echo (isset($active_menu) && $active_menu == 'bookings')? 'active' : ''; ?>">
			<a href="{{URL::to('bookings')}}">
				My Bookings
			</a>
		</li>
		
		<li role="presentation"><a href="#personalizedOptions" aria-controls="personalizedOptions" role="tab" data-toggle="tab">Personalized Services</a></li>

		<li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Memberships</a></li>
	@endif
	
    <li role="presentation"><a href="#accountingorders" aria-controls="accountingorders" role="tab" data-toggle="tab">Accounting</a></li>



  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">
               
                	<form class="form-horizontal my-profile-main-form-align" name="basicInfo" id="basicInfo" method="post" action=" {{URL::to('customer/savewhoiam')}}">
						<input type="hidden" name="usertype" value="guests" id="userTypeHotel" class="input-hidden usertype" required=""/>
					<div id="guests">
						<div class="form-group">
							<label class="control-label col-sm-2">First Name</label>
							<div class="col-sm-10">
								<input type="text" name="first_name" id="first_name" value="{{$info->first_name}}"class="form-control dash-input-style" placeholder="John" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Last Name</label>
							<div class="col-sm-10">
								<input type="text" name="last_name" id ="last_name" value="{{$info->last_name}}" class="form-control dash-input-style" placeholder="Doe" required="">
							</div>
						</div>
						<div class="form-group">

							<label class="control-label col-sm-2">Phone</label>
							<div class="col-sm-10">          
								<input type="text" name="txtPhoneNumber" id="txtPhoneNumber" class="form-control dash-input-style" value="{{$info->mobile_number}}"placeholder="+91-9876543210" required="">
							</div>
						</div>
						<div class="form-group profile-page-submit-radio-align">        
							<div class="col-sm-12">
								<div class="radio">
									<label class="radio-label">Subscribe to our notifications and news to our latest hotels, spa's and offers <input type="checkbox" id="newsLetter" name="newsLetter"></label>
								</div>
							</div>
							<div class="col-sm-12" id="personalizeCheck">
								<div class="radio">
									<label class="radio-label">I require personalized service bookings in my account profile <input type="checkbox"  id="personalize" name="personalize" checked="checked"></label>
								</div>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-12">
								<input type="submit" class="btn btn-default dash-btn-style" value="Save Profile">
							</div>
						</div>
					</div>
				</form>
				<div id="formerrors"></div>
					
					
                
            </div>
        </div></div></div>
    <div role="tabpanel" class="tab-pane " id="home">Coming Soon....</div>
   
    <div role="tabpanel" class="tab-pane" id="messages">Coming Soon...</div>
 
    <div role="tabpanel" class="tab-pane" id="comingsoon">Coming Soon...</div>
    <div role="tabpanel" class="tab-pane" id="personalizedOptions"> 
         <div class="row">
                <div >
                    <ul class="list-group" >
                            <li class="list-group-item"><a class="active" href="#">Get Inspired</a></li>
                            <li class="list-group-item"><a href="#">Edit My Personalized Services</a></li>
                            <li class="list-group-item"><a href="{{ URL::to('personalized-service')}}">Create New Personalized Services</a></li>
                            <li class="list-group-item"><a href="#">List Personalized Services</a></li>
                                
                            </ul>
               
                </div>
            </div>

    </div>
	
	<div role="tabpanel" class="tab-pane" id="accountingorders">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Invoice No.</th>
					<th>Status</th>
					<th>Comment</th>
					<th>Created At</th>
					<th>Funktion</th>
				</tr>
			</thead>
			<tbody>
			
				@if(!empty($orders))
					@foreach($orders as $ord)
						<tr>
							<td>{{$ord->id}}</td>
							<td>{{$ord->invoice_num}}</td>
							<td>{{$ord->status}}</td>
							<td>{{$ord->comments}}</td>
							<td>{{$ord->created}}</td>
							<td>
								<a  href="{{ URL::to('customer/orderdetail/'.$ord->id) }}" class="tips btn btn-xs btn-success" title="View detail"><i class="fa  fa-search  "></i></a>
								<a href="{{ URL::to('customer/downloadinvoicepdf/'.$ord->id)}}" class="tips btn btn-xs btn-primary" title="invoice"><i class="fa fa-download"></i></a>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
	
  </div>

</div>
   

   <script>
window.ParsleyConfig = {
    errorsWrapper: '<div></div>',
    errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
    errorClass: 'has-error',
    successClass: 'has-success'
};


    
$(function () {
  $('#basicInfo').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:submit', function() {
    return true; // Don't submit form for this demo
  });
});
</script>


@endsection



@section('script')
<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>

@endsection