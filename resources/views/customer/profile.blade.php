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
        </a>
        <a class="right carousel-control" href="#restaurantSlider" data-slide="next">
          <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
        </a>
      </div>
      <span class="scrollNextDiv"><a class="scrollpage" href="#membershipDashboard">Scroll Down</a></span>
      </section>
    @endif

<section id="membershipDashboard">
    <div class="col-md-12" style="background-color:#f7f7f7;">
	    <div class="row">
	    	&nbsp;
	    </div>
    <div class="row">
	<div class="col-sm-12">

  
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My Account</a></li>
    @if($info->group_id==7)
		 <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Advertising</a></li>
	 
	@elseif($info->group_id==5)
		<li role="presentation"><a href="{{URL::to('hotel/propertymanagement')}}">Property management</a></li>
		<li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Memberships</a></li>
		<li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Advertising</a></li>


	@elseif($info->group_id==3)
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
     <div role="tabpanel" class="tab-pane active" id="profile"> 
			<div class="col-md-8 col-sm-8">
			     <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#personalDetails" aria-controls="personalDetails" role="tab" data-toggle="tab">Personal Information</a></li>
			    <li role="presentation"><a href="#resetPassword" aria-controls="resetPassword" role="tab" data-toggle="tab">Change Password</a></li>
			    <li role="presentation"><a href="#companyDetails" aria-controls="companyDetails" role="tab" data-toggle="tab">Company Details</a>
			    </li>
			    
			  </ul>
			</div>
 <div class="col-md-12 col-md-12">
        

<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="personalDetails">
			
		<div class="row">
            <div class="das-form-outer-align">
               
                	<form class="form-horizontal my-profile-main-form-align" name="basicInfo" id="basicInfo" method="post" action=" {{URL::to('customer/saveprofile')}}" enctype="multipart/form-data" data-parsley-validate="true">
						<input type="hidden" name="usertype" value="guests" id="userTypeHotel" class="input-hidden usertype" required=""/>
					<div id="guests">
					<div class="form-group">
						<label class=" control-label col-sm-2">Client Number</label>
						<div class="col-sm-6">
						<input name="clientID" type="text" id="clientID" disabled="disabled" class="form-control input-sm" required=""  value="{{$info->id}}" />  
						 </div> 
					  </div>  
					<div class="form-group">
						<label class=" control-label col-sm-2">Username </label>
						<div class="col-sm-6">
						<input name="username" type="text" id="username" disabled="disabled" class="form-control input-sm" data-parsley-type="email"  value="{{$info->email}}" />  
						 </div> 
					  </div>  
						<div class="form-group">
							<label class="control-label col-sm-2">First Name</label>
							<div class="col-sm-6">
								<input type="text" name="first_name" id="first_name"  data-parsley-type="alphanum" value="{{$info->first_name}}" class="form-control dash-input-style" placeholder="John" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Last Name</label>
							<div class="col-sm-6">
								<input type="text" name="last_name" id ="last_name" value="{{$info->last_name}}" class="form-control dash-input-style" placeholder="Doe" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Email</label>
							<div class="col-sm-6">
								<input type="text" name="email" id ="email" value="{{$info->email}}" class="form-control dash-input-style" placeholder="example@example.com" required="" readonly="">
							</div>
						</div>
						<div class="form-group">

							<label class="control-label col-sm-2">Phone</label>
							<div class="col-sm-6">          
								<input type="text" name="txtPhoneNumber" id="txtPhoneNumber" class="form-control dash-input-style" value="{{$info->mobile_number}}" placeholder="+91-9876543210" required="">
							</div>
						</div>

					  <div class="form-group  " >
							<label for="ipt" class=" control-label col-sm-2"> Avatar </label>
							<div class="col-sm-6">
							<div class="fileinput fileinput-new" data-provides="fileinput">
							  <span class="btn">
							  	<span class="fileinput-exists"> Upload/Change </span>
									<input type="file" name="avatar" class="btn btn-default dash-btn-style">
								</span>
								<span class="fileinput-filename"></span>
								
							</div>
							<br />
							 Image Dimension 80 x 80 px <br />
							{!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!}
							
							 </div> 
						  </div> 
						

						<div class="form-group">

							<label class="control-label col-sm-2"><input type="checkbox" id="newsLetter" name="newsLetter"></label>
							<div class="col-sm-6">          
								
									<label class="radio-label">Subscribe to our notifications and news to our latest hotels, spa's and offers </label>
								
							</div>
						</div>

							<div class="form-group" id="personalizeCheck">

							<label class="control-label col-sm-2"><input type="checkbox"  id="personalize" name="personalize" checked="checked"></label>
							<div class="col-sm-6">          
								
									<label class="radio-label">I require personalized service bookings in my account profile </label>
								
							</div>
						</div>
						@if($info->contracts !="NULL")
							
					  <div class="form-group  " >
							<label for="ipt" class=" control-label col-sm-2"> Contract Details </label>
							<div class="col-sm-6">
							<div>
							  <span class="btn">
							  	<span class="fileinput-exists"> Download Contract File </span>
									{!! SiteHelpers::showUploadedFile($info->contracts,'/uploads/users/',80,80) !!}
								</span>
								
								
							</div>
							</div> 
						  </div> 
						@endif
					
						<div class="form-group">        
							<div class="col-sm-8">
								<input type="submit" class="btn btn-white pull-right" value="Save Profile">
							</div>
						</div>
					</div>
				</form>
				<div id="formerrors"></div>
					
					
                
            </div> </div>

		</div>

