@extends('layouts.app')

@section('content')

<style>
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus
	{
		font-size:12px;
		border-width: 0px;
	}
	.nav > li > a
	{
		font-size:12px;
	}
	label
	{
		font-size:12px;
	}
	
	.minhead
	{
		font-size: 14px;
		background-color: #000;
		color: #fff;
		padding: 5px 10px;
	}
</style>

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Account  <small>View Detail My Info</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li class="active">Account</li>
      </ul>
	</div>  
		
	<div class="page-content-wrapper m-t">
	@if(Session::has('message'))	  
		   {!! Session::get('message') !!}
	@endif	
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>	
	<ul class="nav nav-tabs" >
	  <li class="active"><a href="#info" data-toggle="tab"> {{ Lang::get('core.personalinfo') }} </a></li>
	  <li ><a href="#pass" data-toggle="tab">{{ Lang::get('core.changepassword') }} </a></li>
	  <li ><a href="#company" data-toggle="tab">{{ Lang::get('core.companydetails') }} </a></li>
	  <li><a href="#slider_ads" data-toggle="tab">{{ Lang::get('core.user_slider_ads') }} </a></li>
	  <li><a href="#sidebar_ads" data-toggle="tab">{{ Lang::get('core.user_sidebar_ads') }} </a></li>
	</ul>	
	
	<div class="tab-content">
	  <div class="tab-pane active m-t" id="info">
		{!! Form::open(array('url'=>'user/saveprofile/', 'class'=>'form-horizontal ' ,'files' => true)) !!}  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Username </label>
			<div class="col-md-8">
			<input name="username" type="text" id="username" disabled="disabled" class="form-control input-sm" required  value="{{ $info->username }}" />  
			 </div> 
		  </div>  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.email') }} </label>
			<div class="col-md-8">
			<input name="email" type="text" id="email"  class="form-control input-sm" value="{{ $info->email }}" /> 
			 </div> 
		  </div> 	  
	  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.firstname') }} </label>
			<div class="col-md-8">
			<input name="first_name" type="text" id="first_name" class="form-control input-sm" required value="{{ $info->first_name }}" /> 
			 </div> 
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.lastname') }} </label>
			<div class="col-md-8">
			<input name="last_name" type="text" id="last_name" class="form-control input-sm" required value="{{ $info->last_name }}" />  
			 </div> 
		  </div>    
	
		  <div class="form-group  " >
			<label for="ipt" class=" control-label col-md-4 text-right"> Avatar </label>
			<div class="col-md-8">
			<div class="fileinput fileinput-new" data-provides="fileinput">
			  <span class="btn btn-primary btn-file">
			  	<span class="fileinput-new">Upload Avatar Image</span><span class="fileinput-exists">Change</span>
					<input type="file" name="avatar">
				</span>
				<span class="fileinput-filename"></span>
				<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
			</div>
			<br />
			 Image Dimension 80 x 80 px <br />
			{!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!}
			
			 </div> 
		  </div>  
	
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>
			 </div> 
		  </div> 	
		
		{!! Form::close() !!}	
	  </div>
  
	  <div class="tab-pane  m-t" id="pass">
		{!! Form::open(array('url'=>'user/savepassword/', 'class'=>'form-horizontal ')) !!}    
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.newpassword') }} </label>
			<div class="col-md-8">
			<input name="password" type="password" id="password" class="form-control input-sm" value="" /> 
			 </div> 
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.conewpassword') }}  </label>
			<div class="col-md-8">
			<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value="" />  
			 </div> 
		  </div>    
		 
		
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<button class="btn btn-danger" type="submit"> {{ Lang::get('core.sb_savechanges') }} </button>
			 </div> 
		  </div>   
		{!! Form::close() !!}	
	  </div>
	  
	  <!-- Comapny detail tab -->
	  
	  <div class="tab-pane m-t" id="company">
		{!! Form::open(array('url'=>'user/savecompanydetails/', 'class'=>'form-horizontal ' ,'files' => true)) !!}  
			<input name="compedit_id" type="hidden" id="compedit_id" value="<?php if(!empty($extra)) { echo $extra->id; } ?>" />
		<div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Company Name </label>
				<div class="col-md-8">
				<input name="company_name" type="text" id="company_name" class="form-control input-sm" required  value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Company Owner </label>
				<div class="col-md-8">
				<input name="company_owner" type="text" id="company_owner" class="form-control input-sm" required  value="<?php if(!empty($extra)) { echo $extra->company_owner; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Contact Person </label>
				<div class="col-md-8">
				<input name="contact_person" type="text" id="contact_person" class="form-control input-sm" required  value="<?php if(!empty($extra)) { echo $extra->contact_person; } ?>" />  
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4">Contact Email  </label>
				<div class="col-md-8">
				<input name="company_email" type="email" id="company_email"  class="form-control input-sm" required value="<?php if(!empty($extra)) { echo $extra->company_email; } ?>" /> 
				 </div> 
			  </div> 
			  <div class="form-group">
				<label for="ipt" class="control-label col-md-4">Phone # </label>
				<div class="col-md-8">
				<input name="company_phone" type="text" id="company_phone"  class="form-control input-sm" required value="<?php if(!empty($extra)) { echo $extra->company_phone; } ?>" /> 
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class="control-label col-md-4">Website </label>
				<div class="col-md-8">
				<input name="company_website" type="text" id="company_website"  class="form-control input-sm" required value="<?php if(!empty($extra)) { echo $extra->company_website; } ?>" /> 
				 </div> 
			  </div>
			  <div class="form-group">
				<label for="ipt" class="control-label col-md-4">Tax # </label>
				<div class="col-md-8">
				<input name="company_tax_no" type="text" id="company_tax_no"  class="form-control input-sm" required value="<?php if(!empty($extra)) { echo $extra->company_tax_number; } ?>" /> 
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
				<label for="ipt" class=" control-label col-md-4"> Street Name & No. </label>
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
				<label for="ipt" class=" control-label col-md-4"> Postal Code </label>
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
				<label for="ipt" class=" control-label col-md-4 text-right"> Firmenlogo </label>
				<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
				  <span class="btn btn-primary btn-file">
					<span class="fileinput-new">Hochladen</span><span class="fileinput-exists">Change</span>
						<input type="file" name="company_logo">
					</span>
					<span class="fileinput-filename"></span>
					<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
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
				<span class="minhead">Company Tax Info</span>
				  
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Tax Number </label>
					<div class="col-md-8">
					<input name="steuernummer" type="text" id="steuernummer" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->steuernummer; } ?>" />  
					 </div> 
				  </div>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Tax ID </label>
					<div class="col-md-8">
					<input name="umsatzsteuer_id" type="text" id="umsatzsteuer_id" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->umsatzsteuer_id; } ?>" />  
					 </div> 
				  </div>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Executive Director </label>
					<div class="col-md-8">
						<input name="geschäftsführer" type="text" id="geschäftsführer" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->geschäftsführer; } ?>" />  
					 </div> 
				  </div>
			</div>
			<div class="col-md-6">
				<h2>&nbsp;</h2>
				  
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> Commercial Register </label>
					<div class="col-md-8">
						<input name="handelsregister" type="text" id="handelsregister" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->handelsregister; } ?>" />  
					 </div> 
				  </div>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"> District Court </label>
					<div class="col-md-8">
						<input name="amtsgericht" type="text" id="amtsgericht" class="form-control input-sm" value="<?php if(!empty($extra)) { echo $extra->amtsgericht; } ?>" maxlength="6" />  
					 </div> 
				  </div>
			</div>
		</div>
		<br>
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>
			 </div> 
		  </div> 	
		
		{!! Form::close() !!}	
	  </div>
	  
	  <div class="tab-pane  m-t" id="slider_ads">
		{!! Form::open(array('url'=>'adspayment', 'class'=>'form-horizontal ','id'=>'sliderads' ,'files' => true)) !!}   
		
		  <h3>Slider Advertisement Costs you {{(!empty($slider_ads_price))? $def_currency->content.$slider_ads_price->content:''}} and is valid for {{(!empty($slider_ads_expiry_days))?$slider_ads_expiry_days->content:''}} days.</h3>
		  
		  <input name="adscurrency" type="hidden" class="form-control input-sm" value="{{$def_currency->content}}"/> 
		  
		  <input name="adsType" type="hidden" class="form-control input-sm" value="slider"/> 
		  
		  <input name="adsprice" type="hidden" class="form-control input-sm" value="{{(!empty($slider_ads_price))? $slider_ads_price->content:''}}"/> 
		  
		  <input name="adsvalidation" type="hidden" class="form-control input-sm" value="{{(!empty($slider_ads_expiry_days))?$slider_ads_expiry_days->content:''}}"/> 
		  
		  <input name="advedit_id" type="hidden" class="form-control input-sm" value="{{(!empty($slider_ads_info))?$slider_ads_info->id:''}}"/> 
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_image') }} </label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
				  <span class="btn btn-primary btn-file">
					<span class="fileinput-new">Hochladen</span><span class="fileinput-exists">Change</span>
						<input type="file" name="advertise_img">
					</span>
					<span class="fileinput-filename"></span>
					<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
				</div>
				@if(!empty($slider_ads_info))
					{!! SiteHelpers::showUploadedFile($slider_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
				  @endif
			</div> 
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_link') }}  </label>
			<div class="col-md-8">
			<input name="adslink" type="text" class="form-control input-sm" value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_link:''}}" required />  
			 </div> 
		  </div> 

		<div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_title') }}  </label>
			<div class="col-md-8">
			<input name="adstitle" type="text" class="form-control input-sm" value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_title:''}}" required />  
			 </div> 
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_description') }}  </label>
			<div class="col-md-8">
			<input name="adsdesc" type="text" class="form-control input-sm" value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_desc:''}}" required />  
			 </div> 
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_category') }}  </label>
			<div class="col-md-8">
				<select name="ads_slider_cat" required class="form-control">
					<option value="">-- Select --</option>
					<option value="Hotel" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Hotel")?'selected="selected"':''}}>Hotel</option>
					<option value="Villas" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Villas")?'selected="selected"':''}}>Villas</option>
					<option value="Yachts" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Yachts")?'selected="selected"':''}}>Yachts</option>
					<option value="Safari Lodges" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Safari Lodges")?'selected="selected"':''}}>Safari Lodges</option>
					<option value="Spas" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Spas")?'selected="selected"':''}}>Spas</option>
				</select>
			 </div> 
		  </div>
		 		
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<?php $curdate = date('Y-m-d'); 
					if((!empty($slider_ads_info) && $slider_ads_info->adv_expire>=$curdate) || (!empty($slider_ads_price) && $slider_ads_price->content==0)){ ?>
						<input name="pay" type="hidden" class="form-control input-sm" value="no"/> 
						<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_savechanges') }} </button>
						<button type="button" class="btn btn-danger " onclick="deleteAds({{(!empty($slider_ads_info))?$slider_ads_info->id:''}},'sliderads');">  {{ Lang::get('core.btn_remove') }} </button>
				<?php } else { ?>
						<input name="pay" type="hidden" class="form-control input-sm" value="yes"/> 
						<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_payment') }} </button>
				<?php } ?>
			 </div> 
		  </div>   
		{!! Form::close() !!}	
	  </div>
	  
	  <div class="tab-pane  m-t" id="sidebar_ads">
		{!! Form::open(array('url'=>'adspayment', 'class'=>'form-horizontal ','id'=>'sidebarads' ,'files' => true)) !!}   
		
		  <h3>Sidebar Advertisement Costs you {{(!empty($sidebar_ads_price))? $def_currency->content.$sidebar_ads_price->content:''}} and is valid for {{(!empty($sidebar_ads_expiry_days))?$sidebar_ads_expiry_days->content:''}} days.</h3>
		  
		  <input name="adscurrency" type="hidden" class="form-control input-sm" value="{{$def_currency->content}}"/> 
		  
		  <input name="adsType" type="hidden" class="form-control input-sm" value="sidebar"/> 
		  
		  <input name="adsprice" type="hidden" class="form-control input-sm" value="{{(!empty($sidebar_ads_price))? $sidebar_ads_price->content:''}}"/> 
		  
		  <input name="adsvalidation" type="hidden" class="form-control input-sm" value="{{(!empty($sidebar_ads_expiry_days))?$sidebar_ads_expiry_days->content:''}}"/> 
		  
		  <input name="advedit_id" type="hidden" class="form-control input-sm" value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->id:''}}"/> 
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_image') }} </label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
				  <span class="btn btn-primary btn-file">
					<span class="fileinput-new">Hochladen</span><span class="fileinput-exists">Change</span>
						<input type="file" name="advertise_img">
					</span>
					<span class="fileinput-filename"></span>
					<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
				</div>
				@if(!empty($sidebar_ads_info))
					{!! SiteHelpers::showUploadedFile($sidebar_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
				  @endif
			</div> 
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_link') }}  </label>
			<div class="col-md-8">
			<input name="adslink" type="text" class="form-control input-sm" value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_link:''}}" required />  
			 </div> 
		  </div> 

		<div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_title') }}  </label>
			<div class="col-md-8">
			<input name="adstitle" type="text" class="form-control input-sm" value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_title:''}}" required />  
			 </div> 
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_description') }}  </label>
			<div class="col-md-8">
			<input name="adsdesc" type="text" class="form-control input-sm" value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_desc:''}}" required />  
			 </div> 
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_category') }}  </label>
			<div class="col-md-8">
				<select name="adsCat" class="form-control">
					<option value="">-- Select --</option>
					<option value="Hotel" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Hotel")?'selected="selected"':''}}>Hotel</option>
					<option value="Villas" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Villas")?'selected="selected"':''}}>Villas</option>
					<option value="Yachts" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Yachts")?'selected="selected"':''}}>Yachts</option>
					<option value="Safari Lodges" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Safari Lodges")?'selected="selected"':''}}>Safari Lodges</option>
					<option value="Spas" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Spas")?'selected="selected"':''}}>Spas</option>
					@if(!empty($maindest))
						@foreach($maindest as $dist)
							<option value="{{$dist['id']}}" {{((!empty($sidebar_ads_info)) && $dist['id']==$sidebar_ads_info->ads_cat_id)?'selected="selected"':''}}>{{$dist['name']}}</option>
						@endforeach
					@endif
				</select>
			 </div> 
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.ads_position') }}  </label>
			<div class="col-md-8">
				<select name="adspos" required class="form-control">
					<option value="">-- Select --</option>
					<option value="landing" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="landing")?'selected="selected"':''}}>landing Page Sidebar</option>
					<option value="grid_sidebar" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="grid_sidebar")?'selected="selected"':''}}>Grid Page Sidebar</option>
					<option value="grid_results" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="grid_results")?'selected="selected"':''}}>Grid Page Results </option>
					<option value="detail" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="detail")?'selected="selected"':''}}>Detail Page Sidebar </option>
				</select>
			 </div> 
		  </div>
		 		
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<?php $curdate = date('Y-m-d'); 
					if((!empty($sidebar_ads_info) && $sidebar_ads_info->adv_expire>=$curdate) || (!empty($sidebar_ads_price) && $sidebar_ads_price->content==0)){ ?>
						<input name="pay" type="hidden" class="form-control input-sm" value="no"/> 
						<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_savechanges') }} </button>
						<button type="button" class="btn btn-danger" onclick="deleteAds({{(!empty($sidebar_ads_info))?$sidebar_ads_info->id:''}},'sidebarads');">  {{ Lang::get('core.btn_remove') }} </button>
				<?php } else { ?>
						<input name="pay" type="hidden" class="form-control input-sm" value="yes"/> 
						<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_payment') }} </button>
				<?php } ?>
			 </div> 
		  </div>   
		{!! Form::close() !!}	
	  </div>
  


