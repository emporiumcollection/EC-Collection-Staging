@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Account  <small>View Detail My Info</small>
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> Account </span> 
        </a> 
    </li>
@stop

@section('content')
	<div class="row">
        @if(Session::has('message'))	  
    		   {!! Session::get('message') !!}
    	@endif
        
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
		<div class="col-xl-3 col-lg-4">
			<div class="m-portlet m-portlet--full-height  ">
				<div class="m-portlet__body">
					<div class="m-card-profile">
						<div class="m-card-profile__title m--hide">
							Your Profile
						</div>
						<div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
								{!! SiteHelpers::avatarProfile(80,80,'') !!}
							</div>
						</div>
						<div class="m-card-profile__details">
							<span class="m-card-profile__name">
								{{ Session::get('fid') }}
							</span>
							<a href="#" onclick="return false;" class="m-card-profile__email m-link">
								{{ Session::get('eid') }}
							</a>
						</div>
					</div>
                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary m-nav m-nav--hover-bg m-portlet-fit--sides _nav-profile" role="tablist">
                        <li class="m-nav__separator m-nav__separator--fit"></li>
						<li class="m-nav__section m--hide">
							<span class="m-nav__section-text">
								Section
							</span>
						</li>
						<li class="m-nav__item nav-item m-tabs__item">
                            <a href="#myprofile" class="m-nav__link nav-link m-tabs__link active" data-toggle="tab" role="tab">
								<i class="m-nav__link-icon flaticon-profile-1"></i>
								<span class="m-nav__link-title">
									<span class="m-nav__link-wrap">
										<span class="m-nav__link-text">
											Personal Information
										</span>
									</span>
								</span>
							</a>
						</li>						
					</ul>
                    
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="tab-content">
        			<div class="tab-pane active" id="myprofile">
                    	<div class="m-portlet__head">
        					<div class="m-portlet__head-tools">
        						<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link active" data-toggle="tab" href="#info" role="tab">
        									<i class="flaticon-share m--hide"></i>
        									Personal Information
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#pass" role="tab">
        									Change Password
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#preferences" role="tab">
        									Personalized Preferences
        								</a>
        							</li>
        						</ul>
        					</div>
        				</div>
        				<div class="tab-content">
        					<div class="tab-pane active" id="info">
                                {!! Form::open(array('url'=>'user/savetravellerprofile/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                                    <div class="m-portlet__body">  
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										First Name
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="first_name" type="text" id="first_name" class="form-control m-input" required  value="{{ $info->first_name }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Last Name
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="last_name" type="text" id="last_name" class="form-control m-input" required  value="{{ $info->last_name }}" />  
        									</div>
        								</div>                                      
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Email
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="email" type="text" id="email" class="form-control m-input" required readonly="readonly"  value="{{ $info->email }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Phone Number
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="txtmobileNumber" type="text" id="txtmobileNumber" class="form-control m-input" required  value="{{ $info->mobile_number }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										I Am 
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<select class="form-control" id="gender" name="gender">
                                                    <option value="Male" <?php echo $info->gender=="Male" ? "selected='selected'" : "" ?> >Male</option>
                                                    <option value="Female" <?php echo $info->gender=="Female" ? "selected='selected'" : "" ?>>Female</option>
                                                    <option value="Other" <?php echo $info->gender=="Other" ? "selected='selected'" : "" ?>>Other</option>
                                                </select>
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Preferred Language
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<select class="form-control" id="prefer_communication_with" name="prefer_communication_with">
                                                    <option value="en"  <?php echo $info->prefer_communication_with=="en" ? "selected='selected'" : "" ?>>English</option>
                                                    <option value="id"  <?php echo $info->prefer_communication_with=="id" ? "selected='selected'" : "" ?> >Bahasa Indonesia</option>
                                                    <option value="ms"  <?php echo $info->prefer_communication_with=="ms" ? "selected='selected'" : "" ?>>Bahasa Melayu</option>
                                                    <option value="ca"  <?php echo $info->prefer_communication_with=="ca" ? "selected='selected'" : "" ?>>Català</option>
                                                    <option value="da"  <?php echo $info->prefer_communication_with=="da" ? "selected='selected'" : "" ?>>Dansk</option>
                                                    <option value="de"  <?php echo $info->prefer_communication_with=="de" ? "selected='selected'" : "" ?>>Deutsch</option>
                                                    
                                                    <option value="es"  <?php echo $info->prefer_communication_with=="es" ? "selected='selected'" : "" ?>>Español</option>
                                                    <option value="el"  <?php echo $info->prefer_communication_with=="el" ? "selected='selected'" : "" ?>>E???????</option>
                                                    <option value="fr"  <?php echo $info->prefer_communication_with=="fr" ? "selected='selected'" : "" ?>>Français</option>
                                                    <option value="hr"  <?php echo $info->prefer_communication_with=="hr" ? "selected='selected'" : "" ?>>Hrvatski</option>
                                                    <option value="it"  <?php echo $info->prefer_communication_with=="it" ? "selected='selected'" : "" ?>>Italiano</option>
                                                    <option value="hu"  <?php echo $info->prefer_communication_with=="hu" ? "selected='selected'" : "" ?>>Magyar</option>
                                                    <option value="nl"  <?php echo $info->prefer_communication_with=="nl" ? "selected='selected'" : "" ?>>Nederlands</option>
                                                    <option value="no"  <?php echo $info->prefer_communication_with=="no" ? "selected='selected'" : "" ?>>Norsk</option>
                                                    <option value="pl"  <?php echo $info->prefer_communication_with=="pl" ? "selected='selected'" : "" ?>>Polski</option>
                                                    <option value="pt"  <?php echo $info->prefer_communication_with=="pt" ? "selected='selected'" : "" ?>>Português</option>
                                                    <option value="fi"  <?php echo $info->prefer_communication_with=="fi" ? "selected='selected'" : "" ?>>Suomi</option>
                                                    <option value="sv"  <?php echo $info->prefer_communication_with=="sv" ? "selected='selected'" : "" ?>>Svenska</option>
                                                    <option value="tr"  <?php echo $info->prefer_communication_with=="tr" ? "selected='selected'" : "" ?>>Türkçe</option>
                                                    <option value="is"  <?php echo $info->prefer_communication_with=="is" ? "selected='selected'" : "" ?>>Íslenska</option>
                                                    <option value="cs"  <?php echo $info->prefer_communication_with=="cs" ? "selected='selected'" : "" ?>>Ceština</option>
                                                    <option value="ru"  <?php echo $info->prefer_communication_with=="ru" ? "selected='selected'" : "" ?>>???????</option>
                                                    <option value="th"  <?php echo $info->prefer_communication_with=="th" ? "selected='selected'" : "" ?>>???????</option>
                                                    <option value="zh"  <?php echo $info->prefer_communication_with=="zh" ? "selected='selected'" : "" ?>>?? (??)</option>
                                                    <option value="zh-TW"  <?php echo $info->prefer_communication_with=="zh-TW" ? "selected='selected'" : "" ?>>?? (??)</option>
                                                    <option value="ja"  <?php echo $info->prefer_communication_with=="ja" ? "selected='selected'" : "" ?>>???</option>
                                                    <option value="ko"  <?php echo $info->prefer_communication_with=="ko" ? "selected='selected'" : "" ?>>???</option>
                                                </select>
                                                  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Preferred Currency
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<select class="form-control" id="preferred_currency" name="preferred_currency">
                                                    <option value="euro" <?php echo $info->preferred_currency=="euro" ? "selected='selected'" : "" ?> >Euro</option>
                                                    <option value="dollar" <?php echo $info->preferred_currency=="dollar" ? "selected='selected'" : "" ?> >Dollar</option>
                                                </select>
                                                 
        									</div>
        								</div>
                                        
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										<div class="col-sm-12 col-md-2"></div>
        										<div class="col-sm-12 col-md-7">
        											<button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
        												{{ Lang::get('core.sb_savechanges') }}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div>  
                        		 </div> 
                        		{!! Form::close() !!}
        					</div>
        					<div class="tab-pane " id="pass">
                                {!! Form::open(array('url'=>'user/savepassword/', 'class'=>'m-form m-form--fit m-form--label-align-right ')) !!}
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.newpassword') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password" type="password" id="password" class="form-control m-input" required  value="" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.conewpassword') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password_confirmation" type="password" id="password_confirmation" class="form-control m-input" required  value="" />  
        									</div>
        								</div> 
                            		</div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										<div class="col-sm-12 col-md-2"></div>
        										<div class="col-sm-12 col-md-7">
        											<button type="submit" class="btn btn-danger m-btn m-btn--air m-btn--custom">
        												{{ Lang::get('core.sb_savechanges') }}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div>   
                            		
                        		{!! Form::close() !!}
                            </div>
        					<div class="tab-pane " id="preferences">
                                
                            </div>
        				</div>
                    </div><!-- // myprofile -->
            
                </div><!-- /tab-content -->
			</div><!-- //tabs -->

		</div>
	</div>
@stop

@section('custom_js_script')
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
@stop