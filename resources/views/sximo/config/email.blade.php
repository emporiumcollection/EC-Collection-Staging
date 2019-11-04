
 @extends('layouts.app')

@section('content')
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3><i class="fa fa-envelope"></i> {{ Lang::get('core.t_blastemail') }}  <small>{{ Lang::get('core.t_blastemailsmall') }}</small></h3>
      </div>
   
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
		<li class="active"> {{ Lang::get('core.t_blastemail') }} </li>
		
      </ul>
	  
	  
    </div>

 <div class="page-content-wrapper">  
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="block-content">
	@include('sximo.config.tab')	
<!--<div class="tab-content m-t">
	  <div class="tab-pane active use-padding" id="info">	
	 {!! Form::open(array('url'=>'sximo/config/email/', 'class'=>'form-vertical row')) !!}
	
	<div class="col-sm-6 animated fadeInRight">
		<div class="sbox  "> 
			<div class="sbox-title"> {{ Lang::get('core.registernew') }}  </div>
			<div class="sbox-content"> 	
				  <div class="form-group">
					<label for="ipt" class=" control-label"> {{ Lang::get('core.tab_email') }} </label>		
					<textarea rows="20" name="regEmail" class="form-control input-sm  markItUp">{{ $regEmail }}</textarea>		
				  </div>  
				

				<div class="form-group">   
					<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
				</div>
			
			</div>	
		</div>
		


</div> 


	<div class="col-sm-6 animated fadeInRight">
		<div class="sbox  "> 
			<div class="sbox-title">  {{ Lang::get('core.forgotpassword') }}</div>
			<div class="sbox-content"> 	
				  <div class="form-group">
					<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
					<textarea rows="20" name="resetEmail" class="form-control input-sm markItUp">{{ $resetEmail }}</textarea>					 
				  </div> 

			  <div class="form-group">
					<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
				 </div> 
			</div>	 
	  </div>	  
	
 	
 </div>
 {!! Form::close() !!}
</div>
</div>-->