</div>
</div>
 
 </div>
<script>
	$('input[type="checkbox"][id="copyadd"]').on('ifChecked', function(){
		$('#billing_address').val($('#shipping_address').val());
		$('#billing_address2').val($('#shipping_address2').val());
		$('#billing_city').val($('#shipping_city').val());
		$('#billing_postal_code').val($('#shipping_postal_code').val());
		$('#billing_country').val($('#shipping_country').val());
	});
	
	function fillProfile(obj)
	{
		var custid = $(obj).val();
		$.ajax({
		  url: "{{ URL::to('getUserprofile')}}",
		  type: "post",
		  data: "customer="+custid,
		  dataType: "json",
		  success: function(data){
			if(data!='error')
			{
				$('#company_phone').val(data.phone);
				$('#company_email').val(data.email);
				$('#company_postal_code').val(data.zip);
				$('#comapny_address').val(data.street);
				$('#company_name').val(data.shoptitle);
				$('#company_city').val(data.city);
			}
		  }
		});
	}
	
	function deleteAds(ads_id, formid)
	{
		if(ads_id!='')
		{
			var confirmd = confirm("{{ Lang::get('core.ads_delete_confirm_msg') }}");
			if(confirmd==true)
			{
				$.ajax({
				  url: "{{ URL::to('deleteUserAds')}}",
				  type: "post",
				  data: "adsId="+ads_id,
				  dataType: "json",
				  success: function(data){
					if(data!='error')
					{
						$('#'+formid)[0].reset();
					}
					else{
						alert('No Advertisement Found');
					}
				  }
				});
			}
		}
	}
 </script>
@endsection