<div role="tabpanel" class="tab-pane" id="resetPassword">
			
<div class="row col-md-6">
         <div class="das-form-outer-align">

		<div class="form-group has-feedback">
			@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>			
		</div>			
			

            	{!! Form::open(array('url' => 'customer/savepassword', 'class'=>'form-vertical','name'=>'passwordInfo','id'=>'passwordInfo','data-parsley-validate'=>'true')) !!}

            	{!! Form::hidden('userID',$info->id) !!}
	
	    
				

					
				
		<div class="form-group has-feedback">
			<label>New Password </label>
			{!! Form::password('password',  array('class'=>'form-control required', 'placeholder'=>'New Password','required'=>'','data-parsley-minlength'=>'6','minlength'=>'6')) !!}
			<i class="icon-lock form-control-feedback"></i>
		</div>
		
		  <div class="form-group has-feedback">
			<label>Re-type Password</label>
		   {!! Form::password('password_confirmation', array('class'=>'form-control required', 'placeholder'=>'Confirm Password','required'=>'','data-parsley-minlength'=>'6','minlength'=>'6')) !!}
			<i class="icon-lock form-control-feedback"></i>
		</div>
      <div class="form-group has-feedback">
      
			  <input type="submit" class="btn btn-white pull-right"  name="btnSubmit" value="Reset My Password">
			
      </div>
	  		
	
	 {!! Form::close() !!}
    	<div id="formerrors"></div>
		</div>
        </div>

		</div>
<!-- Comapny detail tab -->
		<div role="tabpanel" class="tab-pane" id="companyDetails"> 
			<div class="row col-sm-12">
	            <div class="das-form-outer-align">
	            <div class="tab-pane m-t" id="company">
		{!! Form::open(array('url'=>'customer/savecompanydetails/', 'class'=>'form-horizontal ','name'=>'companyDetailsForm','id'=>'companyDetailsForm','data-parsley-validate'=>'true','files' => true)) !!}  
				<input name="compedit_id" type="hidden" id="compedit_id" value="<?php if(!empty($extra)) { echo $extra->id; } ?>" />
			<div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Company Name</label>
				<div class="col-md-8">
				<input name="company_name" type="text" id="company_name" class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Company Owner </label>
				<div class="col-md-8">
				<input name="company_owner" type="text" id="company_owner" class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->company_owner; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Contact Person </label>
				<div class="col-md-8">
				<input name="contact_person" type="text" id="contact_person" class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->contact_person; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Company E-Mail </label>
				<div class="col-md-8">
				<input name="company_email" type="email" id="company_email"  class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->company_email; } ?>" /> 
				 </div> 
			  </div> 
			  <div class="form-group">
				<label for="ipt" class="control-label col-md-4">Phone # </label>
				<div class="col-md-8">
				<input name="company_phone" type="text" id="company_phone"  class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->company_phone; } ?>" /> 
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class="control-label col-md-4">Website </label>
				<div class="col-md-8">
				<input name="company_website" type="text" id="company_website"  class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->company_website; } ?>" /> 
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class="control-label col-md-4">Tax # </label>
				<div class="col-md-8">
				<input name="company_tax_no" type="text" id="company_tax_no"  class="form-control input-sm" required='' value="<?php if(!empty($extra)) { echo $extra->company_tax_number; } ?>" /> 
				 </div> 
			  </div>
			</div>
			<div class="col-md-6">
			 
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Address </label>
				<div class="col-md-8">
				<input name="company_address" type="text" id="comapny_address" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->company_address; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Address2 </label>
				<div class="col-md-8">
				<input name="company_address2" type="text" id="company_address2" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->company_address2; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> City </label>
				<div class="col-md-8">
				<input name="company_city" type="text" id="comapny_city" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->company_city; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Pin Code </label>
				<div class="col-md-8">
				<input name="company_postal_code" type="text" id="company_postal_code" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->company_postal_code; } ?>" maxlength="6" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Country </label>
				<div class="col-md-8">
				<input name="company_country" type="text" id="comapny_country" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->company_country; } ?>" />  
				 </div> 
			  </div>
		  
			  <div class="form-group  " >
				<label for="ipt" class=" control-label col-md-4 text-right"> CompanyLogo</label>
				<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
				  <span class="btn">
					<span class="fileinput-new">Logo</span>
					<span class="fileinput-exists">Change</span>
						<input type="file" name="company_logo" class="btn btn-default dash-btn-style">
					</span>
					<span class="fileinput-filename"></span>
					
				</div>
				<br />
				 Image Dimension 155 x 30 px <br />
				@if(!empty($extra))
				{!! SiteHelpers::showUploadedFile($extra->company_logo,'/uploads/users/company/',155, 30, '') !!}
				@endif
				 </div> 
			  </div>  
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Tax Number </label>
					<div class="col-md-8">
					<input name="steuernummer" type="text" id="steuernummer" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->steuernummer; } ?>" />  
					 </div> 
				  </div>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> VAT ID </label>
					<div class="col-md-8">
					<input name="umsatzsteuer_id" type="text" id="umsatzsteuer_id" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->umsatzsteuer_id; } ?>" />  
					 </div> 
				  </div>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Managing Director</label>
					<div class="col-md-8">
						<input name="geschäftsführer" type="text" id="geschäftsführer" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->geschäftsführer; } ?>" />  
					 </div> 
				  </div>
			</div>
			<div class="col-md-6">
				<h2>&nbsp;</h2>
				  
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Commercial Register</label>
					<div class="col-md-8">
						<input name="handelsregister" type="text" id="handelsregister" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->handelsregister; } ?>" />  
					 </div> 
				  </div>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4">District Court </label>
					<div class="col-md-8">
						<input name="amtsgericht" type="text" id="amtsgericht" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->amtsgericht; } ?>" maxlength="6" />  
					 </div> 
				  </div>
			</div>
		</div>
		<br>
		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-2">&nbsp;</label>
			<div class="col-md-8 pull-left">
				<button class="btn btn-white pull-right" type="submit"> Save Details </button>
			 </div> 
		  </div> 	
		
		{!! Form::close() !!}	
	  </div>
	            </div>
        	</div>

		</div>
		</div>
</div>		



    </div>
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

		  <div class="das-form-outer-align">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Invoice No.</th>
						<th>Status</th>
						<th>Comment</th>
						<th>Created At</th>
						<th>Function</th>
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

</div>
   

 </div>
 <div class="row">
 		&nbsp;    	
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
    padding: 6% 10%;!important;
}
#formerrors { color:#ffec0cf2;}
.input-hidden {
  position: absolute;
  left: -9999px;
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



    $('#passwordInfo').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:submit', function() {
    return true; // Don't submit form for this demo
  });


$('#companyDetailsForm').parsley().on('field:validated', function() {
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

{{-- For footer --}}
@section('footer')
    @parent
@endsection