<div class="tab-content m-t">
	  <div class="tab-pane active use-padding" id="info">	
	 {!! Form::open(array('url'=>'sximo/config/email/', 'class'=>'form-vertical row')) !!}
	<div class="col-md-12">
	<ul class="nav nav-tabs" >
	  <li class="active"><a href="#nregister" data-toggle="tab"> New Register </a></li>
	  <li ><a href="#fpassword" data-toggle="tab">Forget Password </a></li>
	  <li ><a href="#norder" data-toggle="tab"> New Order </a></li>
	  <li ><a href="#container" data-toggle="tab"> Container Templates </a></li>
	  <li ><a href="#lightbox" data-toggle="tab"> Lightbox Templates </a></li>
	  <li ><a href="#userimport" data-toggle="tab"> User Import </a></li>
	  <li ><a href="#lghtboxorderconfirm" data-toggle="tab"> Lightbox Order Confirmation </a></li>
	  <li ><a href="#enquiry" data-toggle="tab"> Property Enquiry </a></li>
	  <li ><a href="#bookingEmail" data-toggle="tab"> Booking Email </a></li>
	  <li ><a href="#crmEmailtemplate" data-toggle="tab"> CRM Email Template </a></li>
	  <li ><a href="#frontendUploadtemplate" data-toggle="tab"> Frontend upload Template </a></li>
	  <li ><a href="#frontendDownloadtemplate" data-toggle="tab"> Frontend download Template </a></li>
	  <li ><a href="#removalRemindertemplate" data-toggle="tab"> Removal Reminder Template </a></li>
      <li ><a href="#refferalInvitationtemplate" data-toggle="tab"> Refferal Invitation Template </a></li>
      
      <li ><a href="#requestReferralEmailtoSuperAdmin" data-toggle="tab"> Request Referral Email to Super Admin   </a></li>
      <li ><a href="#requestReferralEmailtoUser" data-toggle="tab"> Request Referral Email to User </a></li>
      
      <li ><a href="#priceOnRequestEmailtoSuperAdmin" data-toggle="tab"> Price On Request Email to Admin   </a></li>
      <li ><a href="#priceOnRequestEmailtoUser" data-toggle="tab"> Price On Request Email to User </a></li>
      
	</ul>

	<div class="tab-content">
	  <div class="tab-pane active m-t" id="nregister">
		<div class="col-sm-6 animated fadeInRight">
			<div class="sbox  "> 
				<div class="sbox-title"> {{ Lang::get('core.registernew') }}  </div>
				<div class="sbox-content"> 	
					  <div class="form-group">
						<label for="ipt" class=" control-label"> {{ Lang::get('core.tab_email') }} </label>		
						<textarea rows="20" name="regEmail" class="form-control input-sm  markItUp">{{ $regEmail }}</textarea>		
					  </div>  
					

					<div class="form-group">   
						<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
					</div>
				
				</div>	
			</div>
		</div>
	  </div>
      
      <div class="tab-pane m-t" id="requestReferralEmailtoSuperAdmin">
            <div class="col-sm-6 animated fadeInRight">
            	<div class="sbox  "> 
            		<div class="sbox-title">  {{ Lang::get('core.request_refferal_email_to_superadmin') }}</div>
            		<div class="sbox-content"> 	
            			  <div class="form-group">
            				<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
            				<textarea rows="20" name="requestReferralEmailtoSuperAdmin" class="form-control input-sm markItUp">{{ $requestReferralEmailtoSuperAdmin }}</textarea>					 
            			  </div> 
            
            		  <div class="form-group">
            				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
            			 </div> 
            		</div>	 
              </div>
            </div>
      </div>
        
      <div class="tab-pane m-t" id="requestReferralEmailtoUser">
            <div class="col-sm-6 animated fadeInRight">
            	<div class="sbox  "> 
            		<div class="sbox-title">  {{ Lang::get('core.request_refferal_email_to_user') }}</div>
            		<div class="sbox-content"> 	
            			  <div class="form-group">
            				<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
            				<textarea rows="20" name="requestReferralEmailtoUser" class="form-control input-sm markItUp">{{ $requestReferralEmailtoUser }}</textarea>					 
            			  </div> 
            
            		  <div class="form-group">
            				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
            			 </div> 
            		</div>	 
                </div>
            </div>
      </div>
      
      <div class="tab-pane m-t" id="refferalInvitationtemplate">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox  "> 
					<div class="sbox-title">  {{ Lang::get('core.refferal_invite') }}</div>
					<div class="sbox-content"> 	
						  <div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="refferalInvitation" class="form-control input-sm markItUp">{{ $refferalInvitation }}</textarea>					 
						  </div> 

					  <div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>
			</div>
		</div>
      
        
		<div class="tab-pane m-t" id="fpassword">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox  "> 
					<div class="sbox-title">  {{ Lang::get('core.forgotpassword') }}</div>
					<div class="sbox-content"> 	
						  <div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="resetEmail" class="form-control input-sm markItUp">{{ $resetEmail }}</textarea>					 
						  </div> 

					  <div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>
			</div>
		</div>
 
		<div class="tab-pane m-t" id="norder">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox  "> 
					<div class="sbox-title">  Order's Invoice </div>
					<div class="sbox-content"> 	
						  <div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="invoiceEmail" class="form-control input-sm markItUp">{{ $invoiceEmail }}</textarea>					 
						  </div> 

					  <div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	  
		
		
			</div>
		</div>
		
		<div class="tab-pane m-t" id="container">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Container Templates </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="container_temp1" class="form-control input-sm markItUp">{{ $container_template1 }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="lightbox">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Lightbox Templates </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="lightbox_template1" class="form-control input-sm markItUp">{{ $lightbox_template1 }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="userimport">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  User Import Templates </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="user_import" class="form-control input-sm markItUp">{{ $user_import }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $password &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="lghtboxorderconfirm">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Lightbox Order Confirmation Templates </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="lghtboxorderconfirm" class="form-control input-sm markItUp">{{ $lghtboxorderconfirm }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="enquiry">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Property Enquiry </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="enquiry" class="form-control input-sm markItUp">{{ $enquiry }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="bookingEmail">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Booking Email </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="bookingEmail" class="form-control input-sm markItUp">{{ $bookingEmail }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		<div class="tab-pane m-t" id="crmEmailtemplate">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  CRM Email </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="crmEmail" class="form-control input-sm markItUp">{{ $crmEmail }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="frontendUploadtemplate">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Frontend Upload Email </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="frontendUpload" class="form-control input-sm markItUp">{{ $frontendUpload }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="frontendDownloadtemplate">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Frontend Download Email </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="frontendDownload" class="form-control input-sm markItUp">{{ $frontendDownload }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
		
		<div class="tab-pane m-t" id="removalRemindertemplate">
			<div class="col-sm-6 animated fadeInRight">
				<div class="sbox"> 
					<div class="sbox-title">  Removal Reminder Email </div>
					<div class="sbox-content"> 	
						<div class="form-group">
							<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
							<textarea rows="20" name="removalreminder" class="form-control input-sm markItUp">{{ $removalreminder }}</textarea>					 
						</div> 
						
						<div class="form-group">
							Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.
						 </div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
						 </div> 
					</div>	 
			  </div>	
			</div>
		</div>
        
        <div class="tab-pane m-t" id="priceOnRequestEmailtoSuperAdmin">
            <div class="col-sm-6 animated fadeInRight">
            	<div class="sbox  "> 
            		<div class="sbox-title">  {{ Lang::get('core.request_refferal_email_to_superadmin') }}</div>
            		<div class="sbox-content"> 	
                        <div class="form-group">
                            <label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
                            <textarea rows="20" name="priceOnRequestEmailtoSuperAdmin" class="form-control input-sm markItUp">{{ $priceOnRequestEmailtoSuperAdmin }}</textarea>					 
                        </div> 
                        <div class="form-group">
                            Please use "&#123;&#33;&#33; $msg &#33;&#33;&#125;" shortcode for print massage in the template.    
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
                        </div> 
            		</div>	 
              </div>
            </div>
      </div>
        
      <div class="tab-pane m-t" id="priceOnRequestEmailtoUser">
            <div class="col-sm-6 animated fadeInRight">
            	<div class="sbox  "> 
            		<div class="sbox-title">  {{ Lang::get('core.request_refferal_email_to_user') }}</div>
            		<div class="sbox-content"> 	
                        <div class="form-group">
                            <label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
                            <textarea rows="20" name="priceOnRequestEmailtoUser" class="form-control input-sm markItUp">{{ $priceOnRequestEmailtoUser }}</textarea>					 
                        </div> 
                            
                        <div class="form-group">
							Please use "&#123;&#123; $firstname &#125;&#125;" shortcode for print massage in the template.
					    </div>
                            
            		    <div class="form-group">
            				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
            			</div> 
            		</div>	 
                </div>
            </div>
      </div>
      
        
	</div>
	</div>
 {!! Form::close() !!}
</div>
</div>
</div>
</div>
@stop